<?php

include 'components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $phone = $_POST['phone'];
   $phone = filter_var($phone, FILTER_SANITIZE_STRING);

   $city = $_POST['city'];
   $city = filter_var($city, FILTER_SANITIZE_STRING);

   $street = $_POST['street'];
   $street = filter_var($street, FILTER_SANITIZE_STRING);

   $bio = $_POST['bio'];
   $bio = filter_var($bio, FILTER_SANITIZE_STRING);

   $select_profil = $conn->prepare("SELECT * FROM `providers` WHERE id = ?");
   $select_profil->execute([$admin_id]);
   $fetch_profil = $select_profil->fetch(PDO::FETCH_ASSOC);

   $empty_pass = '';
   $prev_pass = $fetch_profil['password'];
   $old_pass = $_POST['old_pass'];
   $new_pass = $_POST['new_pass'];
   $confirm_pass = $_POST['confirm_pass'];

   if($old_pass == $empty_pass){
      echo '<script>alert("please enter old password")</script>';
   }elseif($old_pass != $prev_pass){
      echo '<script>alert("old password not matched")</script>';
   }elseif($new_pass != $confirm_pass){
      echo '<script>alert("confirm password not matched")</script>';
   }else{
      if($new_pass != $empty_pass){
         $update_admin_pass = $conn->prepare("UPDATE `providers` SET name = ?, phone = ?, city = ?, street = ?, bio = ?, password = ? WHERE id = ?");
         $update_admin_pass->execute([$name,$phone,$city,$street,$bio,$confirm_pass, $admin_id]);
         $message[] = 'Your information has been updated!';
      }else{
         $update_admin_info = $conn->prepare("UPDATE `providers` SET name = ?, phone = ?, city = ?, street = ?, bio = ? WHERE id = ?");
         $update_admin_info->execute([$name,$phone,$city,$street,$bio, $admin_id]);
         $message[] = 'Your information has been updated!';
            }
      }  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="style/style3.css">

</head>
<body>
<?php include 'components/header2.php'; ?>


<section class="form-container">

   <form action="" method="post">
      <h3>update profile</h3>
      <input type="text" name="name" value="<?= $fetch_profile['name']; ?>" required placeholder="enter your username" maxlength="20"  class="box">
      <input type="number" name="phone" value="<?= $fetch_profile['phone']; ?>" required placeholder="enter your phone number" maxlength="20"  class="box">
      <input type="text" name="city" value="<?= $fetch_profile['city']; ?>" required placeholder="enter your city" maxlength="20"  class="box">
      <input type="text" name="street" value="<?= $fetch_profile['street']; ?>" required placeholder="enter your location" maxlength="40"  class="box">
      <input type="text" name="bio" value="<?= $fetch_profile['bio']; ?>" required placeholder="enter your bio" maxlength="60"  class="box">
      <input type="password" name="old_pass" placeholder="enter old password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
            title="Must contain at least one number and one uppercase and lowercase letter, 
            and at least 8 or more characters"  placeholder="enter new password" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="confirm_pass" placeholder="confirm new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="update now" class="btn" name="submit">
   </form>

</section>   

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="js/script1.js"></script>
</body>
</html>