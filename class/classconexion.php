<?php
include("timezones_class.php");
class Db{
		
	private $dbHost     = "localhost:3306";
    private $dbUsername = "root";
    private $dbPassword = "J1z01234_";
    private $dbName     = "softmedical";
	protected $p; 
	protected $dbh; 
	
    public function __construct(){
        if(!isset($this->dbh)){
            // Connect to the database
            try{
	
                date_default_timezone_set("America/Caracas");
                setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
                $conn = new PDO("mysql:host=".$this->dbHost.";dbname=".$this->dbName, $this->dbUsername, $this->dbPassword,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->dbh = $conn;
            }catch(PDOException $e){
                die("Failed to connect with MySQL: " . $e->getMessage());
            }
        }
    }
	
	public function SetNames()
	{
		return $this->dbh->query("SET NAMES 'utf8'");
	}
}
?>