<?php

declare(strict_types=1);

namespace TaskStep\Controllers;

use DateTime;
use TaskStep\Logic\Model\ItemDaoInterface;
use TaskStep\Logic\Exceptions\NotFoundException;
use TaskStep\Logic\Model\{Item, Project, Section, Context};
use TaskStep\Middleware\Helpers;

class ItemController extends Controller
{
	private ItemDaoInterface $itemDao;

	public function __construct(Helpers\Context $context, Helpers\Services $container)
	{
		parent::__construct($context, $container);

		$this->itemDao = $container->get('itemDao');
	}

	/**
	 * Récupère tous les items de l'utilisateur connecté.
	 */
	public function getAll()
	{
		if ($this->getString('section', $section))
		{
			$section = Section::from($section);
			$items = $this->itemDao->readBySection($this->requireUser(), $section);
		}
		else if ($this->getInt('project', $project))
		{
			$project = new Project($project);
			$items = $this->itemDao->readByProject($this->requireUser(), $project);
		}
		else if ($this->getInt('context', $context))
		{
			$context = new Context($context);
			$items = $this->itemDao->readByContext($this->requireUser(), $context);
		}
		else
		{
			$items = $this->itemDao->readAll($this->requireUser());
		}

		$this->jsonResponse($items);
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
		$undone = $this->itemDao->countUndone($this->requireUser());

		$this->jsonResponse($undone);
	}
	
	public function countBySection()
	{
		$id = $this->requireInt('id');

		try
		{
			$item = $this->itemDao->countBySection();
		}
		catch (NotFoundException)
		{
			$this->notFound();
		}

		$this->jsonResponse($item);
	}
}