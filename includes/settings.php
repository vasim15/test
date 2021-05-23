<?php
     $sql = "select * from users where userid = :userid limit 1";
     $id = $_SESSION['userid'];
     $data = $DB->Read($sql,['userid'=>$id]);
     $mydata = "";
     if(is_array($data)){
         $data = $data[0];
         $image = ($data->gender == "male") ? "ui/images/male.png" : "ui/images/female.jpg";
        if (file_exists($data->image)) {
          $image = $data->image;
          
        }
        $gender_male = "";
        $gender_female = "";
        if ($data->gender == "male") {

          $gender_male = "checked";
        }else{
          $gender_female = "checked";
        }

         $mydata = '
   <style type="text/css">
    @keyframes appear{
        0%{opacity:0;transform: translateY(50px)}
        100%{opacity:1;transform: translateY(0px)}

     }
    
    form{
      text-align: left;
      margin: auto;
      padding: 10px;
      width: 100%;
      max-width: 300px;
    }
    input[type=text],input[type=password],[type=button]{
      padding: 10px;
      margin: 10px;
      width: 100%;
      border-radius: 5px;
      border:solid 1px grey;
    }
    input[type=button]{
      width: 106%;
      cursor: pointer;
      background-color: #2b5488;
      color: white;
    }
    input[type=radio]{
      transform: scale(1.2);
      cursor: pointer;
    }
    #error{
      text-align: center;
      padding: 0.5em;
      background-color: #ecaf91;
      color: white;
      display: none;
    }
    #setting_picture{
    width:200px;

      text-align: left;
    }
    .dragging{
      border: dashed 2px #aaa;
    }


  </style>



  
    <div id="error" style="">
    </div>  
    <div style="display:flex;animation: appear 0.5s ease">
      <div id="setting_picture" style="">
        <span style="font-size:11px;">   drag and drop an image to change</span><br>
          <img ondragover="handle_drag_and_drop(event)" ondrop="handle_drag_and_drop(event)" ondragleave="handle_drag_and_drop(event)" src="'.$image.'" style="width:200px;height:200px;margin:10px;border-radius:20%">

          <label for="change_image_input" id="change_image_button" style="width:100%;background-color:#9b9a80;display:inline-block;padding:1em;border-radius:5px;cursor:pointer;">
          Change Image
          </label>
          <input type="file" id="change_image_input" onchange="uploade_profile_image(this.files)" style="display:none;">

      </div>
    <form id="myform">
      <input type="text" name="username"  placeholder="Username" value="'.$data->username.'"><br>
      <input type="text" name="email"  placeholder="Email" value="'.$data->email.'"><br>
      <div style="padding: 10px; color: grey;">
          <br>Gender:<br>
          <input type="radio" value="male" name="gender" '.$gender_male.'>Male<br>
          <input type="radio" value="female" name="gender" '.$gender_female.'>Female<br>
        </div>
      <input type="password" name="password" placeholder="Password"><br>
      <input type="password" name="password2" placeholder="Retype"><br>
      <input type="button" id="save_settings_button" value="Save Setting" onclick="collect_data(event)"><br>
      <br>
      
    </form>
    
  </div>';


     $info->message = $mydata;
     $info->data_type = "contacts";
     echo json_encode($info);

}else{
  $info->message = "No Contacts were found";
  $info->data_type = "errore";
  echo json_encode($info);

}


     
      

     
?>

					