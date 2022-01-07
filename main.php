<?php 
  require 'partials/dbconnect.php';
  session_start();
  if(!isset($_SESSION['public_key']) && $_SESSION['loggedin'] !=true){
    header("location: login.php");
  }
  $query =  "SELECT * FROM users WHERE public_key = {$_SESSION['public_key']}";
  $sql = mysqli_query($conn,$query);
  if(mysqli_num_rows($sql) > 0){
    $row = mysqli_fetch_assoc($sql);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DashBoard:
    <?php echo $row['username'] ?>
  </title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>

<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
        <img src="images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span>
              <?php echo $row['username'] ?>
            </span>
          </div>
        </div>
        <div class="more">
        <i class="fas fa-cog dots" id="btnm"></i>
        </div>
        <div class="modal">
              <div class="btnm">
              <a href="partials/editprofile.php"> Edit Profile</a>
              </div>
              <div class="btnm">
                <a href="partials/logout.php">Logout</a> 
              </div>
          </div>
      </header>
      <div class="search">
        <!-- <span class="text">Select an user to start chat</span> -->
        <input type="text" placeholder="Enter name to search...">
        <!-- <button><i class="fas fa-search"></i></button> -->
      </div>
      <div class="users-list">

      </div>
    </section>
  </div>
 <script src="js/main.js"></script>
</body>
</html>