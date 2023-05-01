<?php

declare(strict_types=1);

namespace TaskStepApi\Controllers;

use DateTime;
use TaskStep\Logic\Model\ItemDaoInterface;
use TaskStep\Logic\Exceptions\NotFoundException;
use TaskStep\Logic\Model\{Item, Project, Section, Context, Compare};
use TaskStepApi\Middleware\Helpers;

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
		// sélection des items. tous les filtres sont exclusifs
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
		else if ($this->getString('date', $date))
		{
			$date = new DateTime($date);
			$items = $this->itemDao->readByDate($this->requireUser(), $date);
		}
		else
		{
			$items = $this->itemDao->readAll($this->requireUser());
		}

		// tri des items
		$this->getString('sort', $sort);
		switch ($sort)
		{
		case 'title':
			usort($items, Compare::BY_TITLE);
			break;
		case 'date':
			usort($items, Compare::BY_DATE);
			break;
		case 'context':
			usort($items, Compare::BY_CONTEXT);
			break;
		case 'project':
			usort($items, Compare::BY_PROJECT);
			break;
		case 'done':
			usort($items, Compare::UNDONE_FIRST);
			break;
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
	 * Supprime tous les items terminés.
	 */
	public function deleteAllDone()
	{
		$count = $this->itemDao->deleteAllDone($this->requireUser());

		$this->jsonResponse($count);
	}

	public function getDaily()
	{
		$date = new DateTime($this->requireString('date'));

		$daily = $this->itemDao->readDaily($this->requireUser(), $date);
		$this->jsonResponse($daily);
	}

	public function countUndone()
	{
		$undone = $this->itemDao->countUndone($this->requireUser());

		$this->jsonResponse($undone);
	}
	
	public function countBySection()
	{
		$sections = $this->itemDao->countBySection($this->requireUser());

		$this->jsonResponse($sections);
	}
}