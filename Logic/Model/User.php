<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

use TaskStep\Middleware\Helpers\JsonSerializable;

/**
 * Un utilisateur de l'application.
 */
class User implements JsonSerializable
{
    private int $_id;
    private string $_email;
    private Settings $_settings;

    /**
     * Récupère l'identifiant de l'utilisateur.
     */
    public function id() : int { return $this->_id; }

    /**
     * Récupère l'adresse mail de l'utilisateur.
     */
    public function email() : string { return $this->_email; }

    /**
     * Change l'adresse mail de l'utilisateur.
     * 
     * @param $email La nouvelle addresse mail.
     */
    public function setEmail(string $email) : User {
        $this->_email = $email;
        return $this;
    }

    /**
     * Récupère les réglages de l'utilisateur.
     */
    public function settings() : Settings { return $this->_settings; }

    /**
     * Crée un nouvel utilisateur.
     * 
     * @param $id (optionnel) L'identifiant de l'utilisateur. Il n'a pas besoin
     *            d'être renseigné quand on en crée un nouveau.
     */ 
    public function __construct(int $id = -1)
    {
        $this->_id = $id;
        $this->_settings = new Settings();
    }

    public function jsonSerialize() : mixed {
        return [
            'Id' => $this->_id,
            'Email' => $this->_email,
            'Settings' => $this->_settings,
        ];
    }

    public function jsonDeserialize(mixed $value) : void {
        throw new \Exception("'User' objects shouldn't be received");
    }
}