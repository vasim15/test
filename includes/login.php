<?php

	
	//login
$info = (Object)[];
	$data = false;

	//validate info
	$data['email'] = $DATA_OBJ->email;
	if (empty($DATA_OBJ->email)) {
		$errore .= "Please enter an email   <br>";
	}else{
		
			
		 if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $DATA_OBJ->email)){
			$errore .= " please enter a valid email it should have @ and .";
			
		
	     }
    }
    if (empty($DATA_OBJ->password)) {
		$errore .= "Please enter a password  <br>";
	}else{
		if (strlen($DATA_OBJ->password) < 3) {
			$errore .= "password must be at lease  6 char";
			
		}
	}
	
	if ($errore == "") {
		$query = "SELECT * FROM users WHERE email = :email limit 1";
        $result = $DB->read($query,$data);

       if(is_array($result)){
       	$result = $result[0];
       	    if ($result->password == $DATA_OBJ->password)
       	    {
   	            $_SESSION['userid'] = $result->userid;
   	            $info->massage = "You're successfully logged in";
   	            $info->data_type = "info";
   	            echo json_encode($info);


       	    }else{

       		$info->message = "This is a wrong password";
   	        $info->data_type = "errore";
   	        echo json_encode($info);

       	    }
       	}else{
    	$info->message = "This is a wrong email";
   	    $info->data_type = "errore";
   	    echo json_encode($info);
       }
   }else{
   	$info->message = $errore;
   	$info->data_type = "errore";
   	echo json_encode($info);

   }



   
	

	   




?>