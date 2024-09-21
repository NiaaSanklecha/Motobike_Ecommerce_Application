<?php
// Include your database connection file here
include_once 'dbinit.php';

// Check if motorbikeID is set in the URL
if(isset($_GET['motorbikeID'])) {
    $motorbikeID = $_GET['motorbikeID'];
    
    // Check if the form is submitted
    if(isset($_POST['update'])) {
        // Retrieve updated values from the form
        $updatedMotorbikeName = prepare_string($dbc, $_POST['motorbikeName']);
        $updatedMotorbikeDescription = prepare_string($dbc, $_POST['motorbikeDescription']);
        $updatedMotorbikePrice = $_POST['motorbikePrice'];
        $updatedQuantityAvailable = $_POST['quantityAvailable'];

        // Update the motorbike details in the database
        $updateQuery = "UPDATE motorbike 
                        SET motorbikeName = '$updatedMotorbikeName', 
                            motorbikeDescription = '$updatedMotorbikeDescription', 
                            motorbikePrice = '$updatedMotorbikePrice', 
                            quantityAvailable = '$updatedQuantityAvailable' 
                        WHERE motorbikeID = '$motorbikeID'";
        if ($dbc->query($updateQuery) === TRUE) {
            // Redirect back to the main page after updating
            header("Location: addProduct.php");
            exit();
        } else {
            // Handle the case when the update query fails
            echo "Error updating record: " . $dbc->error;
        }
    } else {
        // Fetch motorbike details from the database based on motorbikeID
        $query = "SELECT * FROM motorbike WHERE motorbikeID = '$motorbikeID'";
        $result = $dbc->query($query);
        if ($result->num_rows > 0) {
            $motorbikeDetails = $result->fetch_assoc();
        } else {
            echo "Motorbike not found.";
            exit();
        }
    }
} else {
    // Redirect to the main page if motorbikeID is not provided
    header("Location: addProduct.php");
    exit();
}
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
                                    <a href="addProduct.php" class="nav-link">Admin Portal</a>
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
                    <form method="post" class="container-form">
        <div class="title">Motorbike Details</div>
        <div class="user__details">
            <div class="input__box">
                <label for="motorbikeName" class="details">Motorbike Name:</label><br>
                <input type="text" id="motorbikeName" name="motorbikeName" class="input" value="<?php echo $motorbikeDetails['motorbikeName']; ?>"><br>
            </div>
            <div class="input__box">
                <label for="motorbikeDescription" class="details">Motorbike Description:</label><br>
                <textarea id="motorbikeDescription" name="motorbikeDescription" class="input"><?php echo $motorbikeDetails['motorbikeDescription']; ?></textarea><br>
            </div>
            <div class="input__box">
                <label for="motorbikePrice" class="details">Motorbike Price:</label><br>
                <input type="text" id="motorbikePrice" name="motorbikePrice" class="input" value="<?php echo $motorbikeDetails['motorbikePrice']; ?>"><br>
            </div>
            <div class="input__box">
                <label for="quantityAvailable" class="details">Quantity Available:</label><br>
                <input type="text" id="quantityAvailable" name="quantityAvailable" class="input" value="<?php echo $motorbikeDetails['quantityAvailable']; ?>"><br>
            </div>
        </div>
        <br>
        <input type="submit" name="update" value="Update" class="button-primary">
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

