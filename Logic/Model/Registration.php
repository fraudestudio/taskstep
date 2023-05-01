<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

use TaskStepApi\Middleware\Helpers\JsonSerializable;

/**
 * Informations nécéssaires pour créer un compte.
 */
class Registration implements JsonSerializable
{
	private string $_email;
	private string $_password;
	private ReCaptchaToken $_captchaToken;

	/**
	 * Récupère l'adresse mail du nouvel utilisateur.
	 */
	public function email() : string { return $this->_email; }

	/**
	 * Récupère le mot de passe du nouvel utilisateur.
	 */
	public function password() : string { return $this->_password; }

	/**
	 * Récupère le jeton CAPTCHA pour valider l'inscription.
	 */
	public function captchaToken() : ReCaptchaToken { return $this->_captchaToken; }


	public function jsonSerialize() : mixed {
		throw new \Exception("'Registration' objects shouldn't be sent");
	}

	public function jsonDeserialize(mixed $value) : void {
		$this->_email = $value['Email']
			?? throw new \Exception("missing 'Email' field in 'Registration' object");

		$this->_password = $value['Password']
			?? throw new \Exception("missing 'Password' field in 'Registration' object");

		$this->_captchaToken = new ReCaptchaToken($value['CaptchaToken'])
			?? throw new \Exception("missing 'CaptchaToken' field in 'Registration' object");
	}
}