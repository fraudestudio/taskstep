<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

use TaskStep\Logic\{Context, Project};

/**
 * Représente une tâche.
 */
class Item extends UserItem
{
	private int $_id;
	private string $_title;
	private ?DateTime $_date;
	private string $_notes;
	private string $_url;
	private Section $_section;
	private Context $_context;
	private Project $_project;
	private bool $_done;

	/**
	 * L'identifiant de la tâche.
	 */
	public function id(): int { return $this->_id; }

	/**
	 * Le nom de la tâche.
	 */
	public function title(): string {return $this->_title; }

	/**
	 * Modifie le nom de la tâche.
	 * 
	 * @param $title Le nouveau nom de la tâche.
	 */
	public function setTitle(string $title): Item
	{
		this->_title = $title;
		return $this;
	}

	/**
	 * L'échéance de la tâche.
	 */
	public function date(): ?DateTime { return $this->_date; }

	/**
	 * Modifie l'échéance de la tâche.
	 * 
	 * @param $date La nouvelle échéance, ou null pour l'enlever.
	 */
	public function setDate(?DateTime $date): Item
	{
		this->_date = $date;
		return $this;
	}

	/**
	 * La description de la tâche.
	 */ 
	public function notes(): string { return $this->_notes; }

	/**
	 * Modifie la description de la tâche.
	 * 
	 * @param $notes La nouvelle description.
	 */
	public function setNotes(string $notes): Item
	{
		this->_notes = $notes;
		return $this;
	}

	/**
	 * Un lien associé à la tâche.
	 */
	public function url(): string { return $this->_url; }

	/**
	 * Modifie le lien de la tâche.
	 * 
	 * @param $url Le nouveau lien.
	 */
	public function setUrl(string $url): Item
	{
		this->_url = $url;
		return $this;
	}

	/**
	 * La section de la tâche.
	 */
	public function section(): Section { return $this->_section; }

	/**
	 * Modifie la section de la tâche.
	 * 
	 * @param $section La nouvelle section.
	 */
	public function setSection(Section $section): Item
	{
		$this->_section = $section;
		return $this;
	}

	/**
	 * Le contexte auquel appartient la tâche.
	 */
	public function context(): Context { return $this->_context; }

	/**
	 * Modifie le contexte de la tâche.
	 * 
	 * @param $section Le nouveau contexte.
	 */
	public function setContext(Context $context): Item
	{
		$this->_context = $context;
		return $this;
	}

	/**
	 * Le projet auquel appartient la tâche.
	 */
	public function project(): Project { return $this->_project; }

	/**
	 * Modifie le projet de la tâche.
	 * 
	 * @param $section Le nouveau projet.
	 */
	public function setProject(Project $project): Item
	{
		$this->_project = $project;
		return $this;
	}

	/**
	 * Indique si la tâche est terminée.
	 */
	public function done(): bool { return $this->_done; }

	/**
	 * Modifie l'état de la tâche.
	 * 
	 * @param $done Le nouvel état de la tâche.
	 */
	public function setDone(bool $done): Item
	{
		$this->_done = $done;
		return $this;
	}

	/**
	 * Crée une tâche.
	 * 
	 * @param $user L'utilisateur à qui appartient la tâche.
	 * 
	 * @param $id L'identifiant de la tâche. Il n'a pas besoin d'être indiqué
	 *            quand on crée une nouvelle tâche.
	 */
	public function __construct(User $user, int $id = -1)
	{
		parent::__construct($user);

		$this->_id = $id; 
	}
}