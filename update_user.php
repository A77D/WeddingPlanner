<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $phone = $_POST['phone'];
   $phone = filter_var($phone, FILTER_SANITIZE_STRING);

   $city = $_POST['city'];
   $city = filter_var($city, FILTER_SANITIZE_STRING);

   $street = $_POST['street'];
   $street = filter_var($street, FILTER_SANITIZE_STRING);
   

   $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ?, phone = ?, city = ?, street = ? WHERE id = ?");
   $update_profile->execute([$name, $email,$phone, $city, $street, $user_id]);
   $empty_pass = '';
   $prev_pass = $_POST['prev_pass'];
   $old_pass = $_POST['old_pass'];
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = $_POST['new_pass'];
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $cpass = $_POST['cpass'];
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   if($old_pass == $empty_pass){
      $message[] = 'please enter old password!';
   }elseif($old_pass != $prev_pass){
      $message[] = 'old password not matched!';
   }elseif($new_pass != $cpass){
      $message[] = 'confirm password not matched!';
   }else{
      if($new_pass != $empty_pass){
         $update_admin_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
         $update_admin_pass->execute([$cpass, $user_id]);
         $message[] = 'information updated successfully!';
      }else{
         $message[] = 'information updated successfully!';
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
   <title>update your profile</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="style/style2.css">

</head>
<body>
   
<?php include 'components/header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>update now</h3>
      <input type="hidden" name="prev_pass" value="<?= $fetch_profile["password"]; ?>">
      <input type="text" name="name" required placeholder="enter your username" maxlength="20"  class="box" value="<?= $fetch_profile["name"]; ?>">
      <input type="email" name="email" required placeholder="enter your email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile["email"]; ?>">
      <input type="number" name="phone" value="<?= $fetch_profile['phone']; ?>" required placeholder="enter your phone number" maxlength="20"  class="box">
      <input type="text" name="city" value="<?= $fetch_profile['city']; ?>" required placeholder="enter your city" maxlength="20"  class="box">
      <input type="text" name="street" value="<?= $fetch_profile['street']; ?>" required placeholder="enter your location" maxlength="40"  class="box">
      <input type="password" name="old_pass" placeholder="enter your password to confirm identity" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
            title="Must contain at least one number and one uppercase and lowercase letter, 
            and at least 8 or more characters"   placeholder="enter your new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" placeholder="confirm your new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="update now" class="btn" name="submit">
   </form>
</section>


<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="js/script1.js"></script>

</body>
</html>