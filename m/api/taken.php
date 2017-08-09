<?php 
@session_start();
ini_set('display_errors', 'On');
require_once "../func/DB_Tool.php";
require_once "../func/basic_tool.php";

$err    = '其他錯誤！';
$status = 500;
// echo md5($_SESSION['token']);

$num = ( isset($_POST['num']) )   ? $_POST['num']   : '' ;
$key = ( isset($_POST['token']) ) ? $_POST['token'] : '' ;

if( ( $key == '' && $key != md5($_SESSION['token']) ) || $num == '' )
{
	$dataArr = array( "status"=> '500' , "err" => '參數有誤！' );
}
else
{
	if( md5($_SESSION['token']) == $key && $_SESSION['number'] == $num )
	{
		$db_tool = new DB_Tool;
		$db = &$db_tool->get_DB();
		
		$sql = "UPDATE `cny2017_coupon_test` SET is_playing = 'N' , is_delete = 'Y' WHERE `number` = ? ";
		$std = $db->prepare($sql);
		$std->execute(array($num));
		$err    = NULL;
		$status = 200;
	}

	$dataArr = array( "status"=> $status , "err" => $err );
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($dataArr);

?>