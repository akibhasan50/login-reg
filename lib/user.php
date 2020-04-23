<?php 
 include_once "session.php";
 include "database.php";
class user{
     public $db;
     public function __construct(){
        $this->db = new Database();
     }


     public function userRegistr($data){
        $name     =$data['name'];
        $username =$data['username'];
        $email    =$data['email'];
        $password =$data['password'];
        $chk_email =$this->emailCheck($email); 

        if($name == "" || $username == "" || $email == "" || $password == ""){
            $msg="<div class= 'alert alert-danger'><strong>ERROR!!!!</strong>Field must not be empty</div>";
            return $msg;
        }
        if(strlen($username)<3){
            $msg="<div class= 'alert alert-danger'><strong>ERROR!!!!</strong>Username is too short </div>";
            return $msg;
        }elseif(preg_match('/^[a-zA-Z][0-9_-]*$/i', $username)){
            $msg="<div class= 'alert alert-danger'><strong>ERROR!!!!</strong>Username only contain alphanumeric char</div>";
            return $msg;
        }
        if(filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE){
            $msg="<div class= 'alert alert-danger'><strong>ERROR!!!!</strong>Email not valid</div>";
            return $msg;
        }
        if($chk_email == true){
            $msg="<div class= 'alert alert-danger'><strong>ERROR!!!!</strong>Email already exist</div>";
            return $msg;
        }
        if(strlen($password)<6){
            $msg="<div class= 'alert alert-danger'><strong>ERROR!!!!</strong>password should grater than 6 digit  </div>";
            return $msg;
        }

        $sql="INSERT INTO tbl_user(name,username,email,password) VALUES(:name,:username,:email,:password)";
         $result=$this->db->conn->prepare($sql);
         $result->bindValue(':name',$name);
         $result->bindValue(':username',$username);
         $result->bindValue(':email',$email);
         $result->bindValue(':password',$password);
         $value= $result->execute();

         if($value){
             $msg="<div class= 'alert alert-success'><strong>Welcome!!!!</strong>You are register successfully  </div>";
            return $msg;
         }else{
              $msg="<div class= 'alert alert-danger'><strong>ERROR!!!!</strong>There is a problem in registration </div>";
            return $msg;
         }
        
     }
     public function emailCheck($email){
         $sql="SELECT email FROM tbl_user WHERE email=:email";
         $result=$this->db->conn->prepare($sql);
         $result->bindValue(':email',$email);
         $result->execute();
 
         if($result->rowCount() > 0){
             return true;
         }else{
             return false;
         }


     }
     public function getLoginData($email,$password){
         $sql="SELECT * FROM tbl_user WHERE email=:email AND password=:password LIMIT 1";
         $result=$this->db->conn->prepare($sql);
         $result->bindValue(':email',$email);
         $result->bindValue(':password',$password);
         $result->execute();
         $value=  $result->fetch(PDO::FETCH_OBJ);
         return $value;
 


     }
     public function userLogin($data){
        $email    =$data['email'];
        $password =$data['password'];
        $chk_email =$this->emailCheck($email); 

        if( $email == "" || $password == ""){
            $msg="<div class= 'alert alert-danger'><strong>ERROR!!!!</strong>Field must not be empty</div>";
            return $msg;
        }
        if($chk_email == false){
            $msg="<div class= 'alert alert-danger'><strong>ERROR!!!!</strong>Email dont  exist</div>";
            return $msg;
        }

        $result =$this->getLoginData($email,$password);

        if($result){
            session::init();
            session::set("login",true);
            session::set("id",$result->id);
            session::set("name",$result->name);
            session::set("username",$result->username);
            session::set("loginMsg","<div class= 'alert alert-success'><strong>success!!!!</strong>You are logged in</div>");

            header("Location:index.php");
        }else{
            $msg="<div class= 'alert alert-danger'><strong>ERROR!!!!</strong>login failed</div>";
            return $msg;
        }
     }

     public function showUserdata(){
        $sql="SELECT * FROM tbl_user ORDER BY id DESC";
         $result=$this->db->conn->prepare($sql);
         $result->execute();
         $value=  $result->fetchAll();
         return $value;
     }

      public function getDatabyId($id){
         $sql="SELECT * FROM tbl_user WHERE id=:id";
         $result=$this->db->conn->prepare($sql);
         $result->bindValue(':id',$id);
        
         $result->execute();
         $value=  $result->fetch(PDO::FETCH_OBJ);
         return $value;
      }

      public function userDataUpdate($id,$data){
        $name     =$data['name'];
        $username =$data['username'];
        $email    =$data['email'];
       
        $chk_email =$this->emailCheck($email); 

        if($name == "" || $username == "" || $email == ""){
            $msg="<div class= 'alert alert-danger'><strong>ERROR!!!!</strong>Field must not be empty</div>";
            return $msg;
        }
        if(strlen($username)<3){
            $msg="<div class= 'alert alert-danger'><strong>ERROR!!!!</strong>Username is too short </div>";
            return $msg;
        }elseif(preg_match('/^[a-zA-Z][0-9_-]*$/i', $username)){
            $msg="<div class= 'alert alert-danger'><strong>ERROR!!!!</strong>Username only contain alphanumeric char</div>";
            return $msg;
        }
        if(filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE){
            $msg="<div class= 'alert alert-danger'><strong>ERROR!!!!</strong>Email not valid</div>";
            return $msg;
        }
        
       

        $sql="UPDATE tbl_user SET name=:name,username=:username,email=:email WHERE id=:id";
         $result=$this->db->conn->prepare($sql);
         $result->bindValue(':name',$name);
         $result->bindValue(':username',$username);
         $result->bindValue(':email',$email);
         $result->bindValue(':id',$id);
         $value= $result->execute();

         if($value){
             $msg="<div class= 'alert alert-success'><strong>Welcome!!!!</strong>Data updated successfully  </div>";
            return $msg;
         }else{
              $msg="<div class= 'alert alert-danger'><strong>ERROR!!!!</strong>There is a problem in updating data </div>";
            return $msg;
         }
      }
     public function checkPassExist($id,$oldpass){
        
        $sql="SELECT password FROM tbl_user WHERE id=:id AND password=:password";
         $result=$this->db->conn->prepare($sql);
         $result->bindValue(':id',$id);
         $result->bindValue(':password',$oldpass);
         $result->execute();
         if($result->rowCount() > 0){
             return true;
         }else{
             return false;
         }
     }
     
      public function updateUserPass($id,$data){
          $oldpass=$data['old_password'];
          $newpass=$data['new_password'];

          if($oldpass == "" || $newpass == "" ){
            $msg="<div class= 'alert alert-danger'><strong>ERROR!!!!</strong>Field must not be empty</div>";
            return $msg;
        }
        if(strlen($newpass)<6){
            $msg="<div class= 'alert alert-danger'><strong>ERROR!!!!</strong>password should grater than 6 digit  </div>";
            return $msg;
        }
        $checkPass = $this->checkPassExist($id,$oldpass);

        if( $checkPass == false){
             $msg="<div class= 'alert alert-danger'><strong>ERROR!!!!</strong>old password not valid</div>";
            return $msg;
        }


         $sql="UPDATE tbl_user SET password=:password WHERE id=:id";
         $result=$this->db->conn->prepare($sql);
         
         $result->bindValue(':password',$newpass);
         $result->bindValue(':id',$id);
         $value= $result->execute();

         if($value){
             $msg="<div class= 'alert alert-success'><strong>Welcome!!!!</strong>password updated successfully  </div>";
            return $msg;
         }else{
              $msg="<div class= 'alert alert-danger'><strong>ERROR!!!!</strong>There is a problem in updating password </div>";
            return $msg;
         }
      }

}




?>