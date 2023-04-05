<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

/**
 * Un objet appartenant à un utilisateur.
 */
abstract class UserItem
{
	private $_user;

	/**
	 * Indique si l'objet appartient à un utilisateur.
	 * 
	 * @param $user L'utilisateur à tester.
	 */
	public function belongsTo(User $user): bool
	{
		return $this->_user->id() === $user->id();
	}

	/**
	 * Crée un objet appartenant un utilisateur.
	 * 
	 * @param $user L'utilisateur à qui appartient l'objet.
	 */
	public function __construct(User $user)
	{
		$this->_user = $user;
	}
}