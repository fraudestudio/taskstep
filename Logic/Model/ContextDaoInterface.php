<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

/**
 * Un DAO des contextes.
 */
interface ContextDaoInterface
{
    /**
     * Crée un contexte.
     * 
     * @param $context Le nouveau contexte.
     */ 
    public function create(User $user,Context $context): int;

    /**
     * Récupère un contexte par son identifiant.
     * 
     * @param $id L'identifiant du contexte à récupérer.
     */
    public function readById(User $user, int $id): Context;

    /**
     * Récupère tous les contextes.
     */
    public function readAll(User $user): array;

    /**
     * Mets à jour un contexte.
     * 
     * @param $id L'identifiant du contexte à modifier.
     * 
     * @param $context Le contexte modifié.
     */
    public function update(int $id, Context $context);

    /**
     * Supprime un contexte.
     * 
     * @param $id L'identifiant du contexte à supprimer.
     */
    public function delete(int $id);
}