<?php

declare(strict_types=1);

namespace TaskStep\Logic\Data\FakeDatabase;

use TaskStep\Logic\Model\{Context, ContextDaoInterface};
use TaskStep\Logic\Data\Database;

class ContextDao implements ContextDaoInterface
{
    public function create(Context $context)
    {
        throw new \Exception("TODO!");
    }

    
    public function readById(int $id): Context
    {
        throw new \Exception("TODO!");
    }

    
    public function readAll(): array
    {
        return [
            (new Context(0))->setTitle("Contexte 1"), 
            (new Context(1))->setTitle("Contexte 2"), 
            (new Context(2))->setTitle("Contexte 3"), 
        ];
    }

    
    public function update(int $id, Context $context)
    {
        throw new \Exception("TODO!");
    }

    
    public function delete(int $id)
    {
        throw new \Exception("TODO!");
    }
}