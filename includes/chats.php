<?php

     $arr['userid'] = "null";
     if (isset($DATA_OBJ->find->userid)) {
         $arr['userid'] = $DATA_OBJ->find->userid;

     }
     $s = $_SESSION['userid'];
     $refresh = false;
     $seen = false;
     $time = time();
     if ($DATA_OBJ->data_type == "chats_refresh") {
        $refresh = true;
        $seen = $DATA_OBJ->find->seen;
     }
     $mydata ="";$sql = "select * from users where userid = :userid limit 1";
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
            $info->data_type = "chats";
        }else{
            $info->messages = $messages;
            $info->new_message = $new_message;
            $info->data_type = "chats_refresh";

        }
     
     echo json_encode($info);
     }else{
         
           



        $a['userid'] = $s;

        $sql4 = "select * from messages where (sender = :userid || receiver = :userid) group by msgid order by id desc limit 10";
        $result3 = $DB->read($sql4,$a);
        $mydata .= "Previews Chats:<br>
                     <div onclick='set_seen(event)' style='height:100%;'>
                     <div style='min-height: 600px;overflow-y:scroll;'>";
        if (is_array($result3)) {
            $result3 = array_reverse($result3);

            $msgs = array();
            $query = "select * from messages where receiver = '$s' && seen = 0";
            $mymgs = $DB->read($query,[]);

             if (is_array($mymgs)) {
                 foreach ($mymgs as $row2) {
                  $num = $row2->sender;
                  $id = $row2->id;
                  $received = $row2->received;
                  if($received == 0){
                    $new_message = true;
                  }
                  if (isset($msgs[$num])) {
                    $msgs[$num]++;
                  }else{
                    $msgs[$num] = 1;
                  }
                $DB->write("update messages set received = 1 where id = '$id' limit 1");
                
            }}
            foreach ($result3 as $data){
               $other_user = $data->sender;

               if ($data->sender == $_SESSION['userid']) {
                    $other_user = $data->receiver;
               }

                $myuser = $DB->get_user($other_user);
                $image = ($myuser->gender == "male") ? "ui/images/male.png" : "ui/images/female.jpg";
                if (file_exists($myuser->image)) {
                $image = $myuser->image;
                }
                
                 $mydata .= "
                    <div id='active_contact' userid='$myuser->userid' onclick='start_chat(event)' style='cursor:pointer;position:relative;'>
                    <img src='$image'>
                    $myuser->username <br>
                    <span style='font-size:11px;'>$data->message</span>";  
                    if ($myuser->online > $time) {
                        $mydata .= "<div style='width:20px;height:20px;position:absolute;border-radius:50%;background-color:#32990d;color:white;border: solid 2px white;top:0px;'></div>";
                    }
                    if(count($msgs) > 0 && isset($msgs[$myuser->userid])){

                        $mydata .= "<div style='width:20px;height:20px;position:absolute;border-radius:50%;background-color:orange;color:white;right:10px;'>".$msgs[$myuser->userid]."</div>";
                    }

                          
                    $mydata .="</div>";

                 
            
               }
            }
                $mydata .= "
                    </div>
                    </div>";

            

     $info->messages = $mydata;
     
     $info->data_type = "chats";
     echo json_encode($info);

     }
    $time = time() + 5;
     $qury = "update users set online = $time where userid = $s limit 1";
     $DB->write($qury);
?>

					