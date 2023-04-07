<?php

namespace TaskStep\Logic\Data\FakeDatabase;

use TaskStep\Logic\Model\{Item, Section, Context, Project, ItemDaoInterface};
use TaskStep\Logic\Data\Database;

class ItemDao implements ItemDaoInterface
{
	public function create(Item $item)
	{
		throw new \Exception("TODO!");
	}

	public function readById(int $id): Item
	{
		throw new \Exception("TODO!");
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