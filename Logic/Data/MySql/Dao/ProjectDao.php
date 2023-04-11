<?php

namespace TaskStep\Data\Dao;

use TaskStep\Data\Database;
use TaskStep\Logic\Model;
use TaskStep\Logic\Model\Project;
use TaskStep\Logic\Model\ProjectDaoInterface;
use PDO;

class ProjectDAO implements ProjectDaoInterface
{
    
    public function GetAll(int $iduser): array
    {
        $result = array();
        $request = "select p.* from projects where p.User = :id";
        $query = Database::getInstance()->executeQuery($request,array('id'=>htmlspecialchars($iduser)));

        $data = $query->fetch(PDO::FETCH_ASSOC);

        while(!is_null($data)){

            $tmp = new Project($data["title"],$data["id"]);
            array_push($result,$tmp);
            $data = $query->fetch(PDO::FETCH_ASSOC);

        }

        return $result;
    }

    public function Create(Project $project) : int
    {
        $result = -1;
        $request = "INSERT into projects(title,user) values (:title,:id);";
        $query = Database::getInstance()->executeNonQuery($request,array('title'=>$project->title(),'id'=>$project->id()));

        $query = Database::getInstance()->executeQuery("Select last_insert_id()");
        $result = $query->fetch(PDO::FETCH_ASSOC)['id'];
        return $result;
    }

    public function GetProject(int $id): Project
    {
        $result = null;

        $request = "select p.* from projects where id = :id";
        $query = Database::getInstance()->executeQuery($request,array('id'=>$id));
        $data = $query->fetch(PDO::FETCH_ASSOC);

        $result = new Project($data["title"],$data["id"]);

        return $result;

    }

    public function Update(Project $toCopy,int $id)
    {
        $request = "update projects set title = :title where id = :id";
        Database::getInstance()->executeNonQuery($request,array('title'=>$toCopy->title(),'id'=>$id));
    }



}
