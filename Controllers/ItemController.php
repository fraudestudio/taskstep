<?php

declare(strict_types=1);

namespace TaskStep\Controllers;

use TaskStep\Logic\Model\Item;
use TaskStep\Logic\Model\ItemDaoInterface;
use TaskStep\Logic\Exceptions\NotFoundException;
use TaskStep\Middleware\Helpers\{Context, Services};

class ItemController extends Controller
{
	private ItemDaoInterface $itemDao;

	public function __construct(Context $context, Services $container)
	{
		parent::__construct($context, $container);

		$this->itemDao = $container->get('ItemDao');
	}

	/**
	 * Récupère tous les items de l'utilisateur connecté.
	 */
	public function getAll()
	{
		$projects = $this->itemDao->readAll($this->requireUser());

		$this->jsonResponse($projects);
	}

	public function post()
	{
		$project = $this->requireBodyObject(Item::class);

		$id = $this->itemDao->create($project);

		$this->createdResponse('item', ['id' => $id]);
	}

}