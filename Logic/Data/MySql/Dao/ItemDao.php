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
			->setDate(is_null($data['date']) ? null : new DateTime($data['date']))
			->setNotes($data['notes'])
			->setUrl($data['url'])
			->setSection(Section::from($data['section']))
			->setContext((new Context($data['cid']))->setTitle($data['ctitle']))
			->setProject((new Project($data['pid']))->setTitle($data['ptitle']))
			->setDone($data['done']);
	}

	public function create(User $user, Item $item): int
	{
		$result = -1;

		Database::GetInstance()->executeNonQuery(
			'INSERT into items(`title`,`date`,`notes`,`url`,`done`,`context`,`section`,`project`,`User`) '.
			'VALUES (:title,:date,:notes,:url,:done,:context,(SELECT id FROM sections WHERE title = :section),:project,:User)',
			[
				'title' => $item->title(),
				'date' => $item->date()?->format('Y-m-d'),
				'notes' => $item->notes(),
				'url' => $item->url(),
				'section' => $item->section()->value,
				'context' => $item->context()->id(),
				'project' => $item->project()->id(),
				'done' => $item->done() ? 1 : 0,
				'User' => $user->id()
			]
		);

        $query = Database::getInstance()->executeQuery("SELECT last_insert_id()");
        $result = $query->fetch()[0];

        return $result;
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
		$statement = Database::GetInstance()->executeQuery(
			<<<'SQL'
				SELECT i.id, i.title, i.date, i.notes, i.url, i.done,
					c.id as cid, c.title as ctitle,
					s.title as section,
					p.id as pid, p.title as ptitle
				FROM items as i
					JOIN contexts as c on i.context=c.id
					JOIN sections as s on i.section=s.id
					JOIN projects as p on i.project=p.id
				WHERE s.title = :title AND i.User = :id
			SQL,
			['title'=> $section->value, 'id'=> $user->id()]
		);

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
		$statement = Database::GetInstance()->executeQuery(
			<<<'SQL'
				SELECT i.id, i.title, i.date, i.notes, i.url, i.done,
					c.id as cid, c.title as ctitle,
					s.title as section,
					p.id as pid, p.title as ptitle
				from items as i
					join contexts as c on i.context=c.id
					join sections as s on i.section=s.id
					join projects as p on i.project=p.id
				where c.id = :idC and i.User = :idU
			SQL,
			array('idC'=> $context->id(),'idU'=> $user->id()));

        $result = [];

        while ($row = $statement->fetch())
        {
        	$item = new Item($row['id']);
        	$this->hydrate($item, $row);
            array_push($result, $item);
        }

        return $result;
	}

	public function readByProject(User $user, Project $project): array
	{
		$statement = Database::GetInstance()->executeQuery(
			<<<'SQL'
				SELECT i.id, i.title, i.date, i.notes, i.url, i.done,
					c.id as cid, c.title as ctitle,
					s.title as section,
					p.id as pid, p.title as ptitle
				FROM items as i
					join contexts as c on i.context=c.id
					join sections as s on i.section=s.id
					join projects as p on i.project=p.id
				where p.id = :idP AND i.User :idU
			SQL,
			array('idP'=>$project->id(), 'idU'=>$user->id())
		);

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
				'date' => $item->date()?->format('Y-m-d'),
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

	public function deleteAllDone(User $user) : int
	{
		Database::GetInstance()->executeNonQuery(
			'DELETE from items where done = 1 and User = :id',
			array('id'=>$user->id())
		);
		return 1;
	}

	public function countUndone(User $user) : int
	{
		$statement = Database::GetInstance()->executeQuery(
			'SELECT COUNT(id) FROM items WHERE done = 0 and User = :id',
			['id'=> $user->id()]
		);

		if ($row = $statement->fetch())
		{
			return $row[0];
		}
		else
		{
			throw new Exception("Item not found");
		}
	}

	public function countBySection(User $user): array
	{
		$statement = Database::GetInstance()->executeQuery(
			'SELECT sections.title AS section, SUM(IF(done=0, 1, 0)) AS undone, SUM(IF(done = 1, 1, 0)) AS done '.
			'FROM (SELECT * FROM items WHERE User = :user) as i RIGHT JOIN sections ON section = sections.id GROUP BY sections.id',
			['user' => $user->id()]
		);

		$result = [];

		while ($row = $statement->fetch())
		{
			$result[$row['section']] = ['done' => $row['done'], 'undone' => $row['undone']];
		}

		return $result;
	}

	public function readByDate(User $user, DateTime $date): array
	{
		$statement = Database::GetInstance()->executeQuery(
			<<<'SQL'
				SELECT i.id, i.title, i.`date`, i.notes, i.url, i.done,
					c.id as cid, c.title as ctitle,
					s.title as section,
					p.id as pid, p.title as ptitle
				FROM items as i
					JOIN contexts as c on i.context=c.id
					JOIN sections as s on i.section=s.id
					JOIN projects as p on i.project=p.id
				WHERE i.`date` = :date and i.User = :user
			SQL,
			['date' => $date->format('Y-m-d'), 'user' => $user->id()]
		);

        $result = [];

        while ($row = $statement->fetch())
        {
        	$item = new Item($row['id']);
        	$this->hydrate($item, $row);
            array_push($result, $item);
        }

        return $result;
	}

	public function readDaily(User $user, DateTime $day): array
	{
		$statement = Database::GetInstance()->executeQuery(
			<<<'SQL'
				SELECT i.id, i.title, i.`date`, i.notes, i.url, i.done,
					c.id AS cid, c.title AS ctitle,
					s.title AS section,
					p.id AS pid, p.title AS ptitle
				FROM items AS i
					JOIN contexts AS c on i.context=c.id
					JOIN sections AS s on i.section=s.id
					JOIN projects AS p on i.project=p.id
				WHERE (i.`date` <= :date OR s.title = 'immediate') AND i.User = :user AND i.done = 0
			SQL,
			['date'=>$day->format('Y-m-d'), 'user'=>$user->id()]
		);

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