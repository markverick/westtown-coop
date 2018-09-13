<?php require 'php_scripts/google_signin_header.php'; ?>
<h5 class="card-title" id="message">Sign in to continue</h5>
<div style="display: inline-block" class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
<div id="logout" style="display: none;" onclick="logout()">
  <div style="height:36px;width:120px;background-color: #c82333;" class="abcRioButton abcRioButtonBlue"><div class="abcRioButtonContentWrapper"><span id="logouttxt" style="font-size:13px;line-height:34px;" class="abcRioButtonContents">Sign out</span></div></div>

</div>
<!-- <a class="black" id="logout" href="#logout" onclick="logout()" style="display: none;"></a> -->
<hr>
<p id="email" style="display: none;"></p>
<div class="row">
  <div id="content" class="col-lg-6 col-xl-6 col-md-6 col-sm-6">
    
  </div>
  <div id="perm" class="col-lg-6 col-xl-6 col-md-6 col-sm-6">
    
  </div>
</div>
<div id="table">
 
</div>
<script>
//Sign in module
var id_token,profile;
function onSignIn(googleUser) {
  // Useful data for your client-side scripts:
  profile = googleUser.getBasicProfile();
  // console.log("ID: " + profile.getId()); // Don't send this directly to your server!
  // console.log('Full Name: ' + profile.getName());
  // console.log('Given Name: ' + profile.getGivenName());
  // console.log('Family Name: ' + profile.getFamilyName());
  // console.log("Image URL: " + profile.getImageUrl());
  // console.log("Email: " + profile.getEmail());

  // The ID token you need to pass to your backend:
  id_token = googleUser.getAuthResponse().id_token;

  // console.log("ID Token: " + id_token);
  var x = document.getElementsByClassName("name");
  var i;
  for (i = 0; i < x.length; i++) {
    x[i].innerHTML = profile.getGivenName();
  } 
  // document.getElementById("email").innerHTML = profile.getEmail();
  document.getElementById("logouttxt").innerHTML = "Sign out";
  document.getElementById("logout").style.display="inline-block";
  document.getElementById("email").innerHTML = profile.getEmail();
  var email=document.getElementById("email").innerHTML;
  console.log(email);
  console.log("<?php echo $_GET['user']; ?>");
  // if(document.getElementById("page").innerHTML=="Profile"&&"<?php echo $_GET['user']; ?>"=="")
  // {
  //   console.log("aa");
  //   document.location = "<?php echo "profile.php?user="; ?>"+email;
  // }
  x = document.getElementsByClassName("profilePic");
  var i;
  for (i = 0; i < x.length; i++) {
    x[i].src = profile.getImageUrl();
  }
  $.ajax({
     type: 'POST',
     url: 'php_scripts/auth.php',
     data: { email: profile.getEmail() },
     success: function(data){
        // alert("Rank = " + data);
        if(data=="10")
        {
          document.getElementById("message").innerHTML = "Welcome admin " + profile.getGivenName() + " !";
          $("#content").load("php_scripts/panel.php");
          $("#perm").load("php_scripts/panelperm.php");
          $("#table").load("php_scripts/table.php");
        }
        else if(data=="9")
        {
          document.getElementById("message").innerHTML = "Welcome moderator " + profile.getGivenName() + " !";
          $("#content").load("php_scripts/panel.php");
          $("#table").load("php_scripts/table.php");
        }
        else
        {
          document.getElementById("message").innerHTML = "Welcome user " + profile.getGivenName() + " !";
          $("#content").load("php_scripts/denied.php");
        }
     },
     error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert(XMLHttpRequest);
        alert(textStatus);
        alert(errorThrown );
     }
   });
};
//Sign out
function logout() {
  document.location.href = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue="+location.href;
  document.getElementByID("logout").style.display="none";
}
</script>