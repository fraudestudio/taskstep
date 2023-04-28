<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

use TaskStep\Config;

/**
 * Un jeton reCAPTCHA permettant de valider les demandes d'inscription.
 */
class ReCaptchaToken
{
	private string $_token;

	/**
	 * Crée un nouveau jeton.
	 * 
	 * @param $token Le jeton sous forme d'un string.
	 */
	public function __construct(string $token)
	{
		$this->_token = $token;
	}

	/**
	 * Vérifie la validité du jeton.
	 */
	public function verify() : bool
	{
		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$data = [
			'secret' => Config::instance()->reCaptchaSecret(),
			'response' => $this->_token,
		];

		$options = [
		    'http' => [
		    	'header' => "Content-Type: application/json\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($data)
		    ]
		];
		$context = stream_context_create($options);

		$result = file_get_contents($url, false, $context);

		if ($result)
		{
			return json_decode($result)->success ?? false;
		}
		else
		{
			return false;
		}
	}
}