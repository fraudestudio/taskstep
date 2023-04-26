<?php

namespace TaskStep\Logic\Data\MySql\Dao;

use TaskStep\Logic\Data\MySql\Database;
use TaskStep\Logic\Model\{User, Project, ProjectDaoInterface};
use TaskStep\Logic\Exceptions\NotFoundException;
use PDO;

class ProjectDao implements ProjectDaoInterface
{
    public function create(User $user, Project $project) : int
    {
        $result = -1;

        $query = Database::getInstance()->executeNonQuery(
            "INSERT INTO projects (title, user) VALUES (:title, :user)",
            ['title' => $project->title(), 'user' => $user->id()]
        );

        $query = Database::getInstance()->executeQuery("SELECT last_insert_id()");
        $result = $query->fetch()[0];

        return $result;
    }

    public function readById(User $user, int $id) : Project
    {
        $query = Database::getInstance()->executeQuery(
            "SELECT * FROM projects WHERE id = :id AND user = :user",
            ['id' => $id, 'user' => $user->id()]
        );
        
        if ($data = $query->fetch())
        {
            return (new Project($data["id"]))->setTitle($data["title"]);
        }
        else
        {
            throw new NotFoundException();
        }
    }

    public function readAll(User $user) : array
    {
        $result = array();

        $request = "SELECT * FROM projects WHERE user = :user";
        $query = Database::getInstance()->executeQuery($request, array('user'=>$user->id()));

        while($data = $query->fetch()) {
            array_push(
                $result,
                (new Project($data['id']))->setTitle($data['title'])
            );
        }

        return $result;
    }

    public function update(User $user, int $id, Project $project)
    {
        Database::getInstance()->executeNonQuery(
            "UPDATE projects SET title = :title WHERE id = :id AND user = :user",
            ['title' => $project->title(), 'id' => $id, 'user' => $user->id()]
        );
    }

    public function delete(User $user, int $id)
    {
        $request = "DELETE FROM projects WHERE id = :id AND user = :user";
        Database::getInstance()->executeNonQuery($request, array('id'=>$id, 'user'=>$user->id()));
    }
}
