<!DOCTYPE html>
<html lang="en">

<?php require 'navbar.php'; ?>

<body>



<div class="container">
		<div id="login_form">
		<div class="" id="onload_animation">
			<br/>
				<form action="login.php" name="login" id="login" method="post">
					<div class="form-group">
						<label>Email</label>
						<input type="text" class="form-control" id="email" placeholder="Enter Email" name="email">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" id="pass" placeholder="Enter Password" name="pass">
					</div>


                    <div class="form-group">
                        <label>Login Role</label>
                        <select class="form-control" name="role">
                            <option value="admin">Admin</option>
                            <option value="company">Company</option>

                      </select>
                    </div>
					<button type="submit" class="btn btn-success">Login</button>	
				</form>		
		</div>		
		</div> 
	</div>
</body>



<script>
		
var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);

$(document).ready(function() {
	
	if(isChrome == true)
	{
	   document.getElementById("onload_animation").className = "animsition";
	}
   
    $(".animsition").animsition({
    inClass: 'flip-in-y',
    outClass: 'flip-out-y',
    inDuration: 1500,
    outDuration: 800,
    linkElement: '.animsition-link',
    // e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
    loading: true,
    loadingParentElement: 'body', //animsition wrapper element
    loadingClass: 'animsition-loading',
    loadingInner: '', // e.g '<img src="loading.svg" />'
    timeout: false,
    timeoutCountdown: 5000,
    onLoadEvent: true,
    browser: [ 'animation-duration', '-webkit-animation-duration'],
    // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
    // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
    overlay : false,
    overlayClass : 'animsition-overlay-slide',
    overlayParentElement : 'body',
    transition: function(url){ window.location.href = url; }
  });
});



$('#login').submit(function(e)
{
    $.Event(e).preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
        dataType: 'JSON',
    }).done(function(data)
    {        
     	if (data.status == 'error')
        {
            new Noty({          
                type: data.status,
                text: data.msg,            
                timeout: 2000
            }).show();
        }
        else
        {
            new Noty({          
                type: data.status,
                text: data.msg,            
                timeout: 2000
            }).show();

            setTimeout(function()
            {
                if(data.role == "company")
                {
                    window.location = "users.php";
                }else
                {
                    window.location = "companies.php";
                }

                
            }, 1000);
        }      
       
    })
});








</script>



</html>
