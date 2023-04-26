<?php

declare(strict_types=1);

namespace TaskStep\Controllers;

use TaskStep\Logic\Model\Item;
use TaskStep\Logic\Model\ItemDaoInterface;
use TaskStep\Logic\Exceptions\NotFoundException;
use TaskStep\Middleware\Helpers\{Context, Services};

class ItemController extends Controller
{
	private ItemDaoInterface $contextDao;

	public function __construct(Context $context, Services $container)
	{
		parent::__construct($context, $container);

		$this->contextDao = $container->get('ItemDao');
	}

}