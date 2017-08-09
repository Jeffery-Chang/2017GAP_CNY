<?php
function get_ip()
{
	global $_SERVER;
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
		$onlineip = getenv('HTTP_CLIENT_IP');
	} elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
		$onlineip = getenv('HTTP_X_FORWARDED_FOR');
	} elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
		$onlineip = getenv('REMOTE_ADDR');
	} elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
		$onlineip = $_SERVER['REMOTE_ADDR'];
	}
	$onlineip = preg_match("/[\d\.]{7,15}/", $onlineip, $onlineipmatches);
	return $onlineipmatches[0];
}

function window_alert($alert_STR)
{
	echo "<script language='javascript'>";
	echo "window.alert('".$alert_STR."')";
	echo "</script>";
}

function window_open($url,$target="_self")
{
	echo "<script language='javascript'>";
	echo "window.open('".$url."','".$target."')";
	echo "</script>";
}

function get_date_time()
{
	date_default_timezone_set("Asia/Taipei");
	return date("Y-m-d H:i:s",time());
}

function format_date_time($date,$dateFormat)
{		
	return date($dateFormat,strtotime($date));
}

/*
function json_string($string){
	$par = array('"','\\');
	$rep = array('\"','\\\\');
	return str_replace($par, $rep, $string);
}
*/

function startsWith($haystack, $needle)
{
	$haystack = trim($haystack);
	$needle = trim($needle);
	return !strncasecmp($haystack, $needle, strlen($needle));
}

function endsWith($haystack, $needle)
{
	$haystack = trim($haystack);
	$needle = trim($needle);
	$length = strlen($needle);
	if ($length == 0) {
		return true;
	}
	return (substr($haystack, -$length) === $needle);
}

function jsonstring($string){
	$par = array('\\','"');
	$rep = array('\\\\','\"');
	return str_replace($par, $rep, $string);
}

function input_filter($str,$filter = FILTER_UNSAFE_RAW ,$options = null){
	if(gettype($str)=='array'){
		foreach ($str as $key => $value) {
			$value = iconv('utf-8','utf-8//IGNORE',$value);
			if($options){
				$value =  filter_var($value, $filter, $options);
			}else{
				$value =  filter_var($value, $filter);
			}
			$str[$key] = $value;
		}
	}else{
		$str = iconv('utf-8','utf-8//IGNORE',$str);
		if($options){
			$str =  filter_var($str, $filter, $options);
		}else{
			$str =  filter_var($str, $filter);
		}
	}
	return $str;
}

function json_encode_new($array){
 array_walk_recursive($array, 'array_json');
 return urldecode(json_encode($array));
}

function array_json(&$value, $key){
 $value = urlencode(jsonstring($value));
}

function get_user_agent(){
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	return $useragent;
}

function write_log($status,$data_array)  //傳入資料夾名 想寫近的狀態 資料       
{
	date_default_timezone_set("Asia/Taipei");
    $textname = date("Ymd").".txt"; 
    #$URL = $_SERVER['DOCUMENT_ROOT']."/baseball_warrior/act2014/log/";                        
    $URL = $_SERVER['DOCUMENT_ROOT']."/pubgame/act2014/log/";                        
    if(!is_dir($URL))                                
        mkdir($URL,0700);
    
    $URL .= $textname;                           

    $time = $status.":".date("H:i:s"); 
    $writ_tmp = '';
    foreach ($data_array as $key => $value) 
    {
       $writ_tmp .= ",".$key."=".$value;             
    }
    $writ_tmp .= ",IP=".get_ip();
    $writ_tmp .= ",USER_AGENT=".get_user_agent();
    $writ_tmp .= ",REFER=".$_SERVER['HTTP_REFERER'];
    $write_data = $time.$writ_tmp."\n"; 
                
    $fileopen = fopen($URL, "a+");               
    fseek($fileopen, 1);
    fwrite($fileopen,$write_data);          
    fclose($fileopen);
}


function write_js($doc,$data)
{
	$textname = $doc.".js"; 
	#$URL = $_SERVER['DOCUMENT_ROOT']."/baseball_warrior/act2014/log/";                        
	//$URL = $_SERVER['DOCUMENT_ROOT']."/pubgame/act2014/api/server/";                        
	$URL = "/var/www/vhosts/webgene.com.tw/lab.webgene.com.tw/pubgame/act2014/api/server/";
	
	$URL .= $textname;                           

	$writ_tmp .= $data;
	
	$write_data = $writ_tmp; 
	            
	$fileopen = fopen($URL, "w+");               
	fseek($fileopen, 0);
	fwrite($fileopen,$write_data);          
	fclose($fileopen);
}

function call_outer_api($url,$param,$method="get",$decode = true){
	$service_url = $url;
	$curl = curl_init($service_url);

	if($method == 'post'){
		$curl_post_data = $param;
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
	}
	
	$curl_response = curl_exec($curl);
	if ($curl_response === false) {
	    $info = curl_getinfo($curl);
	    curl_close($curl);
	    die('error occured during curl exec. Additioanl info: ' . var_export($info));
	}
	curl_close($curl);
	if($decode){
		$decoded = json_decode($curl_response);
		if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
		    die('error occured: ' . $decoded->response->errormessage);
		}	
		$return = $decoded;
	}else{
		$return = $curl_response;
	}
	
	//echo 'response ok!';
	return $return;
	//var_export($decoded->response);
}

function reuse_number( $now_time )
{
	global $db, $db_tool;
	$date = strtotime($now_time);
    $date = strtotime("-1 day", $date);
    $date = date('Y-m-d H:i:s', $date);

	$sql = "SELECT * FROM `cny2017_coupon_test` WHERE is_playing = 'Y' AND is_delete = 'N' AND play_time < '$date' ";
	$std = $db->prepare($sql);
	$std->execute(array()) ;
	$rc  = $std->rowCount();
	$rs  = $std->fetchAll();

	if( $rc != 0 )
	{ 
	    foreach($rs as $key => $data):

	    	echo $is_playing = $data['id'];

	    	$sql = "UPDATE `cny2017_coupon_test` SET is_playing = 'N' , play_time = NULL WHERE id = '$is_playing' ";
			$std = $db->prepare($sql);
			$std->execute();
	    endforeach; 
	}
	return 0;
}