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
    public function create(Project $project);

    /**
     * Récupère un projet par son identifiant.
     * 
     * @param $id L'identifiant du projet à récupérer.
     */
    public function readById(int $id): Project;

    /**
     * Récupère tous les projets d'un utilisateur
     */
    public function readAll(int $idUser): array;

    /**
     * Mets à jour un projet.
     * 
     * @param $id L'identifiant du projet à modifier.
     * 
     * @param $project Le projet modifié.
     */
    public function update(Project $toCopy,int $id);

    /**
     * Supprime un projet.
     * 
     * @param $id L'identifiant du projet à supprimer.
     */
    public function delete(int $id);
}