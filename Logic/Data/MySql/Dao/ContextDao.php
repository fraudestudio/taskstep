<?php

declare(strict_types=1);

namespace TaskStep\Logic\Data\Dao;

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
        $reader = Database::getInstance()
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