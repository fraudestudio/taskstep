<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

/**
 * Une section de tâche.
 */
enum Section
{
	case IDEA;
	case TO_BUY;
	case IMMEDIATE;
	case WEEK;
	case MONTH;
	case YEAR;
	case LIFETIME;
}