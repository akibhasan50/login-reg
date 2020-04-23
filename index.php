<?php 
include "inc/header.php";
include "lib/user.php";
session::checkSession();
$user = new user();

?>
<?php 

$loginMsg=session::get('loginMsg');
if(isset($loginMsg)){
    echo $loginMsg;
}
session::set('loginMsg',NULL);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>User List <span class="pull-right">
        Welcome!!
        <strong>
         <?php 
           $name = session::get('name');
           if(isset($name)){
               echo $name;
           }
           ?> 
        
        </strong>
          
         </span></h2>
      
    </div>
    <div class="panel-body">
    <table class="table table-striped">
        <tr>
            <th width="20%">Serial</th>
            <th width="20%">Name</th>
            <th width="20%">Username</th>
            <th width="20%">Email Address</th>
            <th width="20%">Action</th>
        </tr>
 <?php 
  $alluserdata = $user->showUserdata();
  $i=0;
   if($alluserdata) {
    foreach ($alluserdata as $value) {
      $i++;
 ?> 
        <tr>
            <td><?php echo $i ;?></td>
            <td><?php echo $value['name']?></td>
            <td><?php echo $value['username']?></td>
            <td><?php echo $value['email']?></td>
            <td>
                <a class="btn btn-primary" href="profile.php?id=<?php echo $value['id']?>">View</a>
            </td>
<?php   }};?>
        </tr>
    </table>

    </div>

</div>
<?php 

include "inc/footer.php";
?>