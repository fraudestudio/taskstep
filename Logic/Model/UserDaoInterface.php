<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

/**
 * Un DAO des projets.
 */
interface UserDaoInterface
{
    /**
     * Crée un utilisateur.
     * 
     * @param $project Le nouvel utilisateur.
     */ 
    public function create(Project $project);

    /**
     * Récupère un projet par son identifiant.
     * 
     * @param $id L'identifiant du projet à récupérer.
     */
    public function readById(int $id): Project;

    /**
     * Récupère tous les projets.
     */
    public function readAll(): array;

    /**
     * Mets à jour un projet.
     * 
     * @param $id L'identifiant du projet à modifier.
     * 
     * @param $project Le projet modifié.
     */
    public function update(int $id, Project $project);

    /**
     * Supprime un projet.
     * 
     * @param $id L'identifiant du projet à supprimer.
     */
    public function delete(int $id);
}