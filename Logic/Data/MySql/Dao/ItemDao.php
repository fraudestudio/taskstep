<?php

namespace TaskStep\Logic\Data\MySql\Dao;

use DateTime;
use TaskStep\Logic\Model\{Item, Section, Context, Project, ItemDaoInterface, User};
use TaskStep\Logic\Exceptions\NotFoundException;
use TaskStep\Logic\Data\MySql\Database;

class ItemDao implements ItemDaoInterface
{

	public function hydrate(Item $item, array $data)
	{
		$item
			->setTitle($data['title'])
			->setDate($data['date'] == '0001-01-01' ? null : new DateTime($data['date']))
			->setNotes($data['notes'])
			->setUrl($data['url'])
			->setSection(Section::from($data['section']))
			->setContext((new Context($data['cid']))->setTitle($data['ctitle']))
			->setProject((new Project($data['pid']))->setTitle($data['ptitle']))
			->setDone($data['done']);
	}

	public function create(User $user, Item $item)
	{
		Database::GetInstance()->executeNonQuery(
			'INSERT into items(`title`,`date`,`notes`,`url`,`done`,`context`,`section`,`project`,`User`) '.
			'VALUES (:title,:date,:notes,:url,:done,:context,(SELECT id FROM sections WHERE title = :section),:project,:User)',
			[
				'title' => $item->title(),
				'date' => $item->date()?->format('Y-m-d H:i:s') ?? '0001-01-01',
				'notes' => $item->notes(),
				'url' => $item->url(),
				'section' => $item->section()->value,
				'context' => $item->context()->id(),
				'project' => $item->project()->id(),
				'done' => $item->done() ? 1 : 0,
				'User' => $user->Id()
			]
		);
	}

	public function readById(User $user, int $id): Item
	{
		$statement = Database::GetInstance()->executeQuery(
			'SELECT i.id, i.title, i.date, i.notes, i.url, i.done, c.id as cid, c.title as ctitle, s.title as section, p.id as pid, p.title as ptitle '.
			'FROM items as i join contexts as c on i.context=c.id join sections as s on i.section=s.id '.
			'JOIN projects as p on i.project=p.id where i.User = :user AND i.id = :id',
			['id' => $id, 'user' => $user->id()]
		);

		if ($row = $statement->fetch())
		{
			$item = new Item($id);
			$this->hydrate($item, $row);
			return $item;
		}
		else
		{
			throw new NotFoundException;
		}
	}

	public function readAll(User $user): array
	{
		$statement = Database::GetInstance()->executeQuery(
			'SELECT i.id, i.title, i.date, i.notes, i.url, i.done, c.id as cid, c.title as ctitle, s.title as section, p.id as pid, p.title as ptitle '.
			'FROM items as i join contexts as c on i.context=c.id join sections as s on i.section=s.id '.
			'JOIN projects as p on i.project=p.id where i.User = :id',
			['id' => $user->id()]
		);

        $result = [];

        while ($row = $statement->fetch())
        {
        	$item = new Item($row[0]);
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
		$statement = Database::GetInstance()->executeQuery('select i.id,i.title,i.date,i.notes,i.done,c.id,c.title,s.id,s.title,p.id,p.title from items as i join contexts as c on i.context=c.id join sections as s on i.section=s.id join projects as p on i.project=p.id where c.id = ":idC" and i.User = ":idU" ', array('idC'=> $context->id(),'idU'=> $user));

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

	public function update(User $user, int $id, Item $item)
	{
		$result = Database::GetInstance()->executeNonQuery(
			'UPDATE items SET title=:title, `date`=:date, notes=:notes, url=:url, section=(SELECT id FROM sections WHERE title = :section), context=:context, project=:project, done=:done WHERE id=:id AND User=:user',
			[
				'id'=> $id,
				'title'=> $item->title(),
				'date' => $item->date()?->format('Y-m-d') ?? '0001-01-01',
				'notes' => $item->notes(),
				'url' => $item->url(),
				'section' => $item->section()->value,
				'context' => $item->context()->id(),
				'project' => $item->project()->id(),
				'done' => $item->done() ? 1 : 0,
				'user' => $user->id()
			]
		);

		if ($result != 1) throw new NotFoundException();
	}

	public function delete(User $user, int $id)
	{
		$result = Database::GetInstance()->executeNonQuery(
			'DELETE from items where id = :id AND user = :user',
			array('id'=>$id, 'user'=>$user->id())
		);
		
		if ($result != 1) throw new NotFoundException();
	}

	public function deleteAllDone(int $id) : int
	{
		Database::GetInstance()->executeNonQuery(
			'DELETE from items where done = 1 and User = ":id"',
			array('id'=>$id)
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

	public function readByDate(DateTime $date,int $user): array
	{
		$statement = Database::GetInstance()->executeQuery('select i.id,i.title,i.date,i.notes,i.done,c.id,c.title,s.id,s.title,p.id,p.title from items as i where i.date = ":date" and i.User = ":user"',array('date'=>$date,'user'=>$user));

        $result = [];

        while ($row = $statement->fetch())
        {
        	$item = new Item($row['id']);
        	$this->hydrate($item, $row);
            array_push($result, $item);
        }

        return $result;
	}

	public function readDaily(DateTime $day,int $user): array
	{
		$statement = Database::GetInstance()->executeQuery('select i.id,i.title,i.date,i.notes,i.done,c.id,c.title,s.id,s.title,p.id,p.title from items as i join contexts as c on i.context=c.id join sections as s on i.section=s.id join projects as p on i.project=p.id where i.date = ":date" and s.title = "immediate" and i.User = ":user" ',array('date'=>$day, 'user'=>$user));

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