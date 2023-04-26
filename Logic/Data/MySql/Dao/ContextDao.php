<?php

declare(strict_types=1);

namespace TaskStep\Logic\Data\MySql\Dao;

use TaskStep\Logic\Exceptions\NotFoundException;
use TaskStep\Logic\Model\{Context, ContextDaoInterface, User};
use TaskStep\Logic\Data\MySql\Database;

use PDO;

class ContextDao implements ContextDaoInterface
{
    public function create(User $user,Context $context) : int
    {
        Database::getInstance()->executeNonQuery(
            'insert into contexts(title,user) values (:title,:id)',
            array('title'=>$context->title(),'id'=>$user->Id())
        );

        $answer = Database:: getInstance()->executeQuery('select last_insert_id()')->fetch(PDO::FETCH_ASSOC);

        return $answer['id'];
    }

    
    public function readById(User $user,int $id): Context
    {
        $data = Database::getInstance()->executeQuery(
            'SELECT c.* from contexts as c where c.User = :id and c.id = :idcontext',
            array('id'=>$user->id(),'idcontext'=>$id)
        )->fetch(PDO::FETCH_ASSOC);

        if(is_null($data)){
            throw new NotFoundException();
        }else{
            $tmp = new Context($data["id"]);
            $tmp->setTitle($data["title"]);
            return $tmp;
        }

    }

    
    public function readAll(User $user): array
    {
        $answer = Database::getInstance()->executeQuery('select c.* from contexts as c where c.User = :id',array('id'=>$user->Id()));
        $result = [];
        $data = $answer->fetch(PDO::FETCH_ASSOC);

        while($data != null){
            $tmp = new Context($data["id"]);
            $tmp->setTitle($data["title"]);
            array_push($result,$tmp);
            $data = $answer->fetch(PDO::FETCH_ASSOC);
        }

        return $result;
    }

    
    public function update(int $id, Context $context)
    {
        Database::getInstance()->executeNonQuery('update contexts set title = :context where id = :id',array('context'=>$context->title(),'id'=>$id));
    }

    
    public function delete(int $id)
    {
        Database::getInstance()->executeNonQuery('delete from contexts where id = :id',array('id'=>$id));
    }
}