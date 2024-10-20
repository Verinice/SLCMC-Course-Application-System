<?php

namespace SLCMC\Controllers;

use PDO;
use PDOException;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
$dotenv->load();

class Database{
    public $db;
    private $host;
    private $db_name;
    private $db_user;
    private $db_pass;
    public $last_inserted_id;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->db_name = $_ENV['DB_NAME'];
        $this->db_user = $_ENV['DB_USER'];
        $this->db_pass= $_ENV['DB_PASS'];

        try {
            $this->db = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->db_user, $this->db_pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return "Connection failed: " . $e->getMessage() . '\n';
        }
    }

    public function prepareQuery($sql)
    {
        try {
            //code...
            $stmt = $this->db->prepare($sql);
            return $stmt;
        } catch (\PDOException $e) {
           return false;
        }
    }

    public function execute( $queries )
    {
        $this->db->beginTransaction();
        foreach ($queries as $key => $query) {
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $key == 0 ? $this->last_inserted_id = $this->db->lastInsertId() : "";
        }
        $this->db->commit();
    }

    public function queryDb($sql){
        return $this->db->query($sql);
    }
}