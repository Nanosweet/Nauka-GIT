<?php

require_once 'src/User.php';

$firstname = $lastname = $email = $password = '';

$stringPattern = '/^[a-zA-Zą-żĄ-ŻL-Łl-ł]{3,}$/';
$passwordPattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/';

$errors = array(
  'firstname' => '',
  'lastname' => '',
  'email' => '',
  'password' => '',
  'confirm_password' => '',
);


// Walidacja formularza
// Jezeli formularz zostal przesłany
if (isset($_POST['submit'])) {

  // Tworzenie nowego obiektu User
  $user = new User();

  // Czy pole zostalo wypelnione
  if (empty($_POST['firstname'])) {

    $errors['firstname'] = 'Pole imie jest wymagane';
  } else {

    $firstname = $_POST['firstname'];

    // Sprawdzanie pola wg patterna wyrazen regularnych
    if (!preg_match($stringPattern, $firstname)) {

      $errors['firstname'] = 'Wprowadz tylko litery';
    } else {

      // ucfirst() - ustawienie pierwszej litery ciagu na wielka 
      // mb_strtolower - ustawienie reszty ciagu na male litery, lacznie z kodowaniem polskich znakow
      $firstname = ucfirst(mb_strtolower($firstname, 'UTF-8'));
      $user->setFirstname($firstname);
    }
  }


  if (empty($_POST['lastname'])) {
    $errors['lastname'] = 'Pole nazwisko jest wymagane <br>';
  } else {
    $lastname = $_POST['lastname'];
    if (!preg_match($stringPattern, $lastname)) {
      $errors['lastname'] = 'Wprowadz tylko litery';
    } else {

      // ucfirst() - ustawienie pierwszej litery ciagu na wielka 
      // mb_strtolower - ustawienie reszty ciagu na male litery, lacznie z kodowaniem polskich znakow
      $lastname = ucfirst(mb_strtolower($lastname, 'UTF-8'));
      //echo '<p>imie'.$lastname.'</p></br>';
      $user->setLastname($lastname);
    }
  }


  if (empty($_POST['email'])) {
    $errors['email'] = 'Pole email jest wymagane';
  } else {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'example@email.com';
    } else {
      $user->setEmail($email);
    }
  }
  

  // 
  if (empty($_POST['password'])) {
    $errors['password'] = 'Pole hasło jest wymagane';
  } else {
    $password = $_POST['password'];
    if (!preg_match($passwordPattern, $password)) {
      $errors['password'] = 'Zbyt proste hasło';
    } else {
      if (empty($_POST['confirm_password'])) {
        $errors['confirm_password'] = 'Pole jest wymagane';
      } else {
        $confirm_password = $_POST['confirm_password'];
        if ($password === $confirm_password) {

          $user->setPassword(password_hash($password, PASSWORD_BCRYPT));
          $exist = $user->checkUserExistByEmail($user);

          if (!$exist) {
            $user->registerUser($user);
            // Przekierowanie usera
            header('Location: login.php');
          } else {
            $errors['email'] = "Użytkownik o tym emailu już istnieje.";
          }
        } else {
          $errors['confirm_password'] = 'Podane hasła są różne';
        }
      }
    }
  }
  if (empty($_POST['confirm_password'])) {
    $errors['confirm_password'] = 'Pole jest wymagane';
  }

}
?>
<!doctype html>
<html lang="zxx">
<?php include 'templates/head/head.html'; ?>

<body>

  <header>
    <!-- Header Start -->
    <?php include 'templates/header/header.html' ?>
    <!-- Header End -->
  </header>
  <main>
    <!-- Hero Area Start-->
    <div class="slider-area ">
      <div class="single-slider slider-height2 d-flex align-items-center">
        <div class="container">
          <div class="row">
            <div class="col-xl-12">
              <div class="hero-cap text-center">
                <h2>Rejestracja konta</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--================Checkout Area =================-->
    <section class="checkout_area section_padding">
      <div class="container">
        <div class="returning_customer">
          <div class="check_title">
            <h2>
              Masz już konto?
              <a href="login.php">Kliknij tutaj, aby się zalogować</a>
            </h2>
          </div>
          <p>
            
          </p>
          <form class="row contact_form" action="#" method="post" novalidate="novalidate">
            <!-- Imie -->
            <div class="col-md-6 form-group p_star">              
              <input type="text" class="form-control" id="name" name="firstname" value="<?php echo $firstname; ?>" placeholder="Podaj imie *" />
              <span class="alert-danger"><?php echo $errors['firstname']; ?></span>
            </div>
            <!-- Nazwisko -->
            <div class="col-md-6 form-group p_star">
              <input type="text" class="form-control" id="name" name="lastname" value="<?php echo $lastname; ?>" placeholder="Podaj nazwisko *" />
              <span class="alert-danger"><?php echo $errors['lastname']; ?></span>
            </div>
            <!-- Email -->
            <div class="col-md-6 form-group p_star">
              <input type="email" class="form-control" id="name" name="email" value="<?php echo $email; ?>" placeholder="Email *" />
              <span class="alert-danger"><?php echo $errors['email']; ?></span>
            </div>
            <!-- Hasło -->
            <div class="col-md-6 form-group p_star">
              <input type="password" class="form-control" id="password" name="password" value="" placeholder="Podaj hasło *" />
              <span class="alert-danger"><?php echo $errors['password']; ?></span>
            </div>
            <!-- Potorz haslo -->
            <div class="col-md-6 form-group p_star">
              <input type="password" class="form-control" id="password" name="confirm_password" value="" placeholder="Powtórz hasło *" />
              <span class="alert-danger"><?php echo $errors['confirm_password']; ?></span>
            </div>
            <div class="col-md-12 form-group">
              <button type="submit" value="submit" class="btn_3" name="submit">
                log in
              </button>
              <div class="creat_account">
                <input type="checkbox" id="f-option" name="selector" />
                <label for="f-option">Remember me</label>
              </div>
              <a class="lost_pass" href="#">Lost your password?</a>
            </div>
          </form>

        </div>
      </div>
    </section>
    <!--================End Checkout Area =================-->
  </main>

  <?php include 'templates/footer/footer.html'; ?>


  <!--? Search model Begin -->
  <div class="search-model-box">
    <div class="h-100 d-flex align-items-center justify-content-center">
      <div class="search-close-btn">+</div>
      <form class="search-model-form">
        <input type="text" id="search-input" placeholder="Searching key.....">
      </form>
    </div>
  </div>
  <!-- Search model end -->

  <!-- JS here -->

  <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
  <!-- Jquery, Popper, Bootstrap -->
  <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
  <script src="./assets/js/popper.min.js"></script>
  <script src="./assets/js/bootstrap.min.js"></script>
  <!-- Jquery Mobile Menu -->
  <script src="./assets/js/jquery.slicknav.min.js"></script>

  <!-- Jquery Slick , Owl-Carousel Plugins -->
  <script src="./assets/js/owl.carousel.min.js"></script>
  <script src="./assets/js/slick.min.js"></script>

  <!-- One Page, Animated-HeadLin -->
  <script src="./assets/js/wow.min.js"></script>
  <script src="./assets/js/animated.headline.js"></script>
  <script src="./assets/js/jquery.magnific-popup.js"></script>

  <!-- Scroll up, nice-select, sticky -->
  <script src="./assets/js/jquery.scrollUp.min.js"></script>
  <script src="./assets/js/jquery.nice-select.min.js"></script>
  <script src="./assets/js/jquery.sticky.js"></script>

  <!-- contact js -->
  <script src="./assets/js/contact.js"></script>
  <script src="./assets/js/jquery.form.js"></script>
  <script src="./assets/js/jquery.validate.min.js"></script>
  <script src="./assets/js/mail-script.js"></script>
  <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

  <!-- Jquery Plugins, main Jquery -->
  <script src="./assets/js/plugins.js"></script>
  <script src="./assets/js/main.js"></script>

</body>

</html>