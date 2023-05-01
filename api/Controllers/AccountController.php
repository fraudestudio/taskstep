<?php

declare(strict_types=1);

namespace TaskStepApi\Controllers;

use TaskStepApi\Middleware\Helpers\{Context, Services};
use TaskStep\Logic\Exceptions\{DuplicateException, NotFoundException};
use TaskStep\Logic\Model\UserDaoInterface;
use TaskStep\Logic\Model\{Registration, Settings};
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

	public function changePassword()
	{
		$user = $this->requireUser();
		$password = $this->requireBodyText();
		
		if ($password === '') $this->badRequest();
		
		if (!$this->userDao->changePassword($user, $password)) $this->badRequest();

		$this->okResponse();
	}

	public function updateSettings()
	{
		$user = $this->requireUser();
		$settings = $this->requireBodyObject(Settings::class);
		
		try
		{
			$this->userDao->updateStyle($user, $settings->style());
			$this->userDao->updateTips($user, $settings->tips());
		}
		catch (NotFoundException)
		{
			$this->badRequest();
		}

		$this->okResponse();
	}
}