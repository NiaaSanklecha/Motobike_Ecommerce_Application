<?php
    require('dbinit.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Group 5</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="page-wrapper">
    <header>
            <div class="container">
                <div class="header-wrapper">
                    <div class="split-content header-right">
                        <a href="index.html" class="brand">
                            <img src="images/logo.png" alt="Logo" class="header-logo" />
                        </a>
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
                                    <a href="addProduct.php" class="nav-link">Admin Portal</a>
                                </li>
                                
                            </ul>
                        </nav>
                    </div>
                    <div class="split-content header-left">
                      <?php 
                      session_start();
                       if(isset($_SESSION["loggedin"]) &&  $_SESSION["loggedin"] === true){ ?>
                       <a href="cart.php" class="m-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                          <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z"/>
                        </svg>
                      </a>
                      <a href="logout.php" class="m-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                          <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                        </svg>
                      </a>
                      <?php } else{ ?>
                        <a href="login.php" class="button-primary">Login</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </header>
      
      
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
