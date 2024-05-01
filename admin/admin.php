
<?php
$is_invalid = false;
if($_SERVER["REQUEST_METHOD"] === "POST"){
  $mysqli = require __DIR__ ."/admindb.php";
  $sql = sprintf("SELECT * FROM admin 
                  WHERE username = '%s' ",
                  $mysqli->real_escape_string($_POST['username']));
  $result = $mysqli->query($sql);
  $admin = $result->fetch_assoc();
if($admin){
  if($_POST['password'] == $admin['password']){
    session_start();
    session_regenerate_id();
   
    $_SESSION['admin_id'] = $admin['id'];

    

    header('location: adminportal.php');
   


    exit;
  }
}
$is_invalid = true;

}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Travelog</title>
  <link rel="icon" href="./Images/icon.png" sizes="46x46" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="admin.css" type="text/css" />
  <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
  <script src="./js/validation.js" defer></script>

</head>

<body>
  
  <section>
    <div class="hero-section">
      <div class="hero-message">
        <h2>Stay Curious.</h2>
        <div class="message">
          <span>
            <p>
              Create your own travel diary to capture and share your travel
              experiences!
            </p>
          </span>
        </div>

      </div>


    </div>
  </section>

  <div class="blur-background"></div>
  <div class="form-popup">
    <div class="login e-none">
     
      <div class="travelog-logo"></div>
     
      <div class="form-cotainer">
      <?php if($is_invalid) :?>
        <em style="color: red";>Invalid login</em>
      <?php endif ;?>  
      

        <form id="form-register" method="POST" novalidate>

          <div class="email">
            <label for="username"> Adminname </label>
          </div>
          <span>
            <div class="email-container">
              <input type="text" id="username" name="username"  placeholder="Adminname" spellcheck="false" value="<?= htmlspecialchars($_POST["username"] ?? "") ?>">

            </div>
          </span>
          <br />

          <div class="password">
            <label for="password"> Password </label>
          </div>
          <span>
            <div class="pass-container">
              <input class="password-input" type="password" id="password" name="password" autocomplete="list" placeholder="Password" spellcheck="false" />
              <span class="eye" onclick="passwordVisibile()">
                <i id="icon1" class="fa-solid fa-eye"></i>
                <i id="icon2" class="fa-solid fa-eye-slash"></i>
              </span>
            </div>
          </span>

          <div class="submit-button">
            
            <input type="submit" class="btn btn-primary" name="submit" value="Log in" />
          </div>

          
        </form>
      </div>
    </div>

  


 

  <script>
    

    //Password Visible function
    const passwordVisibile = () => {
      const x = document.getElementById("password");
      const visible = document.getElementById("icon1");
      const hide = document.getElementById("icon2");

      if (x.type === "password") {
        x.type = "text";
        visible.style.display = "block";
        hide.style.display = "none";
      } else {
        x.type = "password";
        visible.style.display = "none";
        hide.style.display = "block";
      }
    };

    
  
  </script>
</body>

</html>


