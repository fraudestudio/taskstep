<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

interface ItemDaoInterface
{
	public function create(Item $item);

	public function readOne(int $id): Item;

	public function readAll(User $user): array;

	public function update(int $id, Item $item);

	public function delete(int $id);
}