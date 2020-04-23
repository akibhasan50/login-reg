<?php 
include "inc/header.php";
include "lib/user.php";
session::checkSession();
?>
<?php 
//$userid = 0;
$user = new user();
if(isset($_GET['id'])){
    $userid = (int)$_GET['id'];
    
}
$sesid = session::get("id");
    if($userid != $sesid ){
        header("Location: index.php");
    }
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>Change Password <span class="pull-right"><a class="btn btn-primary" href="profile.php?id=<?php echo $userid;?>">Back</a></span> </h2>
    </div>
    <div class="panel-body">
    <div style="max-width:700px; margin: 0 auto;">
<?php 
if(isset($_POST['updatepass'])){
   $updatePass = $user->updateUserPass($userid,$_POST);

   if($_SERVER['REQUEST_METHOD']=='POST' && isset( $updatePass)){
       echo  $updatePass;
   }
}


?>
    <form action="" method="POST">

        <div class="form-group">
            <label for="old_password">Old Password</label>
            <input type="password" name="old_password" id="old_password" class="form-control">
        </div>
        <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" name="new_password" id="new_password" class="form-control">
        </div>
       

        <button type="submit" name="updatepass" class="btn btn-success">update</button>
       
      
    </form>

    </div>
    
    </div>

</div>
<?php 

include "inc/footer.php";
?>