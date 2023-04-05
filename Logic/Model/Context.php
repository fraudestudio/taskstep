<?php

declare(strict_type=1);

namespace TaskStep\Logic\Model;

/**
 * Un contexte de tâche.
 */
class Context
{
	private int $_id;
	private string $_title;

	/**
	 * L'identifiant du contexte.
	 */
	public function id(): int { return $this->_id; }

	/**
	 * Le nom du contexte.
	 */
	public function title(): string { return $this->_title; }

	/**
	 * Modifie le nom du contexte.
	 * 
	 * @param $title Le nouveau nom.
	 */
	public function setTitle(string $title): Context
	{
		$this->_title = $title;
		return $this;
	}
}