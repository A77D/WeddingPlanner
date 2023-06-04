<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>
<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">Wedding<span>Planner</span></a>

      <nav class="navbar">
         <a href="home.php">home</a>
         <a href="about.php">about</a>
         <a href="main.php">main</a>
         <a href="our_offers.php">offers</a>
         <a href="orders.php">orders</a>
      </nav>
      <div class="icons">
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `plan` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="contact.php"><i class="fas fa-comments"></i></a>
         <a href="plan.php"><i class="fas fa-list-alt"></i><span>(<?= $total_cart_counts; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
         
      </div>

      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile["name"]; ?></p>
         <a href="update_user.php" class="btn">update profile</a>
         <a href="promote.php" class="btn">Promote your business</a>
         <a href="components/logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
         <?php
            }else{
         ?>
         <p>plan your wedding right now!</p>
         <a href="signup.php" class="btn">Join Us</a>
         <?php
            }
         ?>         
      </div>
   </section>
</header>