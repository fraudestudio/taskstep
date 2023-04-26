<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

/**
 * Un DAO des projets.
 */
interface UserDaoInterface
{
    /**
     * Enregistre un nouvel utilisateur.
     * 
     * @param $registration Les informations sur le nouvel utilisateur.
     * 
     * @return L'ID du nouvel utilisateur.
     */ 
    public function register(Registration $registration) : int;

    /**
     * Récupère un utilisateur par son adresse mail et son mot de passe.
     * 
     * @param $email L'adresse mail de l'utilisateur
     * @param $password Son mot de passe
     */
    public function readByEmailAndPassword(string $email, string $password) : User;

    /**
     * Récupere un utilisateur depuis un jeton de session
     * 
     * @param $token Le jeton
     */
    public function readBySessionToken(string $token) : User;

    /**
     * Ouvre une session pour un utilisateur et renvoie le jeton associé.
     * 
     * @param $user L'utilisateur pour lequel ouvrir la session.
     */
    public function createSession(User $user) : string;

    /**
     * Prolonge la durée d'une session donnée.
     * 
     * @param $token Le jeton de la session à mettre à jour.
     */
    public function refreshSession(string $token) : void;

    /**
     * Change le mot de passe d'un utilisateur.
     * 
     * @param $user L'utilisateur pour lequel changer le mot de passe.
     * @param $password Le nouveau mot de passe.
     */
    public function changePassword(User $user, string $password) : bool;


    /**
     * Mets à jour le réglage des conseils pour un utilisateur.
     * 
     * @param $user L'utilisateur concerné.
     * 
     * @param $tips Affichage ou non des conseils
     */
    public function updateTips(User $user, bool $tips) : void;

    /**
     * Mets à jour le réglage du style pour un utilisateur.
     * 
     * @param $user L'utilisateur concerné
     * 
     * @param $style Le style à utiliser
     */
    public function updateStyle(User $user, Style $style) : void;
}