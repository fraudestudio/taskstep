<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

/**
 * Une section de tâche.
 */
enum Section : string
{
	case IDEA = 'idea';
	case TO_BUY = 'to_buy';
	case IMMEDIATE = 'immediate';
	case WEEK = 'week';
	case MONTH = 'month';
	case YEAR = 'year';
	case LIFETIME = 'lifetime';
}