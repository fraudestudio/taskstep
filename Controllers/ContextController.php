<?php

declare(strict_types=1);

namespace TaskStep\Controllers;

use TaskStep\Logic\Model\Context as contexts;
use TaskStep\Logic\Model\ContextDaoInterface;
use TaskStep\Logic\Exceptions\NotFoundException;
use TaskStep\Middleware\Helpers\{Context, Services};

class ContextController extends Controller
{
	private ContextDaoInterface $contextDao;

	public function __construct(Context $context, Services $container)
	{
		parent::__construct($context, $container);

		$this->contextDao = $container->get('contextDao');
	}


    /**
     * Récupere tout les contexts d'un utilisateur
     */
    public function getAll()
    {
        try
        {
        	$contexts = $this->contextDao->readAll($this->requireUser());
            $this->jsonResponse($contexts);
        }
        catch(NotFoundException)
        {
            $this->notFound();
        }
    }

    /**
     * Créer un Context en base de données
     */
    public function post()
    {
        $context = $this->requireBodyObject(Contexts::class);

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
        $context = $this->requireBodyObject(Contexts::class);

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