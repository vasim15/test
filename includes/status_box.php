<?php

     $arr['userid'] = "null";

     if (isset($DATA_OBJ->find->userid)) {
         $arr['userid'] = $DATA_OBJ->find->userid;

     }
     $refresh = false;
     $seen = false;
     if ($DATA_OBJ->data_type == "status_box_refresh") {
        $refresh = true;
        $seen = $DATA_OBJ->find->seen;
     }
     $viewid = $_SESSION['userid'];
     $sql = "select * from users where userid = :userid limit 1";
     $result = $DB->read($sql,$arr);
     if (is_array($result)) {

     $row = $result[0];
     $view_date = date("Y-m-d H:i:s");
     $arrayName = array('userid' => $viewid,'date'=>$view_date );
     $arrayn = serialize($arrayName);
     $image = ($row->gender == "male") ? "ui/images/male.png" : "ui/images/female.jpg";
        if (file_exists($row->image)) {
          $image = $row->image;

        }

        $row->image = $image;
        $new_message = false;
        
        $messages = "";
        
        
    
            $messages .= "     
                     <div id='status_holder_parent' onclick='set_seen(event)' style='height:100%;background-color: #f2f7f8;'>
                     <div id='active_contact' style='height:20%;border-radius:5px;'>
                    <img src='$image' style='border-radius:50%;'>
                    $row->username 
                    </div>
                     <div id='status_holder' style='height: 600px;overflow-y:scroll;'>";


                     $sql2 = "select * from status where userid = :userid && date >= ADDDATE(CURRENT_TIMESTAMP(), INTERVAL -1 DAY)";
                     $result2 = $DB->read($sql2,$arr);
                     foreach ($result2 as $value) {
                        $status_file = $value->status_file;
                        $messages .= "<div>
                        <img src='$status_file' status_id='$value->status_id' style='cursor:pointer;'>
                        <span style='font-size:11px;'>".date("jS M Y H:i:s a",strtotime($row->date))."</span>

                         </div>";
                         $qury = "update status set status_desc = '$arrayn' where status_id = '$value->status_id->' limit 1";
                        $DB->write($qury);
                     }

           $messages .= " </div>
                    </div>";
             
            
            

         

     

        if (!$refresh) {
            $info->user = $messages;
            $info->new_message = $new_message;
            $info->data_type = "status_box";
        }else{
            $info->user = $messages;
            $info->new_message = $new_message;
            $info->data_type = "status_box_refresh";

        }

     echo json_encode($info);
 }else{
    $sql2 = "select * from status where userid = '$viewid' && date >= ADDDATE(CURRENT_TIMESTAMP(), INTERVAL -1 DAY) limit 10 ";
    $result4 = $DB->read($sql2,[]);
        if (is_array($result4)) {
              $result3 = array_reverse($result4);
              $mydata = "<div id='status_holder_parent' style='height:100%;'>
                     <div id='active_contact' style='height:20%;border-radius:5px;'>
                    
                      your Status
                      </div>
                     <div id='status_holder' style='height: 600px;overflow-y:scroll;'>";
              foreach ($result4 as $row) {         
                  $status_file = $row->status_file;

                    $mydata .= "
                               <div id='active_status' style='cursor:pointer;position:relative;' userid='$row->userid' onclick='view_status(event)' style='height:20%;border-radius:5px;'>
                                <img src='$status_file' style='cursor:pointer;'>                    
                                <span style='font-size:11px;'>".date("jS M Y H:i:s a",strtotime($row->date))."</span>
                                <div style='width:20px;height:20px;position:absolute;border-radius:50%;background-color:orange;color:white;right:10px;margin:auto 10px;font-size:18px;'>$row->view_num</div>
                                </div>";
                    }}
                    $mydata .= "</div>
                                </div>";

            $info->user = $mydata;
            $info->data_type = "status_box";
            echo json_encode($info);


 }
     


     
  

?>

					