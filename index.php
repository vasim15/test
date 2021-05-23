<!DOCTYPE html>
<html>
<head>
	<title>my chat</title>

    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		@font-face{
			font-family: headFont;
			src: url(ui/fonts/Summer-Vibes-OTF.otf);
		}
		@font-face{
			font-family: myFont;
			src:url(ui/fonts/OpenSans-Regular.ttf);
		}
		#wrapper{
			max-width: 900px;
			min-height: 500px;
			max-height: 2000px;
			display: flex;
			flex-direction: column;
			margin: auto;
			color: white;
			font-family: myFont;
			font-size: 13px;

		}
		#left_pannel{
			min-height: 40px;
			max-height: 200px;
			background-color: #27344b;
			flex: 1;
			text-align: center;
			display: flex;
			flex-direction: column;
		}
		#profile_image{
			width: 50px;
			border: solid thin white;
			border-radius: 50%;
			margin: 10px;
		}
		#left_pannel label{
			width: 100%;
			height: 20px;
			display: block;
			background-color: #404B56;
			border-bottom: solid thin #ffffff55;
			cursor: pointer;
			padding: 5px;
			transition: all 1s ease;
		}
		#left_pannel label:hover{
			background-color: #778593;
			border-bottom: solid thin #ffffff55;
			cursor: pointer;
			padding: 5px;
		}
		#left_pannel label img{
			float: right;
			width: 25px;
		}
		#right_pannel{
			min-height: 400px;
			background-color: white;
			flex: 4;
			text-align: center;
		}
		#header{
			background-color: #485b6c;
			flex: 60%;
			height: 70px;
			font-size: 40px;
			text-align: center;
			font-family: headFont;
			position: relative;
			display: flex;
		}
		#inner_left_pannel{
			width: 100%;
			background-color: #383e48;
			min-height: 620px;
		}
		#inner_right_pannel{
			background-color: #f2f7f8;
			min-height: 30px;
			transition: all 2s ease;
		}
		#radio_contacts:checked ~ #inner_right_pannel{
			flex: 0;
		}
		#radio_settings:checked ~ #inner_right_pannel{
			flex: 0;
		}
		#contact{
			width: 150px;
			height: 150px;
			margin: 10px;
			display: inline-block;
			vertical-align: top;
			
		}
		#contact img{
			width: 100px;
			height: 100px;
		}
		#active_contact{
			height: 70px;
			margin: 10px;
			border: solid thin #aaa;
			padding: 2px;
			background-color: #eee;
			color: #444;
			
		}
		#active_contact img{
			width: 70px;
			height: 70px;
			float: left;
			margin: 2px;
		}
		#active_status{
			height: 70px;
			margin: 10px;
			font-size: 30px;
			border-bottom: solid thin #aaa;
			padding: 2px;
			background-color: ##706973;
			color: ##cfcfe1;
			
		}
		#active_status img{
			width: 70px;
			height: 70px;
			border-radius: 50%;
			float: left;
			margin: 2px;
		}
		#uplode_status{
			height: 70px;
			margin: 10px;
			font-size: 30px;
			border-radius: 20px;
			border-bottom: solid thin #aaa;
			padding: 2px;
			background-color: #eee;
			color: #444;
			
		}
		#uplode_status label img{
			width: 70px;
			height: 70px;
			border-radius: 50%;
			float: left;
			margin: auto 5px;
		}
		#uplode_status img{
			width: 70px;
			height: 70px;
			border-radius: 50%;
			float: left;
			margin: auto 5px;
		}
		#message_left{
			margin: 10px;
			padding: 2px;
			padding-right: 10px;
			background-color: #c979d5;
			color: white;
			float: left;
			box-shadow: 0px 0px 10px #aaa;
			border-bottom-left-radius: 50%;
			border-top-right-radius: 30%;
			position: relative;
			width: 60%;
			
		}
		#message_left #prof_img{
			width: 60px;
			height: 60px;
			float: right;
			margin: 2px;
			border-radius: 50%;
			border: solid 2px white;
		}
		#message_left div img{
			width: 25px;
			height: 18px;
			background-color: #34474f;
			border: solid 2px white;
			border-radius: 50%;
			position: absolute;
			left: -10px;
			top: 30px;
		}
		#message_left #trash{
			width: 20px;
			height: 20px;
			position: absolute;
			top: 15px;
			right: -10px;
			border: none;
			cursor: pointer;
		}
		#message_right{
			margin: 10px;
			padding: 2px;
			padding-right: 10px;
			background-color: #eee;
			color: #444;
			float: right;
			box-shadow: 0px 0px 10px #aaa;
			border-bottom-right-radius: 50%;
			border-top-left-radius: 30%;
			position: relative;
			width: 60%;
			
		}
		#message_right #prof_img{
			width: 60px;
			height: 60px;
			float: left;
			margin: 2px;
			border-radius: 50%;
			border: solid 2px white;
		}
		#message_right div img{
			width: 25px;
			height: 18px;
			float: none;
			margin: 0px;
			border-radius: 50%;
			border: none;
			position: absolute;
			top: 30px;
			right: 10px;
		}

		#message_right #trash{
			width: 20px;
			height: 20px;
			position: absolute;
			top: 15px;
			left: -10px;
			cursor: pointer;
		}
		
		#message_right div{
			width: 20px;
			height: 20px;
			background-color: #34474f;
			border: solid 2px white;
			border-radius: 50%;
			position: absolute;
			right: -10px;
			top: 20px;
		}
		.loader_on{
			position: absolute;
			width: 30%;
			flex: 1;

		}
		.loader_off{
			display: none;
		}
		.image_on{
			position: absolute;
			height: 450px;
			width: 450px;
			margin:auto;
			z-index: 10;
			top: 50px;
			left: 50px;

		}
		.image_off{
			display: none;
		}


	</style>
</head>
<body>
	<div id="wrapper">
		<div id="left_pannel">
			<div id="header">
				<div style="display: flex;text-align: left;flex: 1;" >

			   <img id="profile_image" src="ui/images/female.jpg" >
			   <span id="username">Welcom</span>
			   <br>
			   <span id="email" style="font-size: 20px;opacity: 0.5;">
			   Please Signup
			   </span>
			   
			</div>
			<div style="flex: 2;text-align: left;">
				<div>
			     my chat</div>
				<div id="loader_holder" class="loader_on">
					<img src="ui/icons/loading.gif" style="width: 70px;">
					
				</div>

				<div style="" id="image_viewer" class="image_off" onclick="close_image(event)">
					
				</div>
			</div>
				<button id="logout" style="background-color: #485b6c;width: 100px;height: 50px;margin: 13px;color: white;border-radius: 15px;"><img style="width: 20px;margin: auto;" src="ui/icons/settings.png">Logout</button>

		   </div>
			<div id="user_info" style="padding: 4px;display: flex;max-height:200px;flex: 40%; ">
			
			   <div style="flex: 4;display: flex;">
			   	   <label id="label_chats" for="radio_chat" style="flex: 1;">Chat <img src="ui/icons/chat.png"></label>
			   	   <label id="label_status" for="radio_status" style="flex: 1;">Status <img src="ui/icons/settings.png"></label>
			   	   <label id="label_contacts" for="radio_contacts" style="flex: 1;">Contacts <img src="ui/icons/contacts.png"> </label>
			   	   <label id="label_settings" for="radio_settings" style="flex: 1;">Settings <img src="ui/icons/settings.png"></label>
			   	   
			   </div>
		    </div>
		    
		</div>
		<div id="right_pannel">
			
			<div id="container" style="display: flex;flex-direction: column;">
				
				<div id="inner_left_pannel">
					
				</div>
					<input type="radio" id="radio_chat" name="myradio" style="display: none;">
					<input type="radio" id="radio_status" name="myradio" style="display: none;">
					<input type="radio" id="radio_contacts" name="myradio" style="display: none;">
					<input type="radio" id="radio_settings" name="myradio" style="display: none;">
					<input type="radio" id="radio_message_box" name="myradio" style="display: none;">
					<input type="radio" id="radio_status_box" name="myradio" style="display: none;">


			 </div>
		</div>
	</div>

</body>
</html>
<script type="text/javascript">
	var sent_audio = new Audio("pipboy_email_sent.mp3");
	var received_audio = new Audio("message_ticks_3.mp3");
	var CURRENT_CHAT_USER = "";
	var ONLINE = true;
	var SEEN_STATUS = false;
	function _(element){
		return document.getElementById(element);
	}
	var logout = _("logout");
	logout.addEventListener("click",logout_user);
	var label_contacts = _("label_contacts");
	label_contacts.addEventListener("click",contacts_user);
	var label_chats = _("label_chats");
	label_chats.addEventListener("click",chats_user);
	var label_status= _("label_status");
	label_status.addEventListener("click",status_user);
	var label_settings = _("label_settings");
	label_settings.addEventListener("click",settings_user);

	function get_data(find,type){
		var xml = new XMLHttpRequest();
		var loader_holder = _("loader_holder");
		loader_holder.className = "loader_on";
		xml.onload = function(){
			if(xml.readyState == 4 || xml.status == 200){
				loader_holder.className = "loader_off";
				handle_result(xml.responseText,type);
			}
		
	}
	var data = {};
	data.find = find;
	data.data_type = type;
	var data = JSON.stringify(data);

	xml.open("POST","api.php",true);
	xml.send(data);
    }
    function handle_result(result,type){
    	console.log(result);
    	
    	if (result.trim() != "") {
    		
    	    var obj = JSON.parse(result);
    	    if (typeof(obj.logged_in) != "undefined" && !obj.logged_in) {
    		window.location = "login.php";

    	    }else{
                
                switch(obj.data_type){
                	case "user_info":
                	    var username = _("username");
                	    var email = _("email");
                	    var profile_image = _("profile_image");

                	    username.innerHTML = obj.username;
                	    email.innerHTML = obj.email;
                	    profile_image.src = obj.image;
                	    break;
                	
                	    case "contacts":
                	    var inner_left_pannel = _("inner_left_pannel");
                	    inner_left_pannel.innerHTML = obj.message;
                	    var contact_parent = _("contact_parent");
                	    setTimeout(function(){
                	    	contact_parent.scrollTo(contact_parent.scrollHeight,0);
                	    	contact_parent.focus();
                	    },1000);
                	    if (typeof obj.new_message != 'undefined') {
                	    	if (obj.new_message) {
                	    		received_audio.play(); 
                	    		
                	    	}
                	    }
                	    break;
                	case "contacts_refresh":
                	    var contact_parent = _("contact_parent");
                	    
                	    if (typeof obj.new_message != 'undefined') {
                	    	if (obj.new_message) {
                	    		received_audio.play();
                	    		setTimeout(function(){
                	    	        contact_parent.scrollTo(contact_parent.scrollHeight,0);
                	    	        contact_parent.focus();
                	            },100); 
                	    		
                	    	}
                	    }
                	    break;
                	case "chats_refresh":
                	    SEEN_STATUS = false;
                	    var messages_holder = _("messages_holder");
                	    messages_holder.innerHTML = obj.messages;
                	    if (typeof obj.new_message != 'undefined') {
                	    	if (obj.new_messag) {
                	    		received_audio.play();

                	            setTimeout(function(){
                	    	        messages_holder.scrollTo(0,messages_holder.scrollHeight);
                	    	        var message_text = _("message_text");
                	    	        message_text.focus();

                	                },100);
                	    	}
                	    }
                	    if (typeof obj.new_message != 'undefined') {
                	    	if (obj.new_message) {
                	    		received_audio.play(); 
                	    		
                	    	}
                	    }
                	    break;
                	 case "send_message":
                	    sent_audio.play(); 
                	   
                	case "chats":
                	    SEEN_STATUS = false;
                	    var inner_left_pannel = _("inner_left_pannel");
                	    inner_left_pannel.innerHTML = obj.messages;
                	   var messages_holder = _("messages_holder");
                	    setTimeout(function(){
                	    	messages_holder.scrollTo(0,messages_holder.scrollHeight);
                	    	var message_text = _("message_text");
                	    	message_text.focus();

                	    },100);
                	    if (typeof obj.new_message != 'undefined') {
                	    	if (obj.new_message) {
                	    		received_audio.play(); 
                	    		
                	    	}
                	    }
                	    break;
                	    
                	    
                	case "message_box":
                	    SEEN_STATUS = false;
                	    var inner_left_pannel = _("inner_left_pannel");
                	    inner_left_pannel.innerHTML = obj.messages;
                	    var messages_holder = _("messages_holder");
                	    setTimeout(function(){
                	    	messages_holder.scrollTo(0,messages_holder.scrollHeight);
                	    	var message_text = _("message_text");
                	    	message_text.focus();

                	    },100);
                	    if (typeof obj.new_message != 'undefined') {
                	    	if (obj.new_message) {
                	    		received_audio.play(); 
                	    		
                	    	}
                	    }
                	    break;
                	    case "status":
                	    SEEN_STATUS = false;
                	    var inner_left_pannel = _("inner_left_pannel");
                	    inner_left_pannel.innerHTML = obj.user;
                	    
                	    if (typeof obj.new_message != 'undefined') {
                	    	if (obj.new_message) {
                	    		received_audio.play(); 
                	    		
                	    	}
                	    }
                	    break;
                	case "status_box":
                	    SEEN_STATUS = false;
                	    var inner_left_pannel = _("inner_left_pannel");
                	    inner_left_pannel.innerHTML = obj.user;
                	    
                	    if (typeof obj.new_message != 'undefined') {
                	    	if (obj.new_message) {
                	    		received_audio.play(); 
                	    		
                	    	}
                	    }
                	    break;    
                	
                	case "send_image":
                	    alert(obj.message);
                	    break;
                	case "settings":
                	    var inner_left_pannel = _("inner_left_pannel");
                	    inner_right_pannel.innerHTML = obj.message;
                	    break;        
                	case "save_settings":
                	    alert(obj.message);
                	    get_data({},"user_info");
                	    settings_user(true);
                	    break;
                	
                }
            }

    	}

    }
    function logout_user()
    {
    	
    	var answer = confirm("Are you sure want to Logout");
    	if (answer) {
    		get_data({},"logout");
    	}
    	

    }
    get_data({},"user_info");
    get_data({},"chats");

    var radio_chat = _("radio_chat");
    radio_chat.checked = true;
    function contacts_user(e)
    {
    	get_data({},"contacts");
    }
    function chats_user(e)
    {
    	get_data({},"chats");
    }
    function settings_user(e)
    {
    	get_data({},"settings");
    }
    function message_box_user(e)
    {
    	get_data({},"message_box");
    }
    function status_user(e)
    {
    	get_data({},"status");
    }
    function send_message(e)
    {
    	var message_text = _("message_text");
    	if (message_text.value.trim() == "") {
    		alert("please type somthing to send");

    	}else{
    	get_data({
    		message:message_text.value.trim(),
    		userid :CURRENT_CHAT_USER
    	},"send_message");
    }
  }
    function enter_pressed(e){
    	if (e.keyCode == 13) {
    		send_message(e);
    	}
    	SEEN_STATUS = true;
    }
    setInterval(function(){
    	var radio_chat = _("radio_chat");
    	var radio_contacts = _('radio_contacts');
    	SEEN_STATUS = true;
    	if (CURRENT_CHAT_USER != "" && radio_chat.checked) {
    		get_data({userid:CURRENT_CHAT_USER,
    			seen:SEEN_STATUS
    		},"chats_refresh");
    	}
    	if (radio_contacts.checked) {
    		get_data({},"contacts_refresh");
    	}
    },5000);
    function set_seen(e){
    	SEEN_STATUS = true;
    }
    function delete_message(e)
    {
    	if (confirm("Are you sure want to Delete message?")) {
    		var msgid = e.target.getAttribute("msgid");
    		get_data({
    			rowid:msgid

    		},"delete_message");
    		get_data({userid:CURRENT_CHAT_USER,
    			seen:SEEN_STATUS
    		},"chats_refresh");
    	}
    }
    function delete_threads(e)
    {
    	if (confirm("Are you sure want to Delete this Whole threads?")) {
    		get_data({
    			userid:CURRENT_CHAT_USER
                },"delete_threads");
    		get_data({userid:CURRENT_CHAT_USER,
    			seen:SEEN_STATUS
    		    },"chats_refresh");
    	}
    }

</script>
<script type="text/javascript">
	
  
  
  function collect_data(){
  	var  save_settings_button = _("save_settings_button");
  save_settings_button.addEventListener("click",collect_data);

    save_settings_button.disabled = true;
    save_settings_button.value = "Loading.. Please Wait.."
    

    var myform = _("myform");
    var inputs = myform.getElementsByTagName("input");

    var data = {};
    for (var i = inputs.length - 1; i >= 0; i--) {
      var key = inputs[i].name;
      switch(key){
        case "username":
            data.username = inputs[i].value;
            break;
        case "email":
            data.email = inputs[i].value;
            
            break;
        case "gender":
            if(inputs[i].checked){
              data.gender = inputs[i].value;
            }
            break;
        case "password":
            data.password = inputs[i].value;
            break;
        case "password2":
            data.password2 = inputs[i].value;
            break;
      }
    }
    send_data(data,"save_settings");
    

  }
  function send_data(data,type){
    var xml = new XMLHttpRequest();
    xml.onload = function(){
      if (xml.readyState == 4 || xml.status == 200) {
        handle_result(xml.responseText);
        var  save_settings_button = _("save_settings_button");
        save_settings_button.disabled = false;
            save_settings_button.value ="save Sattings ";
      }
    } 
    data.data_type = type;
    var data_string = JSON.stringify(data);
    xml.open("POST","api.php",true);
    xml.send(data_string);
    
  
  }
  function uploade_profile_image(files){
  	var filename = files[0].name;
  	var ext_start = filename.lastIndexOf(".");
  	var ext = filename.substr(ext_start + 1,3);
  	if(!(ext == "jpg" || ext == "JPG")){
  		alert("this file type is not allowed");
  		return;
  	}
  	var myfile = files[0].name;
  	var  change_image_button = _("change_image_button");
  	change_image_button.disabled = true;
    change_image_button.innerHTML ="Uploding.. Image ";

    var myform = new FormData();



  	var xml = new XMLHttpRequest();
    xml.onload = function(){
      if (xml.readyState == 4 || xml.status == 200) {
        xml.responseText;
        get_data({},"user_info");
        settings_user(true);
        
        change_image_button.disabled = false;
        change_image_button.innerHTML ="change Image ";
      }
    } 
    myform.append('file',files[0]);
    myform.append('data_type',"change_profile_image");
    xml.open("POST","uploder.php",true);
    xml.send(myform);
    
  }
  function handle_drag_and_drop(e){
  	if (e.type == "dragover") {
  		e.preventDefault();
  		e.target.className = "dragging";
  	}else if (e.type == "dragleave"){
        e.target.className = "";

  	}
  	else if (e.type == "drop"){
  		e.preventDefault();
  		e.target.className = "";
  		uploade_profile_image(e.dataTransfer.files);

  	}else{
  		//e.target.className = "";
  	}
  }
  function start_chat(e){
  	var userid = e.target.getAttribute("userid");
  	if (e.target.id == ""){
  		userid = e.target.parentNode.getAttribute("userid");
  	}
  	CURRENT_CHAT_USER = userid;
  	SEEN_STATUS = true;
  	var radio_message_box = _("radio_chat");
  	radio_message_box.checked = true;
  	get_data({userid:CURRENT_CHAT_USER,seen:SEEN_STATUS},"chats");
  }
  function view_status(e){
  	var userid = e.target.getAttribute("userid");
  	if (e.target.id == ""){
  		userid = e.target.parentNode.getAttribute("userid");
  	}
  	CURRENT_CHAT_USER = userid;
  	SEEN_STATUS = true;
  	var radio_status_box = _("radio_status_box");
  	radio_status_box.checked = true;
  	get_data({userid:CURRENT_CHAT_USER,seen:SEEN_STATUS},"status_box");
  }
  function send_image(files){
  	var filename = files[0].name;
  	var ext_start = filename.lastIndexOf(".");
  	var ext = filename.substr(ext_start + 1,3);
  	if(!(ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG")){
  		alert("this file type is not allowed");
  		return;
  	}
    var myform = new FormData();
  	var xml = new XMLHttpRequest();
    xml.onload = function(){
      if (xml.readyState == 4 || xml.status == 200) {
        handle_result(xml.responseText,"send_image");
        get_data({
        	userid:CURRENT_CHAT_USER,
        	seen:SEEN_STATUS
        },"chats_refresh");
        
      }
    } 
    myform.append('file',files[0]);
    myform.append('data_type',"send_image");
    myform.append('userid',CURRENT_CHAT_USER);
    xml.open("POST","uploder.php",true);
    xml.send(myform);
    

  }
  function close_image(e){
  	e.target.className = "image_off";

  }
  function image_show(e){
  	var image = e.target.src;
  	var image_viewer = _("image_viewer");
  	image_viewer.innerHTML = "<img src='"+image+"' style='width:100%;'>";
  	image_viewer.className = "image_on";
  }
  function uplode_status(files){
  	var filename = files[0].name;
  	var ext_start = filename.lastIndexOf(".");
  	var ext = filename.substr(ext_start + 1,3);
  	if(!(ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG")){
  		alert("this file type is not allowed");
  		return;
  	}
    var myform = new FormData();
  	var xml = new XMLHttpRequest();
    xml.onload = function(){
      if (xml.readyState == 4 || xml.status == 200) {
        handle_result(xml.responseText,"uplode_status");
        get_data({},"status_refresh");
        
      }
    } 
    myform.append('file',files[0]);
    myform.append('data_type',"uplode_status");
    xml.open("POST","uploder.php",true);
    xml.send(myform);
    

  }

</script>