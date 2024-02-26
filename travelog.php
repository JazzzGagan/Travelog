<?php
$is_invalid = false;
if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $mysqli = require __DIR__ . "/dbconnect.php";

  $sql = sprintf(
    "SELECT * FROM users
                where email = '%s'",
    $mysqli->real_escape_string(
      $_POST["email"]
    )
  );

  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();

  if ($user) {
    if (password_verify($_POST["password"], $user["password_hash"])) {

      session_start();
      session_regenerate_id();
      $_SESSION["user_id"] = $user["id"];
      header("Location: index.php");
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
  <link rel="stylesheet" href="travelog.css" type="text/css" />
  <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
  <script src="./js/validation.js" defer></script>

</head>

<body>
  <header>
    <div class="nav-bar">
      <div class="nav-container">
        <div class="logo"></div>

        <div class="nav-content">
          <a href="AboutTravelog.html" target="_blank">Our Story</a>
          <a href="booking.html">Booking</a>
          <!-- <a href="#">Sign in</a> -->

          <!--  <button class="getstarted">Get Started</button> -->
          <div class="signin-signup">
            <button class="signin">Sign in</button>
            <button class="signup">Sign up</button>
          </div>
        </div>
      </div>
    </div>


  </header>
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
        <!-- <button class="btn2">Start Reading</button> -->
      </div>


    </div>
  </section>

  <div class="blur-background"></div>
  <div class="form-popup">
    <div class="login e-none">
      <div class="close-button"><i class="fa-solid fa-xmark"></i></div>
      <div class="travelog-logo"></div>
      <div class="welcome">
        <h1>Welcome to Travelog</h1>
      </div>
      <div class="form-cotainer">

        <?php if ($is_invalid) : ?>
          <em>Invalid Login</em>
        <?php endif; ?>

        <form id="form-register" method="POST" novalidate>

          <div class="email">
            <label for="email"> Email </label>
          </div>
          <span>
            <div class="email-container">
              <input type="email" id="email" name="email" autocomplete="email" placeholder="Email" spellcheck="false" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">

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
            <!--  <button class="btn btn-primary"> Log in</button> -->
            <input type="submit" class="btn btn-primary" name="submit" value="Log in" />
          </div>

          <div class="signup-button">
            <button class="login-signup" type="button">
              Not on Travelog? Signup
            </button>
          </div>
        </form>
      </div>
    </div>

    <!--   signup -->

    <div class="signup-form d-none">
      <div class="close-singup"><i class="fa-solid fa-xmark"></i></div>
      <div class="travelog-logo"></div>
      <div class="welcome">
        <h1>Join Travelog</h1>
      </div>

      <div class="form-cotainer">
        <form id="formregister" action="signup.php" method="POST" novalidate>
          <div class="username">
            <label for="name">FullName</label>
          </div>
          <div class="username-container">
            <input class="username-input" type="text" id="username" name="name" placeholder="Fullname" />
          </div>
          <div class="email-signup">
            <label for="email"> Email </label>
          </div>
          <span>
            <div class="email-signup-container">
              <input type="email" id="email" name="email" autocomplete="email" placeholder="Email" spellcheck="false" />
            </div>
          </span>
          <br />

          <div class="password-signup">
            <label for="password"> Password </label>
          </div>
          <span>
            <div class="pass-signup-container">
              <input class="password-input" type="password" id="password" name="password" autocomplete="list" placeholder="Password" spellcheck="false" />
              <span class="eye1" onclick="signupPasswordVisible()">
                <i id="icon3" class="fa-solid fa-eye"></i>
                <i id="icon4" class="fa-solid fa-eye-slash"></i>
              </span>
            </div>
          </span>

          <br />
          <!--  <div class="dob">
              <label for="dob">Date of Birth</label>
            </div>
            <div class="dob-container">
              <input
                class="dob-input"
                type="date"
                id="dob"
                name="dob"
                pattern="\d{1,2}/\d{1,2}/\d{4}"
                placeholder="dd/mm/yyyy"
                required
              />
            </div> -->

          <div class="submit-button-signup">
            <input type="submit" class="btn-continue" value="Continue" />
          </div>

          <div class="already-account">
            <div class="already">Already a Member?</div>
            <button class="already-button" type="button">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!--   <button id="demo">The time is?</button> -->

  <script>
    /* const time = (document.getElementById("demo").innerHTML = Date()); */

    //Form pop up function
    const showPopupBtn = document.querySelector(".signin");
    const hidePopupBtn = document.querySelector(".form-popup .close-button");

    showPopupBtn.addEventListener("click", () => {
      document.body.classList.toggle("show-popup");
      document.querySelector(".signup-form").classList.add("d-none");
      document.querySelector(".login").classList.remove("d-none");
    });

    hidePopupBtn.addEventListener("click", () => showPopupBtn.click());

    //Direct to signup page if user have no account

    const signupBtn = document.querySelector(".login-signup");
    signupBtn.addEventListener("click", () => {
      document.querySelector(".signup-form").classList.remove("d-none");
      document.querySelector(".login").classList.add("d-none");
    });

    //Back to Login page if already has
    const backToLogin = document.querySelector(".already-button");
    const hidesingup = document.querySelector(".close-singup");
    backToLogin.addEventListener("click", () => {
      document.querySelector(".signup-form").classList.add("d-none");
      document.querySelector(".login").classList.remove("d-none");
    });

    hidesingup.addEventListener("click", () => {
      document.querySelector(".signup-form").style.display = "none";
      document.querySelector(".blur-background").style.opacity = "0";
      /*  document.querySelector(".blur-background").style.display = "none"; */

    });

    //hide signup form
    /* const hidesingup = document.querySelector(".close-singup"); */

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

    const signupPasswordVisible = () => {
      const y = document.querySelector(".pass-signup-container #password ");
      const visible1 = document.getElementById("icon3");
      const hide1 = document.getElementById("icon4");

      if (y.type === "password") {
        y.type = "text";
        visible1.style.display = "block";
        hide1.style.display = "none";
      } else {
        y.type = "password";
        visible1.style.display = "none";
        hide1.style.display = "block";
      }
    };

    const signupPopUp = document.querySelector(".signup");
    const closeSigup = document.querySelector(".close-singup");
    const loginPopUp = document.querySelector(".already-account");

    signupPopUp.addEventListener("click", () => {

      document.querySelector(".blur-background").style.display = "block";
      document.querySelector(".signup-form").style.display = "block";
    });

    closeSigup.addEventListener("click", () => {
      document.querySelector(".signup-form").style.display = "none";
    });

    loginPopUp.addEventListener("click", () => {
      document.querySelector(".login").classList.remove("e-none");
      document.querySelector(".signup-form").classList.add("e-none");
    });
  </script>
</body>

</html>