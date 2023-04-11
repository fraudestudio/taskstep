<?php

declare(strict_types=1);

namespace TaskStep\Logic\Data\Fake;

use TaskStep\Logic\Model\{Project, ProjectDaoInterface};
use TaskStep\Logic\Data\Database;

class ProjectDao implements ProjectDaoInterface
{
    public function create(Project $project)
    {
        throw new \Exception("TODO!");
    }

    
    public function readById(int $id): Project
    {
        return (new Project($id))->setTitle("Contexte #$id");
    }

    
    public function readAll(): array
    {
        return [
            (new Project(0))->setTitle("Projet 1"), 
            (new Project(1))->setTitle("Projet 2"), 
            (new Project(2))->setTitle("Projet 3"), 
        ];
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