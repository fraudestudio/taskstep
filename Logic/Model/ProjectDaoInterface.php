<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

/**
 * Un DAO des projets.
 */
interface ProjectDaoInterface
{
    /**
     * Crée un projet.
     * 
     * @param $project Le nouvel projet.
     */ 
    public function create(User $user, Project $project) : int;

    /**
     * Récupère un projet par son identifiant.
     * 
     * @param $id L'identifiant du projet à récupérer.
     */
    public function readById(User $user, int $id) : Project;

    /**
     * Récupère tous les projets.
     */
    public function readAll(User $user) : array;

    /**
     * Mets à jour un projet.
     * 
     * @param $id L'identifiant du projet à modifier.
     * 
     * @param $project Le projet modifié.
     */
    public function update(User $user, int $id, Project $project);

    /**
     * Supprime un projet.
     * 
     * @param $id L'identifiant du projet à supprimer.
     */
    public function delete(User $user, int $id);
}