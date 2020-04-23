<?php 
include "inc/header.php";
include "lib/user.php";
session::checkLogin();
?> 
<?php 
$user = new user();

 if(isset($_POST['login'])){
    $logindata = $user->userLogin($_POST);
   
 }

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>User Login </h2>

    </div>
    <div class="panel-body">
    <div style="max-width:700px; margin: 0 auto;">
<?php  

if(isset($logindata)){
    echo $logindata;
}


?>
    <form action="" method="post">
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="text" name="email" id="email" class="form-control">
             <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <button type="submit" name="login" class="btn btn-success">Login</button>
    </form>

    </div>
    
    </div>

</div>
<?php 

include "inc/footer.php";
?>