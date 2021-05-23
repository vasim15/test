<?php
     $new_message = false;
     $refresh = false;
     $seen = false;
     $time = time();
     if ($DATA_OBJ->data_type == "contacts_refresh") {
        $refresh = true;
     }
     $myid = $_SESSION['userid'];
     $sql = "select * from users where userid != '$myid' limit 10";
     $myusers = $DB->read($sql,[]);
     $mydata = "";
     if(!$refresh){
        $mydata = '
     <style>
     @keyframes appear{
        0%{opacity:0;transform: translateY(50px)}
        100%{opacity:1;transform: translateY(0px)}

     }
     #contact{
        cursor:pointer;
        transition: all .5s cubic-bezier(0.68, -2, 0.265, 1.55);
    }
    #contact:hover{
    transform: scale(1.1);
    }.0
     </style>


     <div id="contact_parent" style="text-align:center; animation: appear 0.5s ease;overflow-y:scroll;height:520px;">';

     }
    
        
          
      
     if (is_array($myusers)) {
        $msgs = array();
        $me = $_SESSION['userid'];
        $query = "select * from messages where receiver = '$me' && seen = 0";
        $mymgs = $DB->read($query,[]);
        if (is_array($mymgs)) {
            foreach ($mymgs as $row2) {
                $sender = $row2->sender;
                $id = $row2->id;
                $received = $row2->received;
                if($received == 0){
                    $new_message = true;
                }
                if (isset($msgs[$sender])) {
                    $msgs[$sender]++;
                }else{
                    $msgs[$sender] = 1;
                }
                $DB->write("update messages set received = 1 where id = '$id' limit 1");
                
            }
        }       

     	foreach($myusers as $row){
     		$image = ($row->gender == "male") ? "ui/images/male.png" : "ui/images/female.jpg";
     		if (file_exists($row->image)) {
     			$image = $row->image;
     			
     		}
		    $mydata .= "<div id='contact' style='position:relative;' userid='$row->userid' onclick='start_chat(event)'>
		                <img src='$image'>
		                <br>$row->username";
            if ($row->online > $time) {
                $mydata .= "<div style='width:20px;height:20px;position:absolute;border-radius:50%;background-color:#32990d;color:white;border: solid 2px white;top:0px;right:0px;'></div>";
            }
           if(count($msgs) > 0 && isset($msgs[$row->userid])){

               $mydata .= "<div style='width:20px;height:20px;position:absolute;border-radius:50%;background-color:orange;color:white;top:0px;'>".$msgs[$row->userid]."</div>";

            }

        					
            $mydata .= "</div>";
	    }
     	
     
					   
    
	   $mydata .= ' </div>';

       if (!$refresh) {
           $info->message = $mydata;
           $info->data_type = "contacts";
           $info->new_message = $new_message;
           echo json_encode($info);
        }else {
           $info->message = $mydata;
           $info->data_type = "contacts_refresh";
           $info->new_message = $new_message;
           echo json_encode($info);
        }

     
     }else{
  

     $info->message = "No Contacts were found";
   	 $info->data_type = "errore";
   	 echo json_encode($info);
    }
?>

					