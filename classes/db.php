<?php
namespace Application\classes;
use Application\config\boot;
class DB
{
    private $dbh;
    private $className = 'stdClass';
    static private  $instance=null;

    public static function get_instance()
    {
        if (self::$instance == null)
            self::$instance = new self();

        return self::$instance;

    }
	private function __construct()
    {
    	$dsn = 'mysql:dbname='. boot::DB.';host=' . boot::DBHOST;
	    $user =  boot::DBUSER;
	    $password =  boot::DBPASS;
        //var_dump([$dsn,$user,$password]); exit;
        try {
            $this->dbh = new \PDO($dsn, $user, $password);
        }
        catch (\PDOException $edb) {
        	die('error during database connection');
        }
        $this->dbh->exec('SET CHARACTER SET utf8');
    }

    public function setClassName($className)
    {
        $this->className = $className;
    }

    public function query($sql, $params=[])
    {
        //echo $this->className; var_dump($params); exit;
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll(\PDO::FETCH_CLASS, $this->className);
    }
    public function execute($sql, $params=[])
    {
        $sth = $this->dbh->prepare($sql);
        return $sth->execute($params);
    }
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }


}