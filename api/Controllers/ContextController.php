<?php

declare(strict_types=1);

namespace TaskStepApi\Controllers;

use TaskStep\Logic\Model\{Context, Compare};
use TaskStep\Logic\Model\ContextDaoInterface;
use TaskStep\Logic\Exceptions\NotFoundException;
use TaskStepApi\Middleware\Helpers;

class ContextController extends Controller
{
	private ContextDaoInterface $contextDao;

	public function __construct(Helpers\Context $context, Helpers\Services $container)
	{
		parent::__construct($context, $container);

		$this->contextDao = $container->get('contextDao');
	}

    /**
     * Récupere tout les contextes d'un utilisateur
     */
    public function getAll()
    {
    	$contexts = $this->contextDao->readAll($this->requireUser());
        usort($contexts, Compare::BY_TITLE);

        $this->jsonResponse($contexts);
    }

    /**
     * Créer un Context en base de données
     */
    public function post()
    {
        $context = $this->requireBodyObject(Context::class);

        $id = $this->contextDao->create($this->requireUser(), $context);

        $this->createdResponse('context', ['id' => $id]);
    }

    /**
     * Récupère un contexte par son id
     * 
     */
    public function getById()
    {
        $id = $this->requireInt('id');

		try
		{
			$project = $this->contextDao->readById($this->requireUser(), $id);
		}
		catch (NotFoundException)
		{
			$this->notFound();
		}

		$this->jsonResponse($project);
    }

    /**
     * Met à jour un context
     */
    public function update()
    {
    	$id = $this->requireInt('id');
        $context = $this->requireBodyObject(Context::class);

        try
		{
			$context = $this->contextDao->update($this->requireUser(), $id, $context);
		}
		catch (NotFoundException)
		{
			$this->notFound();
		}

		$this->okResponse();        
    }

    /**
     * Supprime un context
     */
    public function delOne()
    {
        $id = $this->requireInt('id');

		try
		{
			$context = $this->contextDao->delete($this->requireUser(), $id);
		}
		catch (NotFoundException)
		{
			$this->notFound();
		}

		$this->okResponse();
    }
}