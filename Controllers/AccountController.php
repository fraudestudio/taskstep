<?php

declare(strict_types=1);

namespace TaskStep\Controllers;

use TaskStep\Middleware\Helpers\{Context, Services};
use TaskStep\Logic\Exceptions\DuplicateException;
use TaskStep\Logic\Model\UserDaoInterface;
use TaskStep\Logic\Model\Registration;
use PDOException;

class AccountController extends Controller
{
	private UserDaoInterface $userDao;

	public function __construct(Context $context, Services $container)
	{
		parent::__construct($context, $container);

		$this->userDao = $container->get('userDao');
	}

	/**
	 * Crée un compte.
	 */
	public function signup()
	{
		$registration = $this->requireBodyObject(Registration::class);

		trigger_error('TODO : VÉRIFIER LE CAPTCHA !', E_USER_WARNING);

		try
		{
			$this->userDao->register($registration);
		}
		catch (DuplicateException)
		{
			$this->badRequest('ERR_EMAIL_ARLEADY_TAKEN');
		}
	}

	/**
	 * Connexion au service.
	 */
	public function signin()
	{
		$user = $this->requireUser();

		try
		{
			$token = $this->userDao->createSession($user);
		}
		catch (PDOException $err)
		{
			$this->badRequest($err->getMessage());
		}

		$this->jsonResponse([
			'Token' => $token,
			'User' => $user,
		]);
	}
}