<?php

namespace TaskStep\Logic\Data\LegacyMySql;

use TaskStep\Logic\Model\{Item, Section, Context, Project, ItemDaoInterface};
use \Exception, \DateTime;

class ItemDao implements ItemDaoInterface
{
	private ContextDao $contexts;
	private ProjectDao $projects;

	public function __construct()
	{
		$this->contexts = new ContextDao();
		$this->projects = new ProjectDao();
	}

	public function create(Item $item)
	{
		throw new \Exception("TODO!");
	}

	public function readById(int $id): Item
	{
		$statement = Database::instance()
			->execute('SELECT * FROM items WHERE id = ?', $id);

		if ($row = $statement->fetch())
		{
			return (new Item($id))
				->setTitle($row['title'])
				->setDate(new DateTime($row['date']))
				->setNotes($row['notes'])
				->setUrl($row['url'])
				->setSection(Section::from($row['section']))
				->setContext($this->contexts->readByTitle($row['context']))
				->setProject($this->projects->readByTitle($row['project']))
				->setDone($row['done']);
		}
		else
		{
			throw new Exception("Item not found");
		}
	}

	public function readAll(): array
	{
		throw new \Exception("TODO!");
	}

	public function readBySection(Section $section): array
	{
		throw new \Exception("TODO!");
	}

	public function readByContext(Context $context): array
	{
		throw new \Exception("TODO!");
	}

	public function readByProject(Project $project): array
	{
		throw new \Exception("TODO!");
	}

	public function update(int $id, Item $item)
	{
		Database::instance()->execute(
			'UPDATE items SET title=:title, `date`=:date, notes=:notes, url=:url, '.
			'section=:section, context=:context, project=:project, done=:done WHERE id=:id',
			id: $id,
			title: $item->title(),
			date: $item->date()->format('Y-m-d'),
			notes: $item->notes(),
			url: $item->url(),
			section: $item->section()->value,
			context: $this->contexts->readById($item->context()->id())->title(),
			project: $this->projects->readById($item->project()->id())->title(),
			done: $item->done() ? 1 : 0
		);
	}

	public function delete(int $id)
	{
		throw new \Exception("TODO!");
	}
}