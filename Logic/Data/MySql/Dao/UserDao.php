<?php

namespace TaskStep\Data\MySql\Dao;

use TaskStep\Data\Database;
use TaskStep\Logic\Model;
use TaskStep\Logic\Model\User;
use TaskStep\Logic\Model\UserDaoInterface;
use PDO;

class UserDAO implements UserDaoInterface
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
    public function SignUp(string $login, string $password, string $mail) : int
    {
        $request = "Insert into `User`(login,MDP,salt,mail,style,tips) values (:login,:mdp,'SELTAMERE',:mail,0,1);";
        Database::getInstance()->executeNonQuery($request,array('login'=>htmlspecialchars($login),'mdp'=>password_hash($password,PASSWORD_BCRYPT),'mail'=>$mail));
        $data = Database::getInstance()->executeQuery("select last_insert_id();")->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    /**
     * Récupère un projet par son identifiant.
     * 
     * @param $login login de l'utilisateur
     * @param $assword mot de passe 
     * 
     * @return bool Comfirmation de connection
     */
    public function SignIn(string $login, string $password): string
    {
        return true;
    }

    /**¨
     * Change le mot de passe d'un Utilisateur.
     * 
     * @param $idUser id de l'utilisateur
     * @param $mdp mot de passe de l'utilisateur
     * 
     * @return bool Confirmation de l'utilisateur
     */
    public function ChangePassword(int $idUser, string $mdp): bool
    {
        return true;
    }


    /**
     * Mets à jour un projet.
     * 
     * @param $idUser L'identifiant du User
     * 
     * @param $displayTips Affichage des conseil
     * @param $style style choisit
     */
    public function ChangeSettings(int $idUser, ?bool $displayTips, ?int $style)
    {

    }

    /**
     * Récupere un User liée au token donné
     * 
     * @param $token token récupéré
     * 
     * @return User un User
     */
    public function GetUserByToken(string $token) : User
    {
        return new User();
    }
}