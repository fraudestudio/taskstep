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

		if ($registration->captchaToken()->verify())
		{
			try
			{
				$this->userDao->register($registration);
				$this->okResponse();
			}
			catch (DuplicateException)
			{
				$this->textResponse('ERR_EMAIL_ARLEADY_TAKEN', 400);
			}
		}
		else
		{
			$this->textResponse('ERR_CAPTCHA_INVALID', 400);
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
            $this->userDao->cleanSessions($user);
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