<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:messages.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../style/style3.css">

</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="contacts">

<h1 class="heading">messages</h1>

<div class="box-container">

   <?php
      $select_messages = $conn->prepare("SELECT * FROM `messages`");
      $select_messages->execute();
      if($select_messages->rowCount() > 0){
         while($fetch_message = $select_messages->fetch(PDO::FETCH_ASSOC)){
            $user_id =  $fetch_message['user_id'];

            $select_users = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_users->execute([$user_id]);
            if($select_users->rowCount() > 0){
               while($fetch_user = $select_users->fetch(PDO::FETCH_ASSOC)){
            
   ?>
   <div class="box">
   <p> user id : <span><?= $fetch_message['user_id']; ?></span></p>
   <p> name : <span><?= $fetch_user['name']; ?></span></p>
   <p> email : <span><?= $fetch_user['email']; ?></span></p>
   <p> number : <span><?= $fetch_user['phone']; ?></span></p>
   <p> message : <span><?= $fetch_message['message']; ?></span></p>
   <a href="messages.php??delete=<?= $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete</a>
   </div>
   <?php
      }
      }
      }
      }else{
         echo '<p class="empty">you have no messages</p>';
      }
   ?>

</div>

</section>
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="admin_script.js"></script>

</body>
</html>