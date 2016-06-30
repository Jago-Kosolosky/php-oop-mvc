<?php

class DatabaseConnection {

    // -- connection vars
    private $host;
    private $user;
    private $password;
    private $database;
    private $charset;
    private $types = array();
    // -- pdo object
    private $pdo;
    // -- sql 
    private $sql;
    // -- params
    private $params;
    private $driver;
    private $drivers = array('mysql');

    public function __construct() {

        $this->loadConfig();

        $this->pdo = null;
        $this->params = array();

    }

    private function loadConfig() {
        $this->config = include 'config/database.php';
        $this->driver = isset($this->config['driver']) ? $this->config['driver'] : false;

        if (!$this->driver)
            throw new Exception('Driver can\'t be empty');

        if (!in_array($this->driver, $this->drivers))
            throw new Exception('Driver not supported');

        if (!isset($this->config[$this->driver]))
            throw new Exception('Driver setting not found');

        $this->host = (isset($this->config[$this->driver]['host'])) ? $this->config[$this->driver]['host'] : '';
        $this->user = (isset($this->config[$this->driver]['user'])) ? $this->config[$this->driver]['user'] : '';
        $this->password = (isset($this->config[$this->driver]['password'])) ? $this->config[$this->driver]['password'] : '';
        $this->database = (isset($this->config[$this->driver]['database'])) ? $this->config[$this->driver]['database'] : '';
        $this->charset = (isset($this->config[$this->driver]['charset'])) ? $this->config[$this->driver]['charset'] : '';
    }

    /**
     * Connectie naar databank
     */
    public function connect() {
        $connectionString = $this->getConnectionString($this->driver);
        $this->pdo = new PDO($connectionString, $this->user, $this->password);
    }

    private function getConnectionString($driver) {
        if ($driver == 'mysql')
            return 'mysql:host=' . $this->host . ';dbname=' . $this->database . ';charset=' . $this->charset;


        return '';
    }

    /**
     * Sql doorgeven, zonder pdo!
     * @param type $sql
     */
    public function setSql($sql) {
        $this->sql = $sql;
        $this->params = array();
    }

    public function addParam($placeholder, $value, $type = '') {
        if ($type == '')
            $type = self::paramString();

        $this->params[$placeholder] = array(
            'value' => $value,
            'type' => $type
        );
    }

    public function fetch() {
        $stmt = $this->execute(true);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function query() {
        return $this->execute(false);
    }

    /*
      <?php
      EXAMPLE
      $calories = 150;
      $colour = 'grey';
      $sth = $dbh->prepare('SELECT name, colour, calories
      FROM fruit
      WHERE calories < :calories AND colour LIKE :colour');
      $sth->bindValue(':calories', $calories, PDO::PARAM_INT);
      $sth->bindValue(':colour', "%{$colour}%");
      $sth->execute();

     */

    private function execute($return = false) {
        $stmt = $this->pdo->prepare($this->sql);

        foreach ($this->params as $placeholder => $param)
            $stmt->bindValue($placeholder, $param['value'], $param['type']);

        if (!$stmt->execute())
            return false;

        if ($return === true)
            return $stmt;

        return true;
    }

    public function paramInteger() {
        return PDO::PARAM_INT;
    }

    public function paramString() {
        return PDO::PARAM_STR;
    }

    public function paramBool() {
        return PDO::PARAM_BOOL;
    }

    public function paramNull() {
        return PDO::PARAM_NULL;
    }

}

?>
