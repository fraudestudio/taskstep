<?php

declare(strict_types=1);

namespace TaskStep\Logic\Data\LegacyMySql;

use TaskStep\Logic\Model\{User, Project, ProjectDaoInterface};
use \Exception;

/**
 * Accès au données des projets compatible avec la BDD de la version 1.1.
 */
class ProjectDao implements ProjectDaoInterface
{
    public function create(User $user, Project $project) : int
    {
        Database::instance()->execute(
            'INSERT INTO projects (title) VALUES (:title)',
            title: $project->title()
        );

        return 0;
    }
    
    public function readById(User $user, int $id): Project
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
    
    public function readAll(User $user): array
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
    
    public function update(User $user, int $id, Project $project)
    {
        Database::instance()->execute(
            'UPDATE projects SET title=:title WHERE id=:id',
            id: $id,
            title: $project->title()
        );
    }
    
    public function delete(User $user, int $id)
    {
        throw new \Exception("TODO!");
    }
}