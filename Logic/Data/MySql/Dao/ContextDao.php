<?php

declare(strict_types=1);

namespace TaskStep\Logic\Data\MySql\Dao;

use TaskStep\Logic\Exceptions\NotFoundException;
use TaskStep\Logic\Model\{Context, ContextDaoInterface, User};
use TaskStep\Logic\Data\MySql\Database;

use PDO;

class ContextDao implements ContextDaoInterface
{
    public function create(User $user, Context $project) : int
    {
        $result = -1;

        Database::getInstance()->executeNonQuery(
            "INSERT INTO contexts (title, User) VALUES (:title, :user)",
            ['title' => $project->title(), 'user' => $user->id()]
        );

        $query = Database::getInstance()->executeQuery("SELECT last_insert_id()");
        $result = $query->fetch()[0];

        return $result;
    }

    public function readById(User $user, int $id) : Context
    {
        $query = Database::getInstance()->executeQuery(
            "SELECT * FROM contexts WHERE id = :id AND User = :user",
            ['id' => $id, 'user' => $user->id()]
        );
        
        if ($data = $query->fetch())
        {
            return (new Context($data["id"]))->setTitle($data["title"]);
        }
        else
        {
            throw new NotFoundException();
        }
    }

    public function readAll(User $user) : array
    {
        $result = array();

        $request = "SELECT * FROM contexts WHERE User = :user";
        $query = Database::getInstance()->executeQuery($request, array('user'=>$user->id()));

        while($data = $query->fetch())
        {
            array_push(
                $result,
                (new Context($data['id']))->setTitle($data['title'])
            );
        }

        return $result;
    }

    public function update(User $user, int $id, Context $project)
    {
        $rowCount = Database::getInstance()->executeNonQuery(
            "UPDATE contexts SET title = :title WHERE id = :id AND User = :user",
            ['title' => $project->title(), 'id' => $id, 'user' => $user->id()]
        );

        if ($rowCount != 1) throw new NotFoundException();
    }

    public function delete(User $user, int $id)
    {
        $rowCount = Database::getInstance()->executeNonQuery(
            "DELETE FROM contexts WHERE id = :id AND user = :user",
            ['id' => $id, 'user' => $user->id()]
        );

        if ($rowCount != 1) throw new NotFoundException();
    }
}