<?php

declare(strict_types=1);

namespace TaskStep\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use TaskStep\Middleware\{Context, Services};
use TaskStep\Logic\Model\User;

/**
 * Un contrôleur d'API.
 */
class Controller
{
	private Context $_context;

	/**
	 * Instancie un contrôleur.
	 * 
	 * @param $context Le contexte auquel lier le contrôleur.
	 */
	public function __construct(Context $context)
	{
		$this->_context = $context;
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
			$controller = new $class($context);
			call_user_func([$controller, $method]);
			return $context->response();
		};
	}

	// -- REQUÊTE --

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
			throw new HttpBadRequestException();
		}

		return $value;
	}

	public function user() : User {

	}

	// -- RÉPONSE --

	/**
	 * Écrit une réponse au format texte brut.
	 * 
	 * @param $text (optionnel) Le texte à ajouter au corps de la réponse.
	 */
	public function textResponse(string $text = "") : void {
		$this->_context->setResponse(function ($response) use ($text) {
			$response->getBody()->write($text);
			return $response
				->withHeader('Content-Type', 'text/plain')
				->withStatus(200);
		});
	}

	// -- INJECTION DE DÉPENDANCES --

	/**
	 * Récupère le DAO des projets.
	 */
	public function service(string $name): object {
		return Services::instance()->get($name);
	}
}