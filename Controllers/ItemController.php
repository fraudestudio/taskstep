<?php

declare(strict_types=1);

namespace TaskStep\Controllers;

use DateTime;
use TaskStep\Logic\Model\Item;
use TaskStep\Logic\Model\ItemDaoInterface;
use TaskStep\Logic\Exceptions\NotFoundException;
use TaskStep\Logic\Model\Project;
use TaskStep\Middleware\Helpers\{Context, Services};

class ItemController extends Controller
{
	private ItemDaoInterface $itemDao;

	public function __construct(Context $context, Services $container)
	{
		parent::__construct($context, $container);

		$this->itemDao = $container->get('itemDao');
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

		$id = $this->itemDao->create($this->requireUser(), $item);

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
			$item = $this->itemDao->readById($this->requireUser(), $id);
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
			$this->itemDao->update($this->requireUser(), $id, $item);
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
			$project = $this->itemDao->delete($this->requireUser(), $id);
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

	public function GetAllFromProjet()
	{
		$projet = $this->requireBodyObject(Project::class);

		try
		{
			$item = $this->itemDao->readByProject($projet);
		}
		catch (NotFoundException)
		{
			$this->notFound();
		}

		$this->jsonResponse($item);

	}

	public function Readbydate()
	{
		$date = $this->requireBodyObject(DateTime::class);
		$id = $this->requireInt('id');

		try
		{
			$item = $this->itemDao->readByDate($date,$id);
		}
		catch (NotFoundException)
		{
			$this->notFound();
		}

		$this->jsonResponse($item);
	}

	public function ReadDaily()
	{
		$date = $this->requireBodyObject(DateTime::class);
		$id = $this->requireInt('id');

		try
		{
			$item = $this->itemDao->readDaily($date,$id);
		}
		catch (NotFoundException)
		{
			$this->notFound();
		}

		$this->jsonResponse($item);
	}

	public function countUndone()
	{
		$id = $this->requireInt('id');

		try
		{
			$item = $this->itemDao->countUndone($id);
		}
		catch (NotFoundException)
		{
			$this->notFound();
		}

		$this->jsonResponse($item);
	}
	
	public function countBySection()
	{
		$id = $this->requireInt('id');

		try
		{
			$item = $this->itemDao->countBySection($id);
		}
		catch (NotFoundException)
		{
			$this->notFound();
		}

		$this->jsonResponse($item);
	}
}