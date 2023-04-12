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
        $statement = Database::instance()->execute('SELECT * FROM settings WHERE setting = "tips"');

        if ($row = $statement->fetch())
        {
            return $row['value'] == '0' ? false : true;
        }
        else
        {
            return true;
        }
    }
}