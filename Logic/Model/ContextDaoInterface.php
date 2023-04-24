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
    public function create(Context $context);

    /**
     * Récupère un contexte par son identifiant.
     * 
     * @param $id L'identifiant du contexte à récupérer.
     */
    public function readById(int $id): Context;

    /**
     * Récupère tous les contextes.
     */
    public function readAll(): array;

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