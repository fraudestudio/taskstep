<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

/**
 * Méthodes de comparaison pour différentes classes métier.
 * 
 * Les méthodes sont faite pour être utilisée dans des fonctions de tri.
 */
class Compare
{
	// constantes de convénience pour passer les méthodes en paramètre
	public const BY_TITLE = [Self::class, 'byTitle'];
	public const BY_DATE = [Self::class, 'byDate'];
	public const BY_CONTEXT = [Self::class, 'byContext'];
	public const BY_PROJECT = [Self::class, 'byProject'];
	public const UNDONE_FIRST = [Self::class, 'undoneFirst'];

	/**
	 * Compare deux éléments par leur titre (ordre naturel, insensible à la casse).
	 */
	public static function byTitle(Item|Context|Project $a, Item|Context|Project $b)
	{
		return strnatcasecmp($a->title(), $b->title());
	}

	/**
	 * Compare deux items par leur date (le plus récent d'abord, les items sans date en dernier).
	 */
	public static function byDate(Item $a, Item $b)
	{
		if (is_null($a->date()))
		{
			if (is_null($b->date())) return 0;
			else return 1;
		}
		else
		{
			if (is_null($b->date())) return -1;
			else return $a->date()->getTimestamp() - $b->date()->getTimestamp();
		}
	}
	
	/**
	 * Compare deux items par le titre de leur contexte.
	 */
	public static function byContext(Item $a, Item $b)
	{
		return Self::byTitle($a->context(), $b->context());
	}

	/**
	 * Compare deux items par le titre de leur projet.
	 */
	public static function byProject(Item $a, Item $b)
	{
		return Self::byTitle($a->project(), $b->project());
	}

	/**
	 * Compare deux items en fonction de si ils sont terminés ou non (les items non terminés vont en premier).
	 */
	public static function undoneFirst(Item $a, Item $b)
	{
		return $a->done() - $b->done();
	}
}	