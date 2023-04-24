<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

/**
 * Un utilisateur de l'application.
 */
class User
{
    
    /*
        Attribut 
    */
    private int $id;

    private string $login;

    private string $password;

    private string $salt;

    private string $mail;

    private int $style;

    private bool $tips;

    /**
     * Getter setter
     */

     /**
      * ID
      */
    public function GetId(): int {return $this->id; }
    public function SetId(int $id) {$this->id = $id; }

    /**
     * Login
     */
    public function GetLogin() : string {return $this->login;}
    public function SetLogin(string $login) {$this->login = $login;}

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


}