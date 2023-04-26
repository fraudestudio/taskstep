<?php

namespace TaskStep\Logic\Data\Dao;

use DateTime;
use TaskStep\Logic\Model\{Item, Section, Context, Project, ItemDaoInterface,User};
use TaskStep\Logic\Data\MySql\Database;


use Exception;
class ItemDao implements ItemDaoInterface
{

	public function hydrate(Item &$item, array $data)
	{
		$item
			->setTitle($data['title'])
			->setDate($data['date'] == '0001-01-01' ? null : new DateTime($data['date']))
			->setNotes($data['notes'])
			->setUrl($data['url'])
			->setSection(Section::from($data['section']))
			->setContext($data['context'])
			->setProject($data['project'])
			->setDone($data['done'])
			->setUserId($data['user_id']);
	}

	public function create(Item $item)
	{
		Database::GetInstance()->executeNonQuery(
			'INSERT into items(`title`,`date`,`notes`,`url`,`done`,`context`,`section`,`project`,`User`) '.
			'VALUES (:title,:date,:notes,:url,:done,:done,:context,:section,:project,:User)',
			array('title'=> $item->title(),
			'date'=> $item->date()?->format('Y-m-d'),
			'notes'=> $item->notes(),
			'url'=> $item->url(),
			'section'=> $item->section()->value,
			'context'=> $item->context()->title(),
			'project'=> $item->project()->title(),
			'done'=> $item->done() ? 1 : 0,
			'User'=> $item->user_id())
		);
	}

	public function readById(int $id): Item
	{
		$statement = Database::GetInstance()->executeQuery('SELECT i.id,i.title,i.date,i.notes,i.done,c.id,c.title,s.id,s.title,p.id,p.title from items as i join contexts as c on i.context=c.id join sections as s on i.section=s.id join projects as p on i.project=p.id where i.id = :id ',array('id'=> $id));

		if ($row = $statement->fetch())
		{
			$item = new Item($id);
			$this->hydrate($item, $row);
			return $item;
		}
		else
		{
			throw new Exception("Item not found");
		}
	}

	public function readAll(User $user): array
	{
		$statement = Database::GetInstance()->executeQuery('select i.id,i.title,i.date,i.notes,i.done,c.id,c.title,s.id,s.title,p.id,p.title from items as i join contexts as c on i.context=c.id join sections as s on i.section=s.id join projects as p on i.project=p.id natural join sessions where User = ":id"',array('id'=> $user->id()));

        $result = [];

        while ($row = $statement->fetch())
        {
        	$item = new Item($row['id']);
        	$this->hydrate($item, $row);
            array_push($result, $item);
        }

        return $result;
	}

	public function readBySection(User $user, Section $section): array
	{
		$statement = Database::GetInstance()->executeQuery('SELECT i.id,i.title,i.date,i.notes,i.done,c.id,c.title,s.id,s.title,p.id,p.title from items as i join contexts as c on i.context=c.id join sections as s on i.section=s.id join projects as p on i.project=p.id where s.title = ":title" and i.User = ":id" ; ', array('title'=> $section->value, 'id'=> $user->id()));

        $result = [];

        while ($row = $statement->fetch())
        {
        	$item = new Item($row['id']);
        	$this->hydrate($item, $row);
            array_push($result, $item);
        }

        return $result;
	}

	public function readByContext(User $user, Context $context): array
	{
		$statement = Database::GetInstance()->executeQuery('select i.id,i.title,i.date,i.notes,i.done,c.id,c.title,s.id,s.title,p.id,p.title from items as i join contexts as c on i.context=c.id join sections as s on i.section=s.id join projects as p on i.project=p.id where c.id = ":idC" and i.User = ":idU" ', array('idC'=> $context->id(),'idU'=> $user->id()));

        $result = [];

        while ($row = $statement->fetch())
        {
        	$item = new Item($row['id']);
        	$this->hydrate($item, $row);
            array_push($result, $item);
        }

        return $result;
	}

	public function readByProject(Project $project): array
	{
		$statement = Database::GetInstance()->executeQuery('select i.id,i.title,i.date,i.notes,i.done,c.id,c.title,s.id,s.title,p.id,p.title from items as i join contexts as c on i.context=c.id join sections as s on i.section=s.id join projects as p on i.project=p.id where p.id = ":id"', array('id'=>$project->id()));

        $result = [];

        while ($row = $statement->fetch())
        {
        	$item = new Item($row['id']);
        	$this->hydrate($item, $row);
            array_push($result, $item);
        }

        return $result;
	}

	public function update(int $id, Item $item)
	{
		Database::GetInstance()->executeNonQuery(
			'UPDATE items SET title=:title, `date`=:date, notes=:notes, url=:url, '.
			'section=:section, context=:context, project=:project, done=:done, User=:user WHERE id=:id',
			array('id'=> $id,
			'title'=> $item->title(),
			'date' => $item->date()?->format('Y-m-d') ?? '0001-01-01',
			'notes' => $item->notes(),
			'url' => $item->url(),
			'section' => $item->section()->value,
			'context' => $item->context()->title(),
			'project' => $item->project()->title(),
			'done' => $item->done() ? 1 : 0,
			'user' => $item->user_id())
		);
	}

	public function delete(int $id)
	{
		Database::GetInstance()->executeNonQuery(
			'DELETE from items where id = ":id"',
			array('id'=>$id)
		);
	}

	public function deleteAllDone() : int
	{
		Database::GetInstance()->executeNonQuery(
			'DELETE from items where done = 1',
		);
		return 1;
	}



	public function countUndone(int $id): int
	{
		$statement = Database::GetInstance()->executeQuery('select COUNT(*) from item where done = 0 and User = ":id"',array('id'=> $id));

		if ($row = $statement->fetch())
		{
			return $row;
		}
		else
		{
			throw new Exception("Item not found");
		}
	}

	public function countBySection(int $id): array
	{
		$statement = Database::GetInstance()->executeQuery('select COUNT(*) from item where done = 0 and User = ":id" order by section',array('id'=> $id));

		if ($row = $statement->fetch())
		{
			return $row;
		}
		else
		{
			throw new Exception("Item not found");
		}
	}

	public function readByDate(DateTime $date): array
	{
		$statement = Database::GetInstance()->executeQuery('select i.id,i.title,i.date,i.notes,i.done,c.id,c.title,s.id,s.title,p.id,p.title from items as i where i.date = ":date"',array('date'=>$date));

        $result = [];

        while ($row = $statement->fetch())
        {
        	$item = new Item($row['id']);
        	$this->hydrate($item, $row);
            array_push($result, $item);
        }

        return $result;
	}

	public function readDaily(DateTime $day): array
	{
		$statement = Database::GetInstance()->executeQuery('select i.id,i.title,i.date,i.notes,i.done,c.id,c.title,s.id,s.title,p.id,p.title from items as i join contexts as c on i.context=c.id join sections as s on i.section=s.id join projects as p on i.project=p.id where i.date = ":date" and s.title = "immediate" ',array('date'=>$day));

        $result = [];

        while ($row = $statement->fetch())
        {
        	$item = new Item($row['id']);
        	$this->hydrate($item, $row);
            array_push($result, $item);
        }

        return $result;
	}
}