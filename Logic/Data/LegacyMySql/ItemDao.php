<?php

namespace TaskStep\Logic\Data\LegacyMySql;

use TaskStep\Logic\Model\{Item, USer, Section, Context, Project, ItemDaoInterface};
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
			->setDate($data['date'] == '0001-01-01' ? null : new DateTime($data['date']))
			->setNotes($data['notes'])
			->setUrl($data['url'])
			->setSection(Section::from($data['section']))
			->setContext($this->contexts->readByTitle($data['context']))
			->setProject($this->projects->readByTitle($data['project']))
			->setDone($data['done']);
	}

	public function create(User $user, Item $item)
	{
		Database::instance()->execute(
			'INSERT INTO items (title, `date`, notes, url, section, context, project, done) '.
			'VALUES (:title, :date, :notes, :url, :section, :context, :project, :done)',
			title: $item->title(),
			date: $item->date()?->format('Y-m-d') ?? '0001-01-01',
			notes: $item->notes(),
			url: $item->url(),
			section: $item->section()->value,
			context: $item->context()->title(),
			project: $item->project()->title(),
			done: $item->done() ? 1 : 0
		);
	}

	public function readById(User $user, int $id): Item
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

	public function readAll(User $user): array
	{
        $statement = Database::instance()->execute('SELECT * FROM items');

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
        $statement = Database::instance()->execute('SELECT * FROM items WHERE section = ?', $section->value);

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
        $statement = Database::instance()->execute('SELECT * FROM items WHERE context = ?', $context->title());

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
        $statement = Database::instance()->execute('SELECT * FROM items WHERE project = ?', $project->title());

        $result = [];

        while ($row = $statement->fetch())
        {
        	$item = new Item($row['id']);
        	$this->hydrate($item, $row);
            array_push($result, $item);
        }

        return $result;
	}

	public function readByDate(DateTime $date): array
	{
		$statement = Database::instance()->execute(
			'SELECT * FROM items WHERE `date` = :date',
			date: $date->format('Y-m-d'),
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

	public function readDaily(DateTime $date): array
	{
		$statement = Database::instance()->execute(
			'SELECT * FROM items WHERE (section = "immediate" OR `date` <= :date) AND done = 0 ORDER BY `date` LIMIT 5',
			date: $date->format('Y-m-d'),
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
		Database::instance()->execute(
			'UPDATE items SET title=:title, `date`=:date, notes=:notes, url=:url, '.
			'section=:section, context=:context, project=:project, done=:done WHERE id=:id',
			id: $id,
			title: $item->title(),
			date: $item->date()?->format('Y-m-d') ?? '0001-01-01',
			notes: $item->notes(),
			url: $item->url(),
			section: $item->section()->value,
			context: $item->context()->title(),
			project: $item->project()->title(),
			done: $item->done() ? 1 : 0
		);
	}

	public function delete(User $user, int $id)
	{
		Database::instance()->execute('DELETE FROM items WHERE id = ?', $id);
	}

	public function deleteAllDone(int $id): int
	{
		$statement = Database::instance()->execute('DELETE FROM items WHERE done = 1');
		return $statement->rowCount();
	}

	public function countUndone(int $id): int
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

	public function countBySection(int $id): array
	{
		$statement = Database::instance()->execute(
			'SELECT sections.title AS section, SUM(IF(done=0, 1, 0)) AS undone, SUM(IF(done = 1, 1, 0)) AS done '.
			'FROM items RIGHT JOIN sections ON section = sections.title GROUP BY sections.title'
		);

		$result = [];

		while ($row = $statement->fetch())
		{
			$result[$row['section']] = ['done' => $row['done'], 'undone' => $row['undone']];
		}

		return $result;
	}
}