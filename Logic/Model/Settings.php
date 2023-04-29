<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

use TaskStep\Middleware\Helpers\JsonSerializable;

class Settings implements JsonSerializable
{
	private Style $_style;
	private bool $_tips;

	/**
	 * Récupère le style.
	 */
	public function style() : Style { return $this->_style; }

	/**
	 * Modifie le style.
	 * 
	 * @param $style Le nouveau style.
	 */
	public function setStyle(Style $style) : Settings
	{
		$this->_style = $style;
		return $this;
	}

	/**
	 * Indique si les conseils doivent être affichés.
	 */
	public function tips() : bool { return $this->_tips; }

	/**
	 * Active/désactive les conseils.
	 * 
	 * @param $tips `true` pour afficher les conseils. 
	 */
	public function setTips(bool $tips) : Settings
	{
		$this->_tips = $tips;
		return $this;
	}

    public function jsonSerialize() : mixed {
        return [
            'Style' => $this->_style,
            'Tips' => $this->_tips,
        ];
    }

    public function jsonDeserialize(mixed $value) : void {
    	if (!key_exists('Style', $value)) throw new \Exception("missing 'Style' field in 'Settings' object");
		$this->_style = Style::from($value['Style']);

		$this->_tips = $value['Tips']
			?? throw new \Exception("missing 'Tips' field in 'Settings' object");
    }
}