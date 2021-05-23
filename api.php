<?php

session_start();

$DATA_RAW = file_get_contents("php://input");
$DATA_OBJ = json_decode($DATA_RAW);

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


$errore = "";

// proccess the data
if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "signup"){
include("includes/signup.php");
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "login"){
include("includes/login.php");
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "logout"){
	include("includes/logout.php");
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "user_info"){
	include("includes/user_info.php");
}elseif(isset($DATA_OBJ->data_type) && ($DATA_OBJ->data_type == "contacts" || $DATA_OBJ->data_type == "contacts_refresh")){
	include("includes/contacts.php");
}
elseif(isset($DATA_OBJ->data_type) && ($DATA_OBJ->data_type == "chats" || $DATA_OBJ->data_type == "chats_refresh")){
	include("includes/chats.php");
}
elseif(isset($DATA_OBJ->data_type) && ($DATA_OBJ->data_type == "status" || $DATA_OBJ->data_type == "status_refresh")){
    include("includes/status.php");
}
elseif(isset($DATA_OBJ->data_type) && ($DATA_OBJ->data_type == "status_box" || $DATA_OBJ->data_type == "status_box_refresh")){
    include("includes/status_box.php");
}
elseif(isset($DATA_OBJ->data_type) && ($DATA_OBJ->data_type == "message_box" || $DATA_OBJ->data_type == "message_box_refresh")){
    include("includes/message_box.php");
}
elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "settings"){
	include("includes/settings.php");
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "save_settings"){
	include("includes/save_settings.php");
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "send_message"){
	include("includes/send_message.php");
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "delete_message"){
	include("includes/delete_message.php");
}
elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "delete_threads"){
	include("includes/delete_threads.php");
}




function message_left($data,$row){
	$image = ($row->gender == "male") ? "ui/images/male.png" : "ui/images/female.jpg";
        if (file_exists($row->image)) {
          $image = $row->image;
        }
	    $a = "<div id='message_left'>
            <div></div>
            <img id='prof_img' src='$image' style='float:right;'>
            <b>$row->username</b><br>
            $data->message<br><br>";

            if ($data->files != "" && file_exists($data->files)) {
            	$a .= "<img src='$data->files' onclick='image_show(event)' style='width:100%;cursor:pointer;'><br>";
            }
            $a .= "<span style='font-size:11px;color:white;'>".date("jS M Y H:i:s a",strtotime($data->date))."</span> 
                <img id='trash' src='ui/icons/trash.png' onclick='delete_message(event)' msgid='$data->id'>           
              </div>";
    return  $a;
} 

function message_right($data,$row){
	$image = ($row->gender == "male") ? "ui/images/male.png" : "ui/images/female.jpg";
        if (file_exists($row->image)) {
          $image = $row->image;
        }
	    $a = "
	    <div id='message_right'>
          <div>";
        if($data->received) {
          	$a .= "<img src='ui/icons/tick_grey.png' style=''>";
        }if ($data->seen){
          	$a .= "<img src='ui/icons/tick.png' style=''>";
        }

          $a .= "</div>
            <img id='prof_img' src='$image' style='float:right;'>
            <b>$row->username</b><br>
            $data->message<br><br>";
            if ($data->files != "" && file_exists($data->files)) {
            	$a .= "<img src='$data->files' onclick='image_show(event)' style='width:100%;cursor:pointer'><br>";
            }
            $a .= "
            <span style='font-size:11px;color:#888;'>".date("jS M Y H:i:s a",strtotime($data->date))."</span> 
            <img id='trash' src='ui/icons/trash.png' onclick='delete_message(event)' msgid='$data->id'>           
            </div>";
        return $a;
} 
function message_control(){
	return "
	        </div>
	        <span onclick='delete_threads(event)' style='color:purple;cursor:pointer;'>Delete This Tread</span>
            <div style='display:flex;width:100%;height:40px;'>
                <label for='message_file'><img src='ui/icons/clip.png' style='opacity:0.8;width:30px;margin:5px;cursor:pointer;'></label>
                <input type='file' name='message_file' id='message_file' onchange='send_image(this.files)' style='display:none;'>
                <input type='text' id='message_text' onkeyup='enter_pressed(event)' placeholder='Type your messages' style='flex:6;border:solid thin #ccc;border-bottom:none;font-size:14px;padding:4px;'>
                <input style='flex:1;cursor:pointer;' type='button' name='send' value='send' onclick='send_message(event)'>
              </div>
            </div>";
} 

?>