<?php

declare(strict_types=1);

namespace TaskStep\Logic\Data\LegacyMySql;

use Exception;

/**
 * Accès au données des réglages utilisateur compatible avec la BDD de la version 1.1.
 */
class SettingsDao
{
    public function tips(): bool
    {
        $statement = Database::instance()->execute('SELECT value FROM settings WHERE setting = "tips"');

        if ($row = $statement->fetch())
        {
            return $row[0] == '0' ? false : true;
        }
        else
        {
            return true;
        }
    }

    public function setTips(bool $display): void
    {
        Database::instance()->execute('UPDATE settings SET value = ? WHERE setting = "tips"', $display ? '1' : '0');
    }

    public function style(): string
    {
        $statement = Database::instance()->execute('SELECT value FROM settings WHERE setting = "style"');

        if ($row = $statement->fetch())
        {
            return $row[0];
        }
        else
        {
            return 'default.css';
        }
    }

    public function setStyle(string $style): void
    {
        Database::instance()->execute('UPDATE settings SET value = ? WHERE setting = "style"', $style);
    }

    public function setPassword(string $password): void
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        Database::instance()->execute('UPDATE settings SET value = ? WHERE setting = "password"', $hash);

        Database::instance()->execute('UPDATE settings SET value = "1" WHERE setting = "sessions"');
    }

    public function checkPassword(string $password): bool
    {
        $statement = Database::instance()->execute('SELECT value FROM settings WHERE setting = "password"');

        $hash = '';
        if ($row = $statement->fetch())
        {
            $hash = $row[0];
        }
        else
        {
            return false;
        }

        return password_verify($password, $hash);
    }
}