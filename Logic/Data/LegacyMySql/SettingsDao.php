<?php

declare(strict_types=1);

namespace TaskStep\Logic\Data\LegacyMySql;

/**
 * Accès au données des réglages utilisateur compatible avec la BDD de la version 1.1.
 */
class SettingsDao
{
    public function displayTips(): bool
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
}