<?php

namespace TaskStep\Logic\Data\MySql\Dao;

use DateTime;
use TaskStep\Logic\Data\MySql\Database;
use TaskStep\Logic\Model\{User, Registration, Style};
use TaskStep\Logic\Model\UserDaoInterface;
use PDO;
use Random\Randomizer;
use TaskStep\Logic\Exceptions\{BadTokenException, TokenOutOfDateException, NotFoundException};

class UserDAO implements UserDaoInterface
{
    /**
     * Enregistre un nouvel utilisateur.
     * 
     * @param $registration Les informations sur le nouvel utilisateur.
     * 
     * @return L'ID du nouvel utilisateur.
     */ 
    public function register(Registration $registration) : int
    {
        $hash = password_hash($registration->password(), PASSWORD_BCRYPT);

        Database::getInstance()->executeNonQuery(
            "INSERT INTO `User`(mail, MDP, style, tips, login, salt) VALUES (:mail, :mdp, 0, 1, '', '')",
            ['mail' => $registration->email(), 'mdp' => $hash]
        );

        $data = Database::getInstance()->executeQuery("SELECT last_insert_id()")->fetch();
        return $data[0];
    }

    /**
     * Récupère un utilisateur par son adresse mail et son mot de passe.
     * 
     * @param $email L'adresse mail de l'utilisateur
     * @param $password Son mot de passe
     */
    public function readByEmailAndPassword(string $email, string $password): User
    {
        $query = Database::getInstance()->executeQuery(
            "SELECT idUser, MDP, style, tips FROM User WHERE mail = :mail",
            ['email' => $email]
        );

        if ($data = $query->fetch())
        {
            if (password_verify($password, $data['MDP']))
            {
                $user = new User($data['idUser']);
                $user->setEmail($email);
                $user->settings()
                    ->setStyle(Style::from($data['style']))
                    ->setTips($data['tips']);
                return $user;
            }
        }
        
        throw new NotFoundException();
    }

    /**
     * Récupere un utilisateur depuis un jeton de session
     * 
     * @param $token Le jeton
     */
    public function readBySessionToken(string $token) : User
    {
        $query = Database::getInstance()->executeQuery(
            "SELECT u.idUser, u.mail, u.style, u.tips, t.date " +
            "FROM User as u JOIN Session as t ON u.idUser = t.User WHERE t.token = :token",
            ['token' => $token]
        );

        if ($data = $query->fetch())
        {
            $tokenLifetime = time() - strtotime($data['date']);

            // plus vieux que 20 minutes
            if ($tokenLifetime > 1200) throw new TokenOutOfDateException();
            
            $user = new User($data['idUser']);
            $user->setEmail($data['mail']);
            $user->settings()
                ->setStyle(Style::from($data['style']))
                ->setTips($data['tips']);
            return $user;
        }
        
        throw new NotFoundException();
    }

    /**
     * Ouvre une session pour un utilisateur et renvoie le jeton associé.
     * 
     * @param $user L'utilisateur pour lequel ouvrir la session.
     */
    public function createSession(User $user) : string
    {
        $token = $this->generateToken();
        $now = new DateTime('now');

        Database::getInstance()->executeNonQuery(
            "INSERT INTO `Session` (Token, `date`, `User`) VALUES (:token, :date, :idUser)",
            ['token' => $token, 'date' => $date, 'User' => $user->id()]
        );

        return $token;
    }

    /**
     * Prolonge la durée d'une session donnée.
     * 
     * @param $token Le jeton de la session à mettre à jour.
     */
    public function refreshSession(string $token) : void
    {
        $now = new DateTime('now');

        Database::getInstance()->executeNonQuery(
            "UPDATE `Session` SET `date` = :date WHERE token = :token",
            ['token' => $token, 'date' => $date]
        );
    }

    /**
     * Change le mot de passe d'un utilisateur.
     * 
     * @param $user L'utilisateur pour lequel changer le mot de passe.
     * @param $password Le nouveau mot de passe.
     */
    public function changePassword(User $user, string $password) : bool
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);

        $result = Database::getInstance()->executeNonQuery(
            "UPDATE `User` SET MDP = :mdp WHERE id = :id",
            ['mdp' => $hash, 'id' => $user->id()]
        );

        return $result == 1;
    }


    /**
     * Mets à jour le réglage des conseils pour un utilisateur.
     * 
     * @param $user L'utilisateur concerné.
     * 
     * @param $tips Affichage ou non des conseils
     */
    public function updateTips(User $user, bool $tips)
    {
        if ($tips)
        {
            $query = "UPDATE `User` SET tips = 1 WHERE id = :id";
        }
        else
        {
            $query = "UPDATE `User` SET tips = 0 WHERE id = :id";
        }

        $result = Database::getInstance()->executeNonQuery($query, ['id' => $user->id()]);
        
        if ($result != 1) throw new NotFoundException();         
    }

    /**
     * Mets à jour le réglage du style pour un utilisateur.
     * 
     * @param $user L'utilisateur concerné
     * 
     * @param $style Le style à utiliser
     */
    public function updateStyle(User $user, Style $style)
    {
        $result = Database::getInstance()->executeNonQuery(
            "UPDATE `User` SET style = :style WHERE id = :id",
            ['style' => $style, 'id' => $user->id()]
        );

        if ($result != 1) throw new NotFoundException();
    }

    private const TOKEN_CHARS = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    private function generateToken() : string {
        $token = "";

        for($i=0; $i<20; $i++)
        {
            $token += Self::TOKEN_CHARS[random_int(0, 61)];
        }

        return $token;
    }
}