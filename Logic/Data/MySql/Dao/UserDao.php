<?php

namespace TaskStep\Logic\Data\MySql\Dao;

use DateTime;
use TaskStep\Logic\Data\MySql\Database;
use TaskStep\Logic\Model\{User, Registration, Style, Context, Project};
use TaskStep\Logic\Model\UserDaoInterface;
use PDO, PDOException;
use Random\Randomizer;
use TaskStep\Logic\Exceptions\{BadTokenException, TokenOutOfDateException, NotFoundException, DuplicateException};

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

        try
        {
            Database::getInstance()->executeNonQuery(
                "INSERT INTO `User`(mail, MDP, style, tips, login, salt) VALUES (:mail, :mdp, 0, 1, '', '')",
                ['mail' => $registration->email(), 'mdp' => $hash]
            );
        }
        catch (PDOException $e)
        {
            if ($e->errorInfo[1] == 1062)
            {
                throw new DuplicateException;
            }
            else
            {
                throw $e;
            }
        }

        $id = Database::getInstance()->executeQuery("SELECT last_insert_id()")->fetch()[0];

        Database::getInstance()->executeNonQuery(
            "INSERT INTO contexts (title, User) VALUES ('Sample context', :user)",
            ['user' => $id]
        );

        Database::getInstance()->executeNonQuery(
            "INSERT INTO projects (title, User) VALUES ('Sample project', :user)",
            ['user' => $id]
        );

        return $id;
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
            "SELECT u.idUser, u.MDP, u.mail, u.tips, s.style ".
            "FROM User as u JOIN style as s ON u.style = s.idStyle WHERE u.mail = :mail",
            ['mail' => $email]
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
        $now = new DateTime('now');

        $query = Database::getInstance()->executeQuery(
            <<<'SQL'
                SELECT u.idUser, u.mail, u.tips, TIMESTAMPDIFF(MINUTE, t.date, :now) as lifetime, s.style
                FROM User as u JOIN Session as t ON u.idUser = t.User JOIN style as s ON u.style = s.idStyle
                WHERE t.token = :token
            SQL,
            ['token' => $token, 'now' => $now->format('Y-m-d H:i:s')]
        );

        if ($data = $query->fetch())
        {
            if ($data['lifetime'] > 20) throw new TokenOutOfDateException();
            
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
     * Récupère un utilisateur par son identifiant.
     * 
     * @param $id L'ID de l'utilisateur
     */
    public function readById(int $id): User
    {
        $query = Database::getInstance()->executeQuery(
            "SELECT u.mail, u.tips, s.style ".
            "FROM User as u JOIN style as s ON u.style = s.idStyle WHERE u.idUser = :id",
            ['id' => $id]
        );

        if ($data = $query->fetch())
        {
            $user = new User($id);
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
            "INSERT INTO `Session` (Token, `date`, `User`) VALUES (:token, :date, :user)",
            ['token' => $token, 'date' => $now->format('Y-m-d H:i:s'), 'user' => $user->id()]
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
            ['token' => $token, 'date' => $now->format('Y-m-d H:i:s')]
        );
    }

    /**
     * Oublie les sessions expirées d'un utilisateur.
     * 
     * @param $user L'utilisateur concerné.
     */
    public function cleanSessions(User $user) : void
    {
        $now = new DateTime('now');

        Database::getInstance()->executeNonQuery(
            "DELETE FROM Session WHERE User = :user AND TIMESTAMPDIFF(MINUTE, date, :now) > 20",
            ['user' => $user->id(), 'now' => $now->format('Y-m-d H:i:s')]
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
            "UPDATE `User` SET MDP = :mdp WHERE idUser = :id",
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
    public function updateTips(User $user, bool $tips) : void
    {
        if ($tips)
        {
            $query = "UPDATE `User` SET tips = 1 WHERE idUser = :id";
        }
        else
        {
            $query = "UPDATE `User` SET tips = 0 WHERE idUser = :id";
        }

        Database::getInstance()->executeNonQuery($query, ['id' => $user->id()]);
    }

    /**
     * Mets à jour le réglage du style pour un utilisateur.
     * 
     * @param $user L'utilisateur concerné
     * 
     * @param $style Le style à utiliser
     */
    public function updateStyle(User $user, Style $style) : void
    {
        Database::getInstance()->executeNonQuery(
            "UPDATE `User` SET style = (SELECT idStyle FROM style WHERE style = :style) WHERE idUser = :id",
            ['style' => $style->value, 'id' => $user->id()]
        );
    }

    private const TOKEN_CHARS = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    private function generateToken() : string {
        $token = "";

        for($i=0; $i<20; $i++)
        {
            $token .= Self::TOKEN_CHARS[random_int(0, 61)];
        }

        return $token;
    }
}
