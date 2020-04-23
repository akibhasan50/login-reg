<?php 
include "inc/header.php";
include "lib/user.php";
session::checkSession();
?>
<?php 
 if(isset($_GET['id'])){
        $userid =(int)$_GET['id'];
    }
 $user = new user();
?>


<div class="panel panel-default">
    <div class="panel-heading">
        <h2>User Profile <span class="pull-right"><a class="btn btn-primary" href="index.php">Back</a></span> </h2>
    </div>
    <div class="panel-body">
    <div style="max-width:700px; margin: 0 auto;">

<?php 

        if(isset($_POST['update'])){
            $userUpdate = $user->userDataUpdate($userid,$_POST);
        
            if(isset( $userUpdate )){
                echo  $userUpdate;
            }
        }

?>
<?php 

    $userdata = $user->getDatabyId($userid);
    if($userdata ){
?>
    <form action="" method="post">

        <div class="form-group">
            <label for="name">First Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo $userdata->name;?>">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" value="<?php echo $userdata->username;?>" >
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="text" name="email" id="email" class="form-control" value="<?php echo $userdata->email;?>">
        </div>
    <?php 
    $sesid = session::get("id");
    if($userid == $sesid ){

    ?>
        <button type="submit" name="update" class="btn btn-success">update</button>
         <a class="btn btn-primary" href="changpass.php?id=<?php echo $userid?>">change password</a>
    <?php } ;?>  
    </form>
    <?php } ;?>  
    </div>
    
    </div>

</div>
<?php 

include "inc/footer.php";
?>