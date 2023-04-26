<?php

namespace TaskStep\Logic\Data\MySql\Dao;

use DateTime;
use TaskStep\Logic\Data\MySql\Database;
use TaskStep\Logic\Model;
use TaskStep\Logic\Model\User;
use TaskStep\Logic\Model\UserDaoInterface;
use PDO;
use Random\Randomizer;
use TaskStep\Logic\Exceptions\BadTokenException;
use TaskStep\Logic\Exceptions\TokenOutOfDateException;

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
        $request = "Insert into `User`(login,MDP,salt,mail,style,tips) values (:login,:mdp,'',:mail,0,1);";
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
    public function SignIn(string $login, string $password): ?string
    {
        $query = "Select id,MDP from User where login = :login";
        $data = Database::getInstance()->executeQuery($query,array('login'=>$login))->fetch(PDO::FETCH_ASSOC);
        if($this->Authentification($data['MDP'],$password)){
            return $this->CreateToken($data['id']);
        }else{
            return null;
        }
    }

    /**
     * Vérifie si deux mots de passe sont les même
     */
    private function Authentification($expectedPass,$actualPass): bool{
        return password_verify($actualPass,$expectedPass);
    }

    /**
     * Créer un token, le rentre en base de données et le renvoie à l'utilisateur
     * 
     * @param $idUser Id de l'utilisateur concerné par ce token
     */
    private function CreateToken($idUser):string{
        $query = "Insert into `Session` (Token,`date`,`User`) values (:token,:date,:idUser)";

        //Création du Token
        $tableau = "abcdefghijklmnopqrstuvwxyz";
        $token = "";
        for($i = 0 ; $i<10; $i++){
            $token += $tableau[random_int(0,26)];
        }
        //Création de la date
        $date = new DateTime();

        Database::getInstance()->executeNonQuery($query,array('token'=> $token,'date'=>$date,'idUser'=>$idUser));

        return $token;
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
        //Modification du nouveau mot de passe
        $query = "update `User` set MDP = :mdp where id = :id";
        Database::getInstance()->executeNonQuery($query,array('mdp'=>$mdp,'id'=>password_hash($mdp,PASSWORD_BCRYPT)));

        //Récupération du mot de passe fraichement modifié
        $query = "select MDP from user where id = :id";
        $data = Database::getInstance()->executeQuery($query,array('id'=>$idUser))->fetch(PDO::FETCH_ASSOC);

        //Réponse au controller
        if($this->Authentification($data['MDP'],$mdp)){
            return true;
        }else{
            return false;
        }
    }


    /**
     * Mets à jour un projet.
     * 
     * @param $idUser L'identifiant du User
     * 
     * @param $displayTips Affichage des conseil
     */
    public function ChangeTips(int $idUser, bool $displayTips)
    {
        if($displayTips){
            $queryBase = "update `User` set tips = 1 where id = :id ";
        }else{
            $queryBase = "update `User` set tips = 0 where id = :id";
        }

        Database::getInstance()->executeNonQuery($queryBase,array('id'=>$idUser));
         
    }

    /**
     * Mets à jour un projet.
     * 
     * @param $idUser L'identifiant du User
     * 
     * @param $style style choisit entre 0 et 2
     */
    public function ChangeStyle(int $idUser, int $style){
        Database::getInstance()->executeNonQuery("update `User` set style = :style where id = :id",array('style'=>$style,'id'=>$idUser));
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
        $query = "Select u.*,t.* from User as u join Session as t on u.id = t.idUser where t.token = :token";
        $answer = Database::getInstance()->executeQuery($query,array('token'=>$token))->fetch(PDO::FETCH_ASSOC);

        $dateToken = new DateTime($answer['date']);
        $result = new User();
        if(is_null($answer)){
            throw new BadTokenException();
        }else if($dateToken->diff(new DateTime())->m > 20){
            throw new TokenOutOfDateException();
        }else{
            $result->SetId($answer["id"]);
            $result->SetLogin($answer["login"]);
            $result->SetMail($answer["mail"]);
            $result->SetPassword($answer["MDP"]);
            $result->SetStyle($answer["style"]);
            $result->SetTips($answer["tips"]);
        }

        return $result;
    }
}