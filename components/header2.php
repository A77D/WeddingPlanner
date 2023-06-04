<header class="header">

   <section class="flex">

      <a href="provider.php" class="logo">Provider<span>Panel</span></a>

      <nav class="navbar">
         <a href="provider.php">home</a>
         <a href="offers.php">offers</a>
         <a href="placed_orders.php?ll=ss">orders</a>
      </nav>
      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>
      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `providers` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profilep.php" class="btn">update profile</a>
         <a href="check_user.php" class="btn">switch to user</a>
         <a href="components/logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
      </div>
   </section>

</header>