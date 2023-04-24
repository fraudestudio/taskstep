<?php

namespace TaskStep\Logic\Data\Fake;

use TaskStep\Logic\Model\{Item, Section, Context, Project, ItemDaoInterface};

class ItemDao implements ItemDaoInterface
{
	public function create(Item $item)
	{
		throw new \Exception("TODO!");
	}

	public function readById(int $id): Item
	{
		return (new Item($id))
			->setTitle("Titre")
			->setUrl("https://oomfnetwork.fr")
			->setContext((new ContextDao)->readById(1))
			->setProject((new ProjectDao)->readById(1));
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
		throw new \Exception("TODO!");
	}

	public function delete(int $id)
	{
		throw new \Exception("TODO!");
	}
}