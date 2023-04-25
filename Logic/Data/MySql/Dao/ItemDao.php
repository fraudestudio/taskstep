<?php

namespace TaskStep\Logic\Data\MySql\Dao;

use TaskStep\Logic\Model\{Item, Section, Context, Project, ItemDaoInterface};
use TaskStep\Logic\Data\MySql\Database;

use PDO;

class ItemDao implements ItemDaoInterface
{
	public function create(Item $item)
	{
		Database::instance()->execute(
			'INSERT into items(`title`,`date`,`notes`,`url`,`done`,`context`,`section`,`project`,`User`) '.
			'VALUES (:title,:date,:notes,:url,:done,:done,:context,:section,:project,:User)',
			title: $item->title(),
			date: $item->date()?->format('Y-m-d') ?? '0001-01-01',
			notes: $item->notes(),
			url: $item->url(),
			section: $item->section()->value,
			context: $item->context()->title(),
			project: $item->project()->title(),
			done: $item->done() ? 1 : 0,
			User: $item->user_id()
		);
	}

	public function readById(int $id): Item
	{
		$statement = Database::instance()->execute('SELECT i.id,i.title,i.date,i.notes,i.done,c.id,c.title,s.id,s.title,p.id,p.title from items as i join contexts as c on i.context=c.id join sections as s on i.section=s.id join projects as p on i.project=p.id where i.id = "?" ', $id);

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
		$statement = Database::instance()->execute('select i.id,i.title,i.date,i.notes,i.done,c.id,c.title,s.id,s.title,p.id,p.title from items as i join contexts as c on i.context=c.id join sections as s on i.section=s.id join projects as p on i.project=p.id natural join sessions where User = "?"',$user->id());

        $result = [];

        while ($row = $statement->fetch())
        {
        	$item = new Item($row['id']);
        	$this->hydrate($item, $row);
            array_push($result, $item);
        }

        return $result;
	}

	public function readBySection(User $user,Section $section): array
	{
		$statement = Database::instance()->execute('SELECT i.id,i.title,i.date,i.notes,i.done,c.id,c.title,s.id,s.title,p.id,p.title from items as i join contexts as c on i.context=c.id join sections as s on i.section=s.id join projects as p on i.project=p.id where c.id = "?" and i.User = "?" ; ', $section->value, $user->id());

        $result = [];

        while ($row = $statement->fetch())
        {
        	$item = new Item($row['id']);
        	$this->hydrate($item, $row);
            array_push($result, $item);
        }

        return $result;
	}

	public function readByContext(User $user,Context $context): array
	{
		$statement = Database::instance()->execute('select i.id,i.title,i.date,i.notes,i.done,c.id,c.title,s.id,s.title,p.id,p.title from items as i join contexts as c on i.context=c.id join sections as s on i.section=s.id join projects as p on i.project=p.id where c.id = "?" and i.User = "?" ', $context->id(), $user->id());

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
		$statement = Database::instance()->execute('select i.id,i.title,i.date,i.notes,i.done,c.id,c.title,s.id,s.title,p.id,p.title from items as i join contexts as c on i.context=c.id join sections as s on i.section=s.id join projects as p on i.project=p.id where p.id = "?"', $project->title());

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
		Database::instance()->execute(
			'UPDATE items SET title=:title, `date`=:date, notes=:notes, url=:url, '.
			'section=:section, context=:context, project=:project, done=:done, User=:user WHERE id=:id',
			id: $id,
			title: $item->title(),
			date: $item->date()?->format('Y-m-d') ?? '0001-01-01',
			notes: $item->notes(),
			url: $item->url(),
			section: $item->section()->value,
			context: $item->context()->title(),
			project: $item->project()->title(),
			done: $item->done() ? 1 : 0,
			user : $item->user_id()
		);
	}

	public function delete(int $id)
	{
		throw new \Exception("TODO!");
	}
}