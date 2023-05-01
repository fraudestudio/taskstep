<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

/**
 * Les différents styles de l'application.
 */
enum Style : string
{
	case CLASSIC = 'classic';
    case DARK = 'dark';
    case PROFESSIONAL = 'professional';
}