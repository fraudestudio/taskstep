<?php

namespace TaskStep\Logic\Data\MySql\Dao;

use TaskStep\Logic\Data\MySql\Database;
use TaskStep\Logic\Model;
use TaskStep\Logic\Model\Project;
use TaskStep\Logic\Model\ProjectDaoInterface;
use PDO;

class ProjectDAO implements ProjectDaoInterface
{
    
    public function readAll(int $iduser): array
    {
        $result = array();
        $request = "select p.* from projects where p.User = :id";
        $query = Database::getInstance()->executeQuery($request,array('id'=>htmlspecialchars($iduser)));

        $data = $query->fetch(PDO::FETCH_ASSOC);

        while(!is_null($data)){

            $tmp = new Project($data["id"]);
            $tmp->setTitle($data["title"]);
            array_push($result,$tmp);
            $data = $query->fetch(PDO::FETCH_ASSOC);

        }

        return $result;
    }

    public function Create(Project $project) : int
    {
        $result = -1;
        $request = "INSERT into projects(title,user) values (:title,:id);";
        Database::getInstance()->executeNonQuery($request,array('title'=>$project->title(),'id'=>$project->id()));

        $query = Database::getInstance()->executeQuery("Select last_insert_id()");
        $result = $query->fetch(PDO::FETCH_ASSOC)['id'];
        return $result;
    }

    public function readById(int $id): Project
    {
        $result = null;

        $request = "select p.* from projects where id = :id";
        $query = Database::getInstance()->executeQuery($request,array('id'=>$id));
        $data = $query->fetch(PDO::FETCH_ASSOC);

        $result = new Project($data["id"]);
        $result->setTitle($data["title"]);

        return $result;

    }

    public function update(Project $toCopy,int $id)
    {
        $request = "update projects set title = :title where id = :id";
        Database::getInstance()->executeNonQuery($request,array('title'=>$toCopy->title(),'id'=>$id));
    }

    public function Delete(int $id)
    {
        $request = "delete from projects where id = :id";
        Database::getInstance()->executeNonQuery($request,array('id'=>$id));
    }



}
