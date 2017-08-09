<?php 
@session_start();
ini_set('display_errors', 'On');
require_once "../func/DB_Tool.php";
require_once "../func/basic_tool.php";

$db_tool = new DB_Tool;
$db = &$db_tool->get_DB();

$now_time = get_date_time();
$coupon   = false;

reuse_number( $now_time );

if( !isset( $_SESSION['token'] ) )
{
	$_SESSION['token'] = $now_time;
} 

$token = md5($_SESSION['token']);

$sql = "SELECT * FROM `cny2017_coupon_test` WHERE is_playing = 'N' AND is_delete = 'N' ";
$std = $db->prepare($sql);
$std->execute();
$rc  = $std->rowCount();

if ( $rc > 0 )
{
	$coupon = true;
}


$dataArr = array( "token" => $token , "coupon" => $coupon , "err" => NULL );

header('Content-Type: application/json; charset=utf-8');
echo json_encode($dataArr);
?>