<?php

declare(strict_types=1);

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

	/**
	 * Crée un contexte.
	 * 
	 * @param $id L'identifiant du contexte. Il n'a pas besoin d'être indiqué
	 *            quand on en crée un nouveau.
	 */
	public function __construct(int $id = -1)
	{
		$this->_id = $id;
	}
}