<?php

declare(strict_types=1);

namespace TaskStepApi\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteParserInterface;
use Slim\Exception\HttpUnauthorizedException as Unauthorized;
use Slim\Exception\HttpNotFoundException as NotFound;
use TaskStepApi\Middleware\Helpers\Exceptions\HttpBadRequestException as BadRequest;
use TaskStepApi\Middleware\Helpers\{Context, Services};
use TaskStep\Logic\Model\User;
use Exception;

/**
 * Un contrôleur d'API.
 */
abstract class Controller
{
	private Context $_context;
	private RouteParserInterface $_routeParser;

	/**
	 * Instancie un contrôleur.
	 * 
	 * @param $context Le contexte auquel lier le contrôleur.
	 */
	public function __construct(Context $context, Services $container)
	{
		$this->_context = $context;
		$this->_routeParser = $container->get('routeParser');
	}

	/**
	 * Décore une méthode pour qu'elle soit utilisable comme rappel de routage.
	 * 
	 * @param $method Le nom de la méthode à décorer.
	 */ 
	public static function bind(string $method) : callable {
		return function (Request $request, Response $response, $args) use ($method) {
			$context = new Context($request, $response, $args);
			$class = static::class;
			$controller = new $class($context, Services::instance());
			call_user_func([$controller, $method]);
			return $context->response();
		};
	}

	// -- REQUÊTE --

	/**
	 * Essaie de récupérer un argument depuis l'URL de type chaîne de caractères.
	 * 
	 * @param $arg Le nom de l'argument à récupérer
	 * @param $out La variable dans laquelle écrire le résultat.
	 * 
	 * @return `true` si l'argument a été trouvé. 
	 */
	public function getString(string $arg, ?string &$out) : bool {
		$value = $this->_context->urlArg($arg);
		
		if (is_null($value)) {
			$value = $this->_context->request()->getQueryParams()[$arg] ?? null;
		}

		if (is_null($value))
		{
			return false;
		}
		else
		{
			$out = $value;
			return true;
		}
	}

	/**
	 * Essaie de récupérer un argument depuis l'URL de type entier.
	 * 
	 * @param $arg Le nom de l'argument à récupérer
	 * @param $out La variable dans laquelle écrire le résultat.
	 * 
	 * @return `true` si l'argument a été trouvé. 
	 */
	public function getInt(string $arg, ?int &$out) : bool {
		$value = $this->_context->urlArg($arg);
		
		if (is_null($value)) {
			$value = $this->_context->request()->getQueryParams()[$arg] ?? null;
		}

		if (is_null($value)) {
			return false;
		}
		else
		{
			if (!is_numeric($value)) {
				throw new BadRequest($this->_context->request(), "argument '$arg' was expected to be an integer");
			}

			$out = intval($value);
			return true;
		}
	}

	/**
	 * Récupère un argument depuis l'URL de type chaîne de caractères.
	 * 
	 * Si l'argument n'est pas trouvé, une HttpBadRequestException sera levée.
	 * 
	 * @param $arg Le nom de l'argument à récupérer.
	 */
	public function requireString(string $arg) : string {
		$value = $this->_context->urlArg($arg);
		
		if (is_null($value)) {
			$value = $this->_context->request()->getQueryParams()[$arg] ?? null;
		}

		if (is_null($value)) {
			throw new BadRequest($this->_context->request(), "missing argument '$arg'");
		}

		return $value;
	}

	/**
	 * Récupère un argument depuis l'URL de type entier.
	 * 
	 * Si l'argument n'est pas trouvé, une HttpBadRequestException sera levée.
	 * 
	 * @param $arg Le nom de l'argument à récupérer.
	 */
	public function requireInt(string $arg) : int {
		$value = $this->_context->urlArg($arg);
		
		if (is_null($value)) {
			$value = $this->_context->request()->getQueryParams()[$arg] ?? null;
		}

		if (is_null($value)) {
			throw new BadRequest($this->_context->request(), "missing argument '$arg'");
		}

		if (!is_numeric($value)) {
			throw new BadRequest($this->_context->request(), "argument '$arg' was expected to be an integer");
		}

		return intval($value);
	}

	/**
	 * Récupère le corps de la requête sous forme d'un objet.
	 * 
	 * Si le corps ne peut pas être récupéré pour une raison ou pour une autre,
	 * une HttpBadRequestException sera levée.
	 * 
	 * @param $class La classe attendue.
	 */
	public function requireBodyObject(?string $class = null) : object {
		$body = $this->_context->request()->getParsedBody();

		if (is_null($class))
		{
			return $body;
		}
		else
		{
			$value = new $class;
			
			if (is_array($body))
			{
				try
				{
					$value->jsonDeserialize($body);
				}
				catch (Exception $error)
				{
					throw new BadRequest($this->_context->request(), $error->getMessage());
				}
			}
			else
			{
				$type = gettype($body);
				throw new BadRequest($this->_context->request(), "expected object body, got '$type'");
			}

			return $value;
		}
	}

	/**
	 * Récupère le corps de la requête sous forme de texte brut.
	 */
	public function requireBodyText() : string {
		return $this->_context->request()->getBody()->getContents();
	}

	/**
	 * Récupère l'utilisateur qui a émis la requête courante.
	 * 
	 * Si aucun utilisateur n'est associé à la requête, une HttpUnauthorizedException sera levée.
	 */
	public function requireUser() : User
	{
		$user = $this->_context->request()->getAttribute('user');

		if (is_null($user)) throw new Unauthorized($this->_context->request());

		return $user;
	}

	// -- RÉPONSE --

	/**
	 * Écrit une réponse au format texte brut.
	 * 
	 * @param $text Le texte à ajouter au corps de la réponse.
	 * @param $status Le code de statut HTTP.
	 */
	public function textResponse(string $text = "", int $status = 200) : void {
		$this->_context->setResponse(function ($response) use ($text, $status) {
			$response->getBody()->write($text);
			return $response
				->withHeader('Content-Type', 'text/plain')
				->withStatus($status);
		});
	}

	/**
	 * Écrit une réponse au format json.
	 * 
	 * @param $object L'objet à ajouter au corps de la réponse.
	 * @param $status Le code de statut HTTP.
	 */
	public function jsonResponse(mixed $object, int $status = 200) : void {
		$this->_context->setResponse(function ($response) use ($object, $status) {
			$response->getBody()->write(json_encode($object));
			return $response
				->withHeader('Content-Type', 'application/json')
				->withStatus($status);
		});
	}

	/**
	 * Écrit une réponse avec un statut 201 « créé ».
	 * 
	 * @param $route L'identifiant de la route de la ressource crée.
	 * @param $data (optionnel) Les arguments pour les routes dynamiques.
	 * @param $query (optionnel) Des arguments de requête à rajouter. 
	 */
	public function createdResponse(string $route, array $data = [], array $query = []) : void {
		$uri = $this->_routeParser->urlFor($route, $data, $query);
		$this->_context->setResponse(function ($response) use ($uri) {
			$response->getBody()->write(json_encode(['Location' => $uri]));
			return $response
				->withHeader('Content-Type', 'text/json')
				->withStatus(201);
		});
	}

	/**
	 * Écrit une réponse avec un statut 200 « ok ».
	 */
	public function okResponse() : void {
		$this->_context->setResponse(function ($response) {
			return $response->withStatus(200);
		});
	}

	/**
	 * Lève une exception HttpNotFoundException.
	 */
	public function notFound() : void
	{
		throw new NotFound($this->_context->request());
	}

	/**
	 * Lève une exception HttpBadRequestException.
	 */
	public function badRequest(string $message = "Invalid request") : void
	{
		throw new BadRequest($this->_context->request(), $message);
	}
}