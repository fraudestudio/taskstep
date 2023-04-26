<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

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
		throw new \Exception('TODO !!!');
	}
}