<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

use TaskStepApi\Middleware\Helpers\JsonSerializable;
use Exception;

/**
 * Un projet de tâche.
 */
class Project implements JsonSerializable
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

	/**
	 * Crée un projet.
	 * 
	 * @param $id L'identifiant du projet. Il n'a pas besoin d'être indiqué
	 *            quand on en crée un nouveau.
	 */
	public function __construct(int $id = -1)
	{
		$this->_id = $id;
	}

	public function jsonSerialize() : mixed {
		return [
			'Id' => $this->_id,
			'Title' => $this->_title,
		];
	}

	public function jsonDeserialize(mixed $value) : void {
		// optionnel
		if (key_exists('Id', $value)) $this->_id = $value['Id'];

		// requis
		$this->_title = $value['Title'] ?? throw new Exception("missing 'Title' field in 'Project' object");
	}
}