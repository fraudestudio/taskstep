<?php

// Le vrai fichier de configuration est `config.ini`

// Ce fichier est là pour la compatibilité avec certaines parties du code

require_once 'Config.php';

$_cfg = TaskStep\Config::instance();

$server           = $_cfg->legacyDatabase()->host();
$db               = $_cfg->legacyDatabase()->schema();
$user             = $_cfg->legacyDatabase()->username();
$password         = $_cfg->legacyDatabase()->password();
$language         = $_cfg->locale()->language();
$menu_date_format = $_cfg->locale()->menuDateFormat();
$task_date_format = $_cfg->locale()->taskDateFormat();
