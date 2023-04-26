<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

/**
 * Informations nécéssaires pour créer un compte.
 */
class Registration
{
	private string $_email;
	private string $_password;
	private ReCaptchaToken $_captchaToken;

	/**
	 * Récupère l'adresse mail du nouvel utilisateur.
	 */
	public function email() : string { return $this->email; }

	/**
	 * Récupère le mot de passe du nouvel utilisateur.
	 */
	public function password() : string { return $this->password; }

	/**
	 * Récupère le jeton CAPTCHA pour valider l'inscription.
	 */
	public function captchaToken() : ReCaptchaToken { return $this->captchaToken; }

	/**
	 * Crée une nouvelle demande d'inscription.
	 * 
	 * @param $email L'adresse mail.
	 * @param $password Le mot de passe.
	 * @param $captchaToken Un jeton émis par le service de CAPTCHA.
	 */
	public function __construct(string $email, string $password, ReCaptchaToken $captchaToken)
	{
		$this->_email = $email;
		$this->_password = $password;
		$this->_captchaToken = $captchaToken;
	}
}