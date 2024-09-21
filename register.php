<?php
    require('dbinit.php');

    $firstName = $lastName = $email = $password = "";
    $firstName_err = $lastName_err = $email_err = $password_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (empty(trim($_POST["firstName"]))) {
            $firstName_err = "Please enter your first name.";
        } else {
            $firstName = trim($_POST["firstName"]);
        }

        if (empty(trim($_POST["lastName"]))) {
            $lastName_err = "Please enter your last name.";
        } else {
            $lastName = trim($_POST["lastName"]);
        }
        
        if (empty(trim($_POST["email"]))) {
            $email_err = "Please enter your email.";
        } else {
            $sql = "SELECT id FROM users WHERE email = ?";
            
            if ($stmt = mysqli_prepare($dbc, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                
                $param_email = trim($_POST["email"]);
                
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $email_err = "This email is already taken.";
                    } else {
                        $email = trim($_POST["email"]);
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                mysqli_stmt_close($stmt);
            }
        }
        
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter a password.";     
        } else {
            $password = trim($_POST["password"]);
        }

        if (empty($firstName_err) && empty($lastName_err) && empty($email_err) && empty($password_err)) {
            
            $sql = "INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)";
             
            if ($stmt = mysqli_prepare($dbc, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssss", $param_firstName, $param_lastName, $param_email, $param_password);
                
                $param_firstName = $firstName;
                $param_lastName = $lastName;
                $param_email = $email;
                $param_password = password_hash($password, PASSWORD_DEFAULT);
                
                if (mysqli_stmt_execute($stmt)) {
                  echo "<script>alert('Registration successful!'); window.location.href = 'login.php';</script>";
                  exit;
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                mysqli_stmt_close($stmt);
            }
        }
        if (isset($dbc)) {
          mysqli_close($dbc);
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Group 5</title><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"/>
    
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="page-wrapper">
      <header>
        <div class="container">
          <div class="header-wrapper">
            <div class="split-content header-right">
              <a href="index.html" class="brand">
                <img src="images/logo.png" alt="Logo" class="header-logo"
              /></a>
            </div>
            <div class="split-content header-center">
                <nav role="navigation" class="nav-menu">
                    <ul role="list" class="header-navigation">
                    <li class="nav-item-wrapper">
                        <a href="index.php" class="nav-link">Home</a>
                      </li>
                      <li class="nav-item-wrapper">
                        <a href="about.php" class="nav-link">About</a>
                      </li>
                      <li class="nav-item-wrapper">
                        <a href="products.php" class="nav-link">Products</a>
                      </li>
                      <li class="nav-item-wrapper">
                                    <a href="addProduct.php" class="nav-link">Add Product</a>
                                </li>
                     
                    </ul>
                  </nav>
            </div>
            <div class="split-content header-left">
                
            </div>
          </div>
        </div>
      </header>
      <div class="section hero-section">
            <div class="container" style="display:flex; justify-content: center;">
                <div class="container-form">
                    <div class="title">Create New Account</div>      
<form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="bag_info">
<div class="user__details">
<div class="input__box">
                            <span class="details">First Name</span>
                            <input type="text" class="input" id="firstName" name="firstName"/>
                            <span class="error"><?php echo $firstName_err; ?></span>
</div>
<div class="input__box">
                            <span class="details">Last Name</span>
                            <input type="text" class="input" id="lastName" name="lastName"/>
                            <span class="error"><?php echo $lastName_err; ?></span>
</div>
                            <div class="input__box">
                            <span class="details">Email</span>
                            <input type="text" class="input" id="email" name="email"/>
                            <span class="error"><?php echo $email_err; ?></span>
</div>
<div class="input__box">
                            <span class="details">Password</span>
                            <input type="password" class="input" id="password" name="password"/>
                            <span class="error"><?php echo $password_err; ?></span>
</div>
<div class="input__box" style="display: grid;"
    >
<a href="login.php">Already have an account? Login here</a>

</div>
<div>
                                <button id="login" type="submit" class="button-primary">Create New Account</button>
                            </div>
</div>
</form>
</div>
            </div>
        </div>
      

      
      <footer>
        <div class="container">
          <div class="footer-wrapper">
            <div class="footer-content-top">
              <div class="footer-main-container">
                <a href="index.html" class="footer-logo-container"
                  ><img src="images/logo.png" alt="Logo" class="footer-logo"
                /></a>
                <p class="footer-paragraph">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                  Lectus mattis nunc aliquam tincidunt est non.
                </p>
                <div class="_5-column-grid">
                  <a
                    href="https://www.facebook.com/"
                    target="_blank"
                    class="footer-social-link"
                    ><img
                      src="images/facebook.png"
                      alt="Facebook"
                      class="image footer-social-link" /></a
                  ><a
                    href="https://www.instagram.com/"
                    target="_blank"
                    class="footer-social-link"
                    ><img
                      src="images/insta.png"
                      alt="Instagram"
                      class="image footer-social-link" /></a
                  ><a
                    href="https://www.linkedin.com/"
                    target="_blank"
                    class="footer-social-link"
                    ><img
                      src="images/linkedin.png"
                      alt="LinkedIn"
                      class="image footer-social-link"
                  /></a>
                </div>
              </div>
              <div class="footer-nav-wrapper">
                <div class="footer-menu-wrapper first">
                  <div class="title h4-size footer-menu">Pages</div>
                  <div class="footer-menu-content pages">
                    <ul role="list" class="footer-nav w-list-unstyled">
                      <li class="footer-nav-item">
                        <a href="index.html" class="footer-link">Home</a>
                      </li>
                      <li class="footer-nav-item">
                        <a href="about.html" class="footer-link w--current"
                          >About</a
                        >
                      </li>
                      <li class="footer-nav-item">
                        <a href="products.html" class="footer-link">Products</a>
                      </li>
                      
                    </ul>
                  </div>
                </div>

                <div class="footer-menu-wrapper contact-links">
                  <div class="title h4-size footer-menu">Contact Me</div>
                  <div class="footer-menu-content contact-links">
                    <ul role="list" class="footer-nav last w-list-unstyled">
                      <li class="footer-nav-item">
                        <a
                          href="mailto:group5@gmail.com"
                          class="contact-link-wrapper w-inline-block"
                          ><img
                            src="images/email.png"
                            alt="Email Icon"
                            class="image contact-link-icon footer-icon"
                          />
                          <div>group5@gmail.com</div></a
                        >
                      </li>
                      <li class="footer-nav-item">
                        <a
                          href="tel:(343)987-5502"
                          class="contact-link-wrapper w-inline-block"
                          ><img
                            src="images/phone.png"
                            alt="Phone Icon"
                            class="image contact-link-icon footer-icon"
                          />
                          <div>(343) 987 - 5502</div></a
                        >
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="footer-content-bottom">
              <div>
                Copyright &copy; 2024
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </body>
</html>
