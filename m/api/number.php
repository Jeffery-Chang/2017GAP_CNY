<?php 
@session_start();
ini_set('display_errors', 'Off');
require_once "../func/DB_Tool.php";
require_once "../func/basic_tool.php";

$key = ( isset($_POST['token']) ) ? $_POST['token'] : '' ;

if( $key != '' && $key == md5($_SESSION['token']) )
{
	if( !isset( $_SESSION['number'] ) && !isset( $_SESSION['money'] ) )
	{
		$db_tool = new DB_Tool;
		$db = &$db_tool->get_DB();
	
		$sql = "SELECT * FROM `cny2017_coupon_test` WHERE is_playing = 'N' AND is_delete = 'N'";
		$std = $db->prepare($sql);
		$std->execute();
		$rc  = $std->rowCount();
		$rs  = $std->fetchAll(PDO::FETCH_ASSOC);   
	
		$selected           = rand(0,$rc);
		$is_playing         = $rs[$selected]['id'];
		$_SESSION['number'] = $rs[$selected]['number'];
		$num                = $rs[$selected]['number'];
		$_SESSION['money']  = $rs[$selected]['money'];
		$money              = $rs[$selected]['money'];
	
		$dataArr = array("token"=> $key , "num"=> $num , "money"=> $money , "err" => NULL );
	
		$sql = "UPDATE `cny2017_coupon_test` SET is_playing = 'Y' WHERE id = '$is_playing' ";
		$std = $db->prepare($sql);
		$std->execute();
	}
	else
	{
		$token = md5($_SESSION['token']);
		$num   = $_SESSION['number'];
		$money = $_SESSION['money'];
		$dataArr = array("token"=> $token , "num"=> $num , "money"=> $money , "err" => NULL );
	}
	
}
else
{
	$dataArr = array( "token"=> NULL , "num"=> NULL , "money"=> NULL , "err" => 'token有誤！' );
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($dataArr);

?>