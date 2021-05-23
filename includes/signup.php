<?php

	
	//signup
$info = (Object)[];
	$data = false;
	$data['userid'] = $DB->generate_id(20);
	$data['date'] = date("y-m-d H:i:s");
	
	//vallidate username
	$data['username'] = $DATA_OBJ->username;
	if (empty($DATA_OBJ->username)) {
		$errore .= "Please enter a valid usernamem   <br>";
	}else{
		if (strlen($DATA_OBJ->username) < 3) {
			$errore .= "username must be at lease 3 char";
			
		} if (!preg_match("/^[a-z A-Z]*$/", $DATA_OBJ->username)){
			$errore .= " please enter a valid user name ";
			
		}
	}
	$data['email'] = $DATA_OBJ->email;
	if (empty($DATA_OBJ->email)) {
		$errore .= "Please enter a valid email   <br>";
	}else{
		
			
		 if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $DATA_OBJ->email)){
			$errore .= " please enter a valid email ";
			
		
	     }
    }
    $data['gender'] = isset($DATA_OBJ->gender) ? $DATA_OBJ->gender : null;
	if (empty($DATA_OBJ->gender)) {
		$errore .= "Please select a Gender   <br>";
	}else{
		
			
		 if ($DATA_OBJ->gender != "male" && $DATA_OBJ->gender != "female"){
			$errore .= " please enter a valid gender";
			
		
	     }
	}
	$data['password'] = $DATA_OBJ->password;
	if (empty($DATA_OBJ->password)) {
		$errore .= "Please enter a valid password  <br>";
	}

	$password = $DATA_OBJ->password2;
	if (empty($DATA_OBJ->password2)) {
		$errore .= "Please confirm a password  <br>";
	}else{
		 if ($DATA_OBJ->password !== $DATA_OBJ->password2){
			$errore .= " password is not mached ";
			
		}
		if (strlen($DATA_OBJ->password) < 3) {
			$errore .= "password must be at lease  6 char";
			
		}
	}
	
	
	if ($errore == "") {
		$query = "insert into users(userid,username,email,gender,password,date) values (:userid,:username,:email,:gender,:password,:date)";
        $result = $DB->write($query,$data);

       if($result){
    	$info->message = "your profile was created";
   	    $info->data_type = "info";
   	    echo json_encode($info);


       }else{
    	$info->message = "Your pafile was NOT created";
   	    $info->data_type = "errore";
   	    echo json_encode($info);
       }
   }else{
   	$info->message = $errore;
   	$info->data_type = "errore";
   	echo json_encode($info);

   }

   
	

	   




?>