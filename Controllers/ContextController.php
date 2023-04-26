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

		$this->contextDao = $container->get('ContextDao');
	}


    /**
     * Récupere tout les contexts d'un utilisateur
     */
    public function getAll()
    {
        $this->jsonResponse($this->contextDao->readAll($this->requireUser()));
    }

    /**
     * Créer un Context en base de données
     */
    public function post()
    {
        $context = $this->requireBodyObject(Contexts::class);

        $id = $this->contextDao->create($this->requireUser(),$context);

        $this->createdResponse('contexts',['Id' => $id]);
    }

    public function getById(){

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
}