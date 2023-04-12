<?php

namespace TaskStep\Logic\Data\LegacyMySql;

use TaskStep\Logic\Model\{Item, Section, Context, Project, ItemDaoInterface};
use \Exception, \DateTime;

/**
 * Accès au données des items compatible avec la BDD de la version 1.1.
 */
class ItemDao implements ItemDaoInterface
{
	private ContextDao $contexts;
	private ProjectDao $projects;

	public function __construct()
	{
		$this->contexts = new ContextDao();
		$this->projects = new ProjectDao();
	}

	public function hydrate(Item &$item, array $data)
	{
		$item
			->setTitle($data['title'])
			->setDate(new DateTime($data['date']))
			->setNotes($data['notes'])
			->setUrl($data['url'])
			->setSection(Section::from($data['section']))
			->setContext($this->contexts->readByTitle($data['context']))
			->setProject($this->projects->readByTitle($data['project']))
			->setDone($data['done']);
	}

	public function create(Item $item)
	{
		throw new \Exception("TODO!");
	}

	public function readById(int $id): Item
	{
		$statement = Database::instance()->execute('SELECT * FROM items WHERE id = ?', $id);

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

	public function readDaily(DateTime $day): array
	{
		$statement = Database::instance()->execute(
			'SELECT * FROM items WHERE (section = "immediate" OR `date` <= :day) AND done = 0 ORDER BY `date` LIMIT 5',
			day: $day->format('Y-m-d'),
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

	public function countUndone(): int
	{
		$statement = Database::instance()
			->execute('SELECT COUNT(*) FROM items WHERE done = 0');

		if ($row = $statement->fetch())
		{
			return $row[0];
		}
		else
		{
			throw new Exception($statement->errorInfo()[2]);
		}
	}
}