<?php

declare(strict_type=1);

namespace TaskStep\Logic\Model;

/**
 * Un projet de tâche.
 */
class Project
{
	private int $_id;
	private string $_title;

	/**
	 * L'identifiant du projet.
	 */
	public function id(): int { return $this->_id; }

	/**
	 * Le nom du projet.
	 */
	public function title(): string { return $this->_title; }

	/**
	 * Modifie le nom du projet.
	 * 
	 * @param $title Le nouveau nom.
	 */
	public function setTitle(string $title): Project
	{
		$this->_title = $title;
		return $this;
	}
}