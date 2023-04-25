<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

/**
 * Un utilisateur de l'application.
 */
class User
{
    private int $_id;
    private string $_email;
    private string $_password;
    private string $_mail;
    private string $_style;
    private bool $_tips;

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
    }

    /**
     * Password
     */
    public function GetPassword() : string {return $this->password;}
    public function SetPassword(string $password) {$this->password = $password;}

    /**
     * Sel
     */
    public function GetSalt() : string {return $this->salt;}
    public function SetSalt(string $salt){$this->salt = $salt;}

    /**
     * Mail
     */
    public function GetMail() : string {return $this->mail;}
    public function SetMail(string $mail){$this->mail = $mail;}

    /**
     * Style
     */
    public function GetStyle() : int {return $this->style;}
    public function SetStyle(int $style){$this->style = $style;}

    /**
     * Tips
     */
    public function GetTips():bool{return $this->tips;}
    public function SetTips(bool $tips){$this->tips = $tips;}

    /**
     * Crée un nouvel utilisateur.
     * 
     * @param $id (optionnel) L'identifiant de l'utilisateur. Il n'a pas besoin
     *            d'être renseigné quand on en crée un nouveau.
     */ 
    public function __construct(int $id = -1)
    {
        $this->_id = $id;
    }
}