<?php

namespace TaskStep\Logic\Model;

use TaskStep\Logic\Data\MySql\Dao\UserDao;
use TaskStep\Config;

/**
 * Helper functions to manage export tokens.
 */
class Export
{
	public static function generateToken(User $user) : string
	{
		$secret = Config::instance()->exportSecret();

		$signature = hash('sha256', $user->id() . $secret);
		$token = $user->id() . ':' . $signature;

		return str_replace(['+','/','='], ['-','_',''], base64_encode($token));
	}

	public static function verifyToken(string $token) : ?User
	{
		$secret = Config::instance()->exportSecret();

		$token = base64_decode(str_replace(['-','_'], ['+','/'], $token));
		$data = explode(':', $token, 2);
		if (count($data) != 2) return null;
		list($id, $givenSignature) = $data;

		$expectedSignature = hash('sha256', $id . $secret);
		if ($givenSignature !== $expectedSignature) return null;

		try 
		{
			return (new UserDao)->readById($id);
		}
		catch (Exception)
		{
			return null;
		}
	}
}