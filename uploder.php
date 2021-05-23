<?php
session_start();
$info = (object)[];

//check if logged in
if(!isset($_SESSION['userid']))
{
	if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type != "login" && $DATA_OBJ->data_type != "signup") {
		$info->logged_in = false;
	    echo json_encode($info);
	    die;
		
	}
	
}
require_once("classes/autoload.php");
$DB = new Database();
$data_type = "";
if (isset($_POST['data_type'])) {
	$data_type = $_POST['data_type'];
	
}
$destination = "";
if(isset($_FILES['file']) && $_FILES['file']['name'] != "");
{    
	$allowed[] = "image/jpeg";
	$allowed[] = "image/png";
	if($_FILES['file']['error'] == 0 && in_array($_FILES['file']['type'], $allowed)){
		$folder = "uploads/";
		if (!file_exists($folder)) {
			mkdir($folder,0777,true);
		}
		$destination = $folder . $_FILES['file']['name'];
		move_uploaded_file($_FILES['file']['tmp_name'], $destination);
		$info->message = "Your image was uploaded";
		$info->data_type = $data_type;
		echo json_encode($info);
		echo "";
	}
}

if ($data_type == "change_profile_image") {
	if ($destination != "") {
		$id = $_SESSION['userid'];
		$query = "update users set image = '$destination' where userid = '$id' limit 1";
		$DB->write($query,[]);     

	}
}else if ($data_type == "send_image") {
		$arr['userid'] = "null";
		if (isset($_POST['userid'])) {
			$arr['userid'] = addcslashes($_POST['userid'],'A..Z');
		}
		$arr['message'] = "";
        $arr['date'] = date("Y-m-d H:i:s");
        $arr['sender'] = $_SESSION['userid'];
        $arr['msgid'] = get_rendom_string_max(60);
        $arr['file'] = $destination;
            $arr2['sender'] = $_SESSION['userid'];
            $arr2['receiver'] = $arr['userid'];



            $sql2 = "select * from messages where (sender = :sender && receiver = :receiver) || (sender = :receiver && receiver = :sender) limit 1";
            $result2 = $DB->read($sql2,$arr2);
            if (is_array($result2)) {
               $arr['msgid'] = $result2[0]->msgid;
            }
        $query3 = "insert into messages (sender,receiver,message,date,msgid,files) values(:sender,:userid,:message,:date,:msgid,:file)";
        $DB->write($query3,$arr);
    }else if ($data_type == "uplode_status") {
		$arr3['userid'] = $_SESSION['userid'];
        $arr3['date'] = date("Y-m-d H:i:s");
        $arr3['status_id'] = get_rendom_string_max(60);
        $arr3['file'] = $destination;

        $query4 = "insert into status (status_id,userid,status_file,date) values(:status_id,:userid,:file,:date)";
        $DB->write($query4,$arr3);
    }

function get_rendom_string_max($lenght){
    $array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    $text = "";
    $lenght = rand(4,$lenght);
    for($i=0;$i<$lenght;$i++){
        $random = rand(0,61);
        $text .= $array[$random];
    }
    return $text;
}

?>