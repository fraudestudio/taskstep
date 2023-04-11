<?php

declare(strict_types=1);

namespace TaskStep\Logic\Data\LegacyMySql;

use TaskStep\Logic\Model\{Project, ProjectDaoInterface};

/**
 * Accès au données des projets compatible avec la BDD de la version 1.1.
 */
class ProjectDao implements ProjectDaoInterface
{
    public function create(Project $project)
    {
        throw new \Exception("TODO!");
    }
    
    public function readById(int $id): Project
    {
        $statement = Database::instance()->execute('SELECT * FROM projects WHERE id = ?', $id);

        if ($row = $statement->fetch())
        {
            return (new Project($id))->setTitle($row['title']);
        }
        else
        {
            throw new Exception('Project not found');
        }
    }
    
    public function readAll(): array
    {
        $statement = Database::instance()->execute('SELECT * FROM projects');

        $result = [];

        while ($row = $statement->fetch())
        {
            array_push(
                $result,
                (new Project($row['id']))->setTitle($row['title'])
            );
        }

        return $result;
    }
    
    public function readByTitle(string $title): Project
    {
        $statement = Database::instance()
            ->execute('SELECT * FROM projects WHERE LOWER(title) = LOWER(?)', $title);

        $project;

        if ($row = $statement->fetch())
        {
            $project = (new Project($row['id']))
                ->setTitle($row['title']);
        }
        else
        {
            // Une « fonctionnalité » précédente permettait d'avoir des tâches
            // liées à un projet n'existant plus ou ayant été renommé.
            // On crée donc un projet temporaire pour ignorer ce problème.
            // Il y a la même chose avec les contextes.
            $project = (new Project(-1))
                ->setTitle($title);
        }

        return $project;
    }
    
    public function update(int $id, Project $project)
    {
        throw new \Exception("TODO!");
    }
    
    public function delete(int $id)
    {
        throw new \Exception("TODO!");
    }
}