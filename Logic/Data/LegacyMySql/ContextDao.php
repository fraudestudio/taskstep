<?php

declare(strict_types=1);

namespace TaskStep\Logic\Data\LegacyMySql;

use TaskStep\Logic\Model\{Context, ContextDaoInterface};

use \Exception;

/**
 * Accès au données des contextes compatible avec la BDD de la version 1.1.
 */
class ContextDao implements ContextDaoInterface
{
    public function create(Context $context)
    {
        Database::instance()->execute(
            'INSERT INTO contexts (title) VALUES (:title)',
            title: $context->title()
        );
    }
    
    public function readById(int $id): Context
    {
        $statement = Database::instance()->execute('SELECT * FROM contexts WHERE id = ?', $id);

        if ($row = $statement->fetch())
        {
            return (new Context($id))->setTitle($row['title']);
        }
        else
        {
            throw new Exception('Context not found');
        }
    }
    
    public function readAll(): array
    {
        $statement = Database::instance()->execute('SELECT * FROM contexts');

        $result = [];

        while ($row = $statement->fetch())
        {
            array_push(
                $result,
                (new Context($row['id']))->setTitle($row['title'])
            );
        }

        return $result;
    }
    
    public function readByTitle(string $title): Context
    {
        $statement = Database::instance()
            ->execute('SELECT * FROM contexts WHERE LOWER(title) = LOWER(?)', $title);

        $context;

        if ($row = $statement->fetch())
        {
            $context = (new Context($row['id']))->setTitle($row['title']);
        }
        else
        {
            // Une « fonctionnalité » précédente permettait d'avoir des tâches
            // liées à un contexte n'existant plus ou ayant été renommé.
            // On crée donc un contexte temporaire pour ignorer ce problème.
            // Il y a la même chose avec les projets.
            $context = (new Context(-1))->setTitle($title);
        }

        return $context;
    }
    
    public function update(int $id, Context $context)
    {
        Database::instance()->execute(
            'UPDATE contexts SET title=:title WHERE id=:id',
            id: $id,
            title: $context->title()
        );
    }
    
    public function delete(int $id)
    {
        throw new Exception("TODO!");
    }
}