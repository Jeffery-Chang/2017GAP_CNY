<?php

//define(REDIRECT_URL, "http://fb.webgene.com.tw/nike/redirect/index.php");
//define(REDIRECT_URL, "http://fb.webgene.com.tw/nike/redirect/index.php");
class DB
{
	private $dsn;
	private $account;
	private $password;
	private $db_array = array(
		"usual"=>array("dsn"=>"mysql:host=192.168.123.184; dbname=gap_db;", "account"=>"root", "password"=>"webgene")
	);
	protected $db;

	public function __construct($db = null)
	{
		$this->db_init($db);
		try {
			$this->db = new PDO($this->dsn, $this->account, $this->password);
			$this->db->exec("SET NAMES UTF8");
		} catch (Exception $e) {
			echo "Can't connect to DATABASE.";
			//echo $e;
			exit;
		}
	}
	private function db_init($db = null){		 
		 $db_data = array();
		 if($db){
		 	$db_data = $this->db_array[$db];
		 }else{
		 	$db_data = reset($this->db_array);
		 }
		 //print_r($db_data);
		 $this->dsn = $db_data["dsn"];
		 $this->account = $db_data["account"];
		 $this->password = $db_data["password"];
	}
}