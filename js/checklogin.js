$(document).ready(function(){
  $('#login-form').submit(function(e){
	console.log("JS entered");
    e.preventDefault();
	var username = $('input[name=username]').val();
	var pwd = $('input[name=password]').val();
	console.log(username);
	console.log(pwd);
    $.ajax({
      url: '/checklogin.php', //PHP file you want to access
      type: 'POST',
	  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
	  dataType: "json", //Tells AJAX to expect JSON data to be returned
      data: JSON.stringify({'username' : username, 'password' : pwd}), //The data to send. Needs to turned into JSON compatible data
      success: function(data) { //Data is the returned variable with echo.
		  var recv = data["code"]; //data["code"] is set in the PHP file with array('code' => -1) e.g.
		  if(recv === -1) {
			$('#errormsg').append("<p>Database error! Please consult administrator</p>");  
		  }
		  else if(recv === 0) {
			$('#errormsg').append("<p>Wrong username or password!</p>");  
		  }
		  else if(recv === 1) {
			window.location.replace("http://localhost:8080/start.php");
		  }
		  else{
			$('#errormsg').append("<p>Something went terribly wrong</p>");  
		  }
		  console.log(recv);
          $('#errormsg').append("<p>"+recv+"</p>");
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
  });
})