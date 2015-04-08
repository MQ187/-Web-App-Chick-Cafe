<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Istockphp.com</title>
<link rel='stylesheet' href='fancyapps-fancyBox-18d1712/source/jquery.fancybox.css' type='text/css' media='all' />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type='text/javascript' src='fancyapps-fancyBox-18d1712/source/jquery.fancybox.pack.js'></script>
<script type="text/javascript" src="js/script.js"></script>
 
</head>
<body>
    <a href="javascript:void(0)" class="topopup">Click to Popup the Form</a>
    <div style="display:none">
        <div id="popup_content">
        <form action="" id="commentform">
            <table>
                <tr>
                    <td>Name:</td>
                    <td><input id="name" name="name" type="text" value=""></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input id="email" name="email" type="text" value=""></td>
                </tr>
                <tr>
                    <td valign="top">Comment:</td>
                    <td><textarea id="comment" name="comment" cols="32" rows="4"></textarea></td>
                </tr>
            </table>
            <input id="submitform" name="submit" type="button" value="Submit">
            <span id="process" style="display:none">Processing...</span>
        </form>
        </div>
    </div>
</body>
</html>
<script>
jQuery(function($) {
     
    $("a.topopup").click(function() {
         
        $.fancybox.showLoading();  // show loading
        // $.fancybox.hideActivity(); // remove loading
        setTimeout(function(){ // then show popup, deley in .5 second
            $.fancybox({
                    'transitionIn' : 'fade',
                    'transitionOut' : 'fade',
                    'overlayColor' : '#000',
                    'overlayOpacity' : '.6',
                    'href' : '#popup_content',
                    'onCleanup' : function() {
                                    // close event
                                  }
                });    
        }, 500); // .5 second
 
    }); // popup click end
     
    $("#submitform").click(function() {
         
        var name             = $("#name").val();
        var email             = $("#email").val();
        var email_regex     = /^[\w%_\-.\d]+@[\w.\-]+.[A-Za-z]{2,6}$/; // reg ex email check
        var comment         = $("#comment").val();
         
        // basic validation
        if(name == "") {
            alert("Name field is blank.");
            return false;
        }
        if(email == "") {
            alert("Email field is blank.");
            return false;
        }
        if(!email_regex.test(email)){ // if invalid email
            alert("Invalid email.");
            return false;
        }
        if(comment == "") {
            alert("Comment is blank.");
            return false;
        }
         
        var datastring = $("#commentform").serialize(); // get field value in form
         
        $("#process").show();
         
        $.ajax({
                type: "POST", // type
                url: "post.php", // request file
                data: datastring, // post data
                success: function(responseText) { // get the response
                    if(responseText) {
                        alert('Succesfully insert.');
 
                        // clear form after submit
                $("#name").val('');
            $("#email").val('');
            $("#comment").val('');
 
                        $("#process").hide();    
                        $.fancybox.close(); // close popup    
                    }
                } // end success
        });
         
    }); // click end
     
}); // jQuery End
</script>