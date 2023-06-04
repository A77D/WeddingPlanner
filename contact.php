<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['send'])){

   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);


      $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, message) VALUES(?,?)");
      $insert_message->execute([$user_id, $msg]);

      $message[] = 'message sent successfully!';

   }


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="style/style2.css">

</head>
<body>
   
<?php include 'components/header.php'; ?>

<section class="contact">

   <form action="" method="post">
      <h3>get in touch</h3>
      
      <textarea name="msg" class="box" placeholder="enter your message" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" class="btn">
   </form>

</section>
<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="js/script1.js"></script>

</body>
</html>