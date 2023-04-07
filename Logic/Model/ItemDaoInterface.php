<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

/**
 * Un DAO des items.
 */
interface ItemDaoInterface
{
	/**
	 * Crée un item.
	 * 
	 * @param $item Le nouvel item.
	 */ 
	public function create(Item $item);

	/**
	 * Récupère un item par son identifiant.
	 * 
	 * @param $id L'identifiant de l'item à récupérer.
	 */
	public function readById(int $id): Item;

	/**
	 * Récupère tous les items.
	 */
	public function readAll(): array;

	/**
	 * Récupère tous les items appartenant à une section.
	 * 
	 * @param $section La section des items à récupérer.
	 */
	public function readBySection(Section $section): array;

	/**
	 * Récupère tous les items appartenant à un contexte.
	 * 
	 * @param $section Le contexte des items à récupérer.
	 */
	public function readByContext(Context $context): array;

	/**
	 * Récupère tous les items appartenant à un projet.
	 * 
	 * @param $section Le projet des items à récupérer.
	 */
	public function readByProject(Project $project): array;

	/**
	 * Mets à jour un item.
	 * 
	 * @param $id L'identifiant de l'item à modifier.
	 * 
	 * @param $item L'item modifié.
	 */
	public function update(int $id, Item $item);

	/**
	 * Supprime un item.
	 * 
	 * @param $id L'identifiant de l'item à supprimer.
	 */
	public function delete(int $id);
}