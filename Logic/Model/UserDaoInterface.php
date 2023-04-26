<?php

declare(strict_types=1);

namespace TaskStep\Logic\Model;

/**
 * Un DAO des projets.
 */
interface UserDaoInterface
{
    /**
     * Crée un utilisateur.
     * 
     * @param $registration Les informations sur le nouvel utilisateur
     * 
     * @return L'ID du nouvel utilisateur
     */ 
    public function create(Registration $registration) : int;

    /**
     * Récupère un projet par son identifiant.
     * 
     * @param $login login de l'utilisateur
     * @param $assword mot de passe 
     * 
     * @return bool Comfirmation de connection
     */
    public function SignIn(string $login, string $password): ?string;

    /**¨
     * Change le mot de passe d'un Utilisateur.
     * 
     * @param $idUser id de l'utilisateur
     * @param $mdp mot de passe de l'utilisateur
     * 
     * @return bool Confirmation de l'utilisateur
     */
    public function ChangePassword(int $idUser, string $mdp): bool;


    /**
     * Mets à jour un conseil
     * 
     * @param $idUser L'identifiant du User
     * 
     * @param $displayTips Affichage des conseil
     */
    public function ChangeTips(int $idUser, bool $displayTips);

    /**
     * Mets à jour un style
     * 
     * @param  $idUser id de l'utilisateur à update
     * 
     * @param $style id du style
     */
    public function ChangeStyle(int $idUser, int $style);

    /**
     * Récupere un User liée au token donné
     * 
     * @param $token token récupéré
     * 
     * @return User un User
     */
    public function GetUserByToken(string $token) : User;
}