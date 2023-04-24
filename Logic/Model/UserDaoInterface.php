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
     * @param $login Login du nouvel utilisateur
     * @param $password Mot de passe du nouveau projet
     * @param $mail Mail du nouvel utilisateur
     * @param $CaptchaToken Token du captcha pour vérifier si le nouvel utilisateur n'est pas un robot
     * 
     * @return int id duy nouvel utilisateur
     */ 
    public function SignUp(string $login, string $password, string $mail, string $CaptchaToken) : int;

    /**
     * Récupère un projet par son identifiant.
     * 
     * @param $login login de l'utilisateur
     * @param $assword mot de passe 
     * 
     * @return bool Comfirmation de connection
     */
    public function SignIn(string $login, string $password): bool;

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
     * Mets à jour un projet.
     * 
     * @param $idUser L'identifiant du User
     * 
     * @param $displayTips Affichage des conseil
     * @param $style style choisit
     */
    public function ChangeSettings(int $idUser, ?bool $displayTips, ?int $style);

    /**
     * Récupere un User liée au token donné
     * 
     * @param $token token récupéré
     * 
     * @return User un User
     */
    public function GetUserByToken(string $token);
}