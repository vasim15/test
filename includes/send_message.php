<?php

     $arr['userid'] = "null";
     if (isset($DATA_OBJ->find->userid)) {
         $arr['userid'] = $DATA_OBJ->find->userid;

     }
     $sql = "select * from users where userid = :userid limit 1";
     $result = $DB->read($sql,$arr);
     if (is_array($result)) {

        $arr['message'] = $DATA_OBJ->find->message;
        $arr['date'] = date("Y-m-d H:i:s");
        $arr['sender'] = $_SESSION['userid'];
        $arr['msgid'] = get_rendom_string_max(60);
            $arr2['sender'] = $_SESSION['userid'];
            $arr2['receiver'] = $arr['userid'];



     $sql2 = "select * from messages where (sender = :sender && receiver = :receiver) || (sender = :receiver && receiver = :sender) limit 1";
     $result2 = $DB->read($sql2,$arr2);
     if (is_array($result2)) {
        $arr['msgid'] = $result2[0]->msgid;

        
     }

     $query3 = "insert into messages (sender,receiver,message,date,msgid) values(:sender,:userid,:message,:date,:msgid)";
     $DB->write($query3,$arr);

     $row = $result[0];
     $image = ($row->gender == "male") ? "ui/images/male.png" : "ui/images/female.jpg";
        if (file_exists($row->image)) {
          $image = $row->image;
        }
        $row->image = $image;
        $mydata = "Now Chatting with:<br>
                   <div id='active_contact'>
                   <img src='$image'>
                   $row->username            
                   </div>";

        $messages = "
                  <div id='messages_holder_parent' style='height:102%;background-color: #f2f7f8;'>
                  <div id='active_contact'>
                    <img src='$image'>
                    $row->username 
                    </div>
                  <div id='messages_holder' style='height: 460px;overflow-y:scroll;'>";
        $a['msgid'] = $arr['msgid'];

        $sql4 = "select * from messages where msgid = :msgid order by id desc";
        $result3 = $DB->read($sql4,$a);
        if (is_array($result3)) {
            $result3 = array_reverse($result3);
          foreach ($result3 as $data){
            $myuser = $DB->get_user($data->sender);
            if ($_SESSION['userid'] == $data->sender) {
                $messages .= message_right($data,$myuser);

            }else{
                $messages .= message_left($data,$myuser);
              
            }
          }
        } 

        $messages .= message_control();  

     $info->user = $mydata;
     $info->messages = $messages;
     $info->data_type = "send_message";
     echo json_encode($info);
     }else{

     $info->message = "No Contacts was Not found";
     $info->data_type = "send_message";
     echo json_encode($info);

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

					