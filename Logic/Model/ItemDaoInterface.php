<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

use \DateTime;

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
	public function create(User $user, Item $item);

	/**
	 * Récupère un item par son identifiant.
	 * 
	 * @param $id L'identifiant de l'item à récupérer.
	 */
	public function readById(User $user, int $id): Item;

	/**
	 * Récupère tous les items.
	 */
	public function readAll(User $user): array;

	/**
	 * Récupère tous les items appartenant à une section.
	 * 
	 * @param $section La section des items à récupérer.
	 */
	public function readBySection(User $user,Section $section): array;

	/**
	 * Récupère tous les items appartenant à un contexte.
	 * 
	 * @param $section Le contexte des items à récupérer.
	 */
	public function readByContext(User $user, Context $context): array;

	/**
	 * Récupère tous les items appartenant à un projet.
	 * 
	 * @param $section Le projet des items à récupérer.
	 */
	public function readByProject(User $user, Project $project): array;

	/**
	 * Récupère les items avec une échéance particulière.
	 * 
	 * @param $date La date pour laquelle récupérer les items.
	 */
	public function readByDate(User $user, DateTime $date): array;

	/**
	 * Récupère les items du jour.
	 * 
	 * Les items du jour sont ceux à terminer avant aujourd'hui
	 * et ceux de la section « immediate » qui s'ont pas été terminés.
	 * 
	 * @param $day Le jour pour lequel chercher les items.
	 */
	public function readDaily(User $user, DateTime $day): array;

	/**
	 * Mets à jour un item.
	 * 
	 * @param $id L'identifiant de l'item à modifier.
	 * 
	 * @param $item L'item modifié.
	 */
	public function update(User $user, int $id, Item $item);

	/**
	 * Supprime un item.
	 * 
	 * @param $id L'identifiant de l'item à supprimer.
	 */
	public function delete(User $user, int $id);

	/**
	 * Supprime tous les items terminés.
	 * 
	 * @return int nombre d'items supprimés.
	 */
	public function deleteAllDone(User $id): int;

	/**
	 * Compte le nombre total de tâches à faire.
	 */
	public function countUndone(User $user): int;

	/**
	 * Compte le de tâches finies et à faire pour chaque section.
	 * 
	 * Le tableau associatif renvoyé est indexé par section
	 * et contient des sous-tableaux avec deux clés : 'done' et 'undone'. 
	 */
	public function countBySection(User $user): array;
}