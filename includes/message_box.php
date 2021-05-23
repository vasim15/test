<?php

     $arr['userid'] = "null";
     if (isset($DATA_OBJ->find->userid)) {
         $arr['userid'] = $DATA_OBJ->find->userid;

     }
     $refresh = false;
     $seen = false;
     if ($DATA_OBJ->data_type == "message_box_refresh") {
        $refresh = true;
        $seen = $DATA_OBJ->find->seen;
     }
     $sql = "select * from users where userid = :userid limit 1";
     $result = $DB->read($sql,$arr);
     if (is_array($result)) {

     $row = $result[0];
     $image = ($row->gender == "male") ? "ui/images/male.png" : "ui/images/female.jpg";
        if (file_exists($row->image)) {
          $image = $row->image;

        }

        $row->image = $image;
        $new_message = false;
        $messages = "";
        if (!$refresh) {
        
        
    
            $messages = "     
                     <div id='messages_holder_parent' onclick='set_seen(event)' style='height:102%;background-color: #f2f7f8;'>
                     <div id='active_contact'>
                    <img src='$image'>
                    $row->username 
                    </div>
                     <div id='messages_holder' style='height: 460px;overflow-y:scroll;'>";
        }                
            $a['sender'] = $_SESSION['userid'];
            $a['receiver'] = $arr['userid'];

            $sql4 = "select * from messages where (sender = :sender && receiver = :receiver && deleted_sender = 0) || (receiver = :sender && sender = :receiver && deleted_receiver = 0) order by id desc limit 10";
            $result3 = $DB->read($sql4,$a);
            if (is_array($result3)) {
              $result3 = array_reverse($result3);
              foreach ($result3 as $data){
                $myuser = $DB->get_user($data->sender);
                if ($data->receiver == $_SESSION['userid'] && $data->received == 0) {
                    $new_message = true;
                    $DB->write("update messages set received = 1 where id = '$data->id' limit 1");
                }
                
                if ($data->receiver == $_SESSION['userid'] && $data->received == 1 && $seen) {
                    $DB->write("update messages set seen = 1 where id = '$data->id' limit 1");
                }
                
                if ($_SESSION['userid'] == $data->sender) {
                    $messages .= message_right($data,$myuser);
                
                

                }else{
                    $messages .= message_left($data,$myuser);
                    
              
                }
              }
            } 
            
            if(!$refresh){
        
            $messages .= message_control();

         }

     

        if (!$refresh) {
            $info->messages = $messages;
            $info->new_message = $new_message;
            $info->data_type = "message_box";
        }else{
            $info->messages = $messages;
            $info->new_message = $new_message;
            $info->data_type = "message_box_refresh";

        }
     echo json_encode($info);
     }


     
  

?>

					