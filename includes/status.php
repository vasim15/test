<?php

     $arr['userid'] = "null";
     $status_num = array();
     
     $refresh = false;
     $seen = false;
     if ($DATA_OBJ->data_type == "status_refresh") {
        $refresh = true;
        $seen = $DATA_OBJ->find->seen;
     }
     $mydata = "Previews Status:<br>
                    <div id='uplode_status' style='position:relative;' >
                    <label for='status_file' style='cursor:pointer;'>
                    <img src='ui/icons/uplode_status.png'>
                    <input type='file' name='status_file' id='status_file' onchange='uplode_status(this.files)' style='display:none;'> 
                    </label>
                    click to uplode status";

     $myid = $_SESSION['userid'];
     $status_num[$myid] = 0;
                        $sql2 = "select * from status where userid = '$myid' && date >= ADDDATE(CURRENT_TIMESTAMP(), INTERVAL -1 DAY)";
                        $result4 = $DB->read($sql2,[]);
                        if (is_array($result4)) {
                            $result4 = array_reverse($result4);                
                            foreach ($result4 as $row) {
                               $status_num[$myid]++;
                               $status_file = $row->status_file;
                               $mydata .= "<img src='$status_file' style='cursor:pointer' onclick='view_status(event)'>   ";
                            }
                            if(count($status_num) > 0 && isset($status_num[$myid])){
                                $mydata .= "<div style='width:20px;height:20px;position:absolute;border-radius:50%;background-color:orange;color:white;right:10px;top:20;margin:auto 20px;font-size:18px;'>".$status_num[$myid]."</div>";
                            }
                        }
                        $mydata .= "</div> <div style='height: 500px;overflow-y:scroll;'>";


     $sql = "select * from status where userid != '$myid' && date >= ADDDATE(CURRENT_TIMESTAMP(), INTERVAL -1 DAY)";
     $result3 = $DB->read($sql,[]);       
            
            if (is_array($result3)) {
                
                $result3 = array_reverse($result3);
                foreach ($result3 as $data){
                    $status_userid = $data->userid;
                    $myuser = $DB->get_user($status_userid);                    
                    $userid = $myuser->userid;                  
                    if (isset($status_num[$userid])) {  
                        continue;
                    }else{
                    
                        $image = ($myuser->gender == "male") ? "ui/images/male.png" : "ui/images/female.jpg";
                        if (file_exists($myuser->image)) {
                            $image = $myuser->image;
                        }
                
                         $mydata .= "
                            <div id='active_status' style='cursor:pointer;position:relative;' userid='$myuser->userid' onclick='view_status(event)'>
                            <img src='$image' style='height:20px;width:20px;'>";
                        $status_num[$userid] = 0; 
                        $sql2 = "select * from status where userid = '$userid' && date >= ADDDATE(CURRENT_TIMESTAMP(), INTERVAL -1 DAY) ";
                        $result4 = $DB->read($sql2,[]);
                        if (is_array($result4)) {
                        
                            foreach ($result4 as $row) {
                               $status_num[$userid]++;
                               $status_file = $row->status_file;
                        
                                $mydata .= "<img src='$status_file' status_id='$row->status_id' style='cursor:pointer;'>
                                    <span style='font-size:11px;'>".date("jS M Y H:i:s a",strtotime($row->date))."</span>";
                            }

                    
                           $mydata .= "$myuser->username ";
                           if(count($status_num) > 0 && isset($status_num[$userid])){
                               $mydata .= "<div style='width:20px;height:20px;position:absolute;border-radius:50%;background-color:orange;color:white;right:10px;margin:auto 10px;font-size:18px;'>".$status_num[$userid]."</div>";
                            }  
                        } 
                        $mydata .= "</div> ";
                 
                    }
                }
             
               
            }

            
       $mydata .= "</div>";
            
                
            

     $info->user = $mydata;
     $info->data_type = "status";
     echo json_encode($info);

     


     
  

?>

					