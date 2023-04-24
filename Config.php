<?php

declare(strict_types=1);

namespace TaskStep;

/**
 * La configuration de l'application.
 */ 
class Config
{
	// -- SINGLETON --

	private static ?Config $_instance = null;

	public static function instance(): Config
	{
		if (is_null(Self::$_instance))
		{
			Self::$_instance = new Config();
		}
		return Self::$_instance;
	}

	// -- CONFIGURATION --

	private LocaleConfig $_locale;
	private MySqlConfig $_legacyDatabase;

	public function locale(): LocaleConfig { return $this->_locale; }

	public function legacyDatabase(): MySqlConfig { return $this->_legacyDatabase; }

	private function __construct()
	{
		$configData = parse_ini_file("config.ini", true);
		
		$this->_locale = new LocaleConfig($configData['locale']);
		$this->_legacyDatabase = new MySqlConfig($configData['database:legacy']);
	}
}


/**
 * La configuration de la langue de l'application.
 */ 
class LocaleConfig
{
    private string $_language;
    private string $_menuDateFormat;
    private string $_taskDateFormat;

    public function language(): string { return $this->_language; }

    public function menuDateFormat(): string { return $this->_menuDateFormat; }

    public function taskDateFormat(): string { return $this->_taskDateFormat; }

    public function __construct(array $configData)
    {
        $this->_language = $configData['language'];
        $this->_menuDateFormat = $configData['date']['menu'];
        $this->_taskDateFormat = $configData['date']['task'];
    }
}


/**
 * La configuration d'une base de données MySQL.
 */ 
class MySqlConfig
{
    private string $_host;
    private int $_port;
    private string $_schema;
    private string $_username;
    private string $_password;

    public function host(): string { return $this->_host; }

    public function port(): int { return $this->_port; }

    public function schema(): string { return $this->_schema; }

    public function username(): string { return $this->_username; }

    public function password(): string { return $this->_password; }

    public function dsn(): string
    {
    	return "mysql:host=$this->_host;port=$this->_port;dbname=$this->_schema";
    }

    public function __construct(array $configData)
    {
    	$this->_host = $configData['host'];
    	$this->_port = intval($configData['port'] ?? '3306');
    	$this->_schema = $configData['schema'];
    	$this->_username = $configData['username'];
    	$this->_password = $configData['password'];
    }
}