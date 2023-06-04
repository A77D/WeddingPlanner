<?php

include 'components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

   $select_admin = $conn->prepare("SELECT * FROM `users` WHERE admin_id = ?");
   $select_admin->execute([$admin_id]);
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);
   if($select_admin->rowCount() > 0){
   $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
}
else {
   $message[] = $fetch_profile['admin_id'];
}                    
?>