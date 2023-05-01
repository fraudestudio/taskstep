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
		$url = 'https://www.google.com/recaptcha/api/siteverify?';

		$data = [
			'secret' => Config::instance()->reCaptchaSecret(),
			'response' => $this->_token,
		];

		$options = [
		    'http' => [
		    	'header' => "Content-Length: 0\r\n",
		        'method'  => 'POST',
		    ]
		];
		$context = stream_context_create($options);

		$result = file_get_contents($url.http_build_query($data), false, $context);

		if ($result)
		{
			$result = json_decode($result, true);

			/* DÉCOMMENTER SI LE CAPTCHA PÊTE SON CRÂNE *
			if (in_array('invalid-input-response', $result['error-codes'] ?? []))
			{
				echo 'WARN_INVALID_RESPONSE_IGNORED';
				return true;
			}
			//*/

			return $result['success'] ?? false;
		}
		else
		{
			return false;
		}
	}
}