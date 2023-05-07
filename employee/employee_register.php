<?php

@include '../connection.php';

if(isset($_POST['submit'])){

   
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $gender = mysqli_real_escape_string($conn, $_POST['gender']);
   $dob = mysqli_real_escape_string($conn, $_POST['dob']);


   $pass = mysqli_real_escape_string($conn, $_POST['password']);
   $cpass = mysqli_real_escape_string($conn,$_POST['cpassword']);

   $select = " SELECT * FROM 'emp_reg' WHERE name='$name' && email = '$email' && gender='$gender' && dob='$dob' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO emp_reg(name, email, gender, dob, password) VALUES('$name','$email','$gender','$dob','$pass')";
         mysqli_query($conn, $insert);
         header('location:../index.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">

<head>

   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>employee_register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../resorce/css/styling.css">
  
   
   

</head>
<body>
   




   
<div class="form-container">



   <form action="" method="post">
      <h3>Employee registration</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="text" name="gender" required placeholder="Gender">
      <input type="date" name="dob" required placeholder="enter your dob">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already registered?<a href="../index.php">login now</a></p>
   </form>
   


</div>

</body>
</html>