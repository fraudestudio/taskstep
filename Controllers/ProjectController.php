<?php

declare(strict_types=1);

namespace TaskStep\Controllers;

use TaskStep\Logic\Model\Project;
use TaskStep\Logic\Model\ProjectDaoInterface;
use TaskStep\Logic\Exceptions\NotFoundException;
use TaskStep\Middleware\Helpers\{Context, Services};

class ProjectController extends Controller
{
	private ProjectDaoInterface $projectDao;

	public function __construct(Context $context, Services $container)
	{
		parent::__construct($context, $container);

		$this->projectDao = $container->get('projectDao');
	}

	/**
	 * Récupère tous les projets de l'utilisateur connecté.
	 */
	public function getAll() {
		$projects = $this->projectDao->readAll($this->requireUser());

		$this->jsonResponse($projects);
	}

	/**
	 * Crée un projet associé à l'utilisateur connecté.
	 */
	public function post() {
		$project = $this->requireBodyObject(Project::class);

		$id = $this->projectDao->create($this->requireUser(), $project);

		$this->createdResponse('project', ['id' => $id]);
	}

	/**
	 * Récupère un projet.
	 */
	public function getOne() {
		$id = $this->requireInt('id');

		try
		{
			$project = $this->projectDao->readById($this->requireUser(), $id);
		}
		catch (NotFoundException)
		{
			$this->notFound();
		}

		$this->jsonResponse($project);
	}
}