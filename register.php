<?php 
include "inc/header.php";
include "lib/user.php";
?> 
<?php 
$user = new user();

 if(isset($_POST['register'])){
    $userReg = $user->userRegistr($_POST);
   
 }

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>User Registration </h2>

    </div>
    <div class="panel-body">
    <div style="max-width:700px; margin: 0 auto;">
    <form action="" method="post">
<?php 
 if(isset($userReg )){
        echo $userReg;
    }

?>
        <div class="form-group">
            <label for="name">First Name</label>
            <input type="text" name="name" id="name" class="form-control" >
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" >
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="text" name="email" id="email" class="form-control"  >
        </div>
         <div class="form-group">   
             <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <button type="submit" name="register" class="btn btn-success">submit</button>
    </form>

    </div>
    
    </div>

</div>
<?php 

include "inc/footer.php";
?>