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

	/**
	 * Crée un item associé à l'utilisateur connecté 
	 */
	public function post()
	{
		$item = $this->requireBodyObject(Item::class);

		$id = $this->itemDao->create($item, $this->requireUser());

		$this->createdResponse('item', ['id' => $id]);
	}

	/**
	 * Récupère un Item.
	 */
	public function getOne()
	{
		$id = $this->requireInt('id');

		try
		{
			$item = $this->itemDao->readById($id);
		}
		catch (NotFoundException)
		{
			$this->notFound();
		}

		$this->jsonResponse($item);
	}

	/**
	 * Modifie un projet.
	 */
	public function putOne()
	{
		$id = $this->requireInt('id');
		$item = $this->requireBodyObject(Item::class);
		
		try
		{
			$this->itemDao->update($id, $item);
		}
		catch (NotFoundException)
		{
			$this->notFound();
		}

		$this->okResponse();
	}

	/**
	 * Supprime un item.
	 */
	public function deleteOne()
	{
		$id = $this->requireInt('id');

		try
		{
			$project = $this->itemDao->delete($id);
		}
		catch (NotFoundException)
		{
			$this->notFound();
		}

		$this->okResponse();
	}

	/**
	 * Supprime un item.
	 */
	public function deleteAllDone()
	{
		$id = $this->requireInt('id');

		try
		{
			$project = $this->itemDao->deleteAllDone($id);
		}
		catch (NotFoundException)
		{
			$this->notFound();
		}

		$this->okResponse();
	}

	public function GetAllFromContexte()
	{
		$id = $this->requireInt('id');
		$context = $this->requireBodyObject(Context::class);

		try
		{
			$item = $this->itemDao->readByContext($id,$context);
		}
		catch (NotFoundException)
		{
			$this->notFound();
		}

		$this->jsonResponse($item);

	}

}