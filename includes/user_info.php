<?php

	
	//login
$info = (Object)[];
	$data = false;

	//validate info
	$data['userid'] = $_SESSION['userid'];
	
	
	if ($errore == "") {
		$query = "SELECT * FROM users WHERE userid = :userid limit 1";
        $result = $DB->read($query,$data);

       if(is_array($result)){
       	$result = $result[0];
       	$result->data_type = "user_info";

        $image = ($result->gender == "male") ? "ui/images/male.png" : "ui/images/female.jpg";
        if (file_exists($result->image)) {
          $image = $result->image;
          
        }
        $result->image = $image;
       	echo json_encode($result);
       	    
       	}else{
    	$info->message = "Please Try Again";
   	    $info->data_type = "errore";
   	    echo json_encode($info);
       }
   }else{
   	$info->message = $errore;
   	$info->data_type = "errore";
   	echo json_encode($info);

   }



   
	

	   




?>