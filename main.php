<?php 
  require 'partials/dbconnect.php';
  session_start();
  if(!isset($_SESSION['public_key'])){
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
          <i class="fas fa-ellipsis-h dots" id="btn"></i>
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
  <div class="modal">
        <div class="btn-box">
            <button class="edit"><a href="editprofile.php"> Edit Profile</a> </button>
            <button class="log_out"><a href="partials/logout.php">logout</a></button>
            <button id="close" class="block">close</button>
           
        </div>
    </div>
  <script>
    let usersList = document.querySelector(".users-list");
    setInterval(() => {
      let xhr = new XMLHttpRequest();
      xhr.open("GET", "partials/main.php", true);
      xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {

            let data = xhr.response;
            console.log(data)
            if (data) {
              usersList.innerHTML = data;
            }
          }
        }
      }
      xhr.send();
    }, 500);
    let togglebtn = document.getElementById("btn");
    let closebtn = document.getElementById("close");
console.log(togglebtn);
let modal = document.querySelector(".modal");
togglebtn.addEventListener("click", function () {
  modal.classList.add("modal-active");
});
closebtn.addEventListener("click", function () {
  modal.classList.remove("modal-active");
});
  </script>
  <script src="js/chat.js"></script>
</body>

</html>