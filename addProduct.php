<?php
require('dbinit.php');

$sql = "SELECT * FROM motorbike";
    $result = $dbc->query($sql);

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate motorbike name
    if (empty($_POST['motorbikeName'])) {

        $errors['motorbikeName'] = "*Required";
    } else {
        $motorbikeName = filter_var($_POST['motorbikeName'], FILTER_SANITIZE_STRING);
    }

    // Validate motorbike description
    if (empty($_POST['motorbikeDescription'])) {
        $errors['motorbikeDescription'] = "*Required";
    } else {
        $motorbikeDescription = filter_var($_POST['motorbikeDescription'], FILTER_SANITIZE_STRING);
    }

    // Validate motorbike price
    if (empty($_POST['motorbikePrice'])) {
        $errors['motorbikePrice'] = "*Required";
    } else {
        $motorbikePrice = filter_var($_POST['motorbikePrice'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        if (!is_numeric($motorbikePrice) || $motorbikePrice <= 0) {
            $errors['motorbikePrice'] = "Motorbike price must be a valid positive number.";
        }
    }

    // Validate quantity available
    if (empty($_POST['quantityAvailable'])) {
        $errors['quantityAvailable'] = "*Required";
    } else {
        $quantityAvailable = filter_var($_POST['quantityAvailable'], FILTER_SANITIZE_NUMBER_INT);
        if (!is_numeric($quantityAvailable) || $quantityAvailable <= 0) {
            $errors['quantityAvailable'] = "Quantity available must be a valid positive integer.";
        }
    }

    // File upload handling
    if (!empty($_FILES['motorbikeImage']['name'])) {
        $targetDir = "./uploads/";
        $targetFile = $targetDir . basename($_FILES['motorbikeImage']['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if file is an actual image or fake image
        $check = getimagesize($_FILES['motorbikeImage']['tmp_name']);
        if ($check === false) {
            $errors['motorbikeImage'] = "File is not an image.";
        }

        // Check file size
        if ($_FILES['motorbikeImage']['size'] > 500000) {
            $errors['motorbikeImage'] = "Sorry, your file is too large.";
        }

        // Allow only certain file formats
        $allowedExtensions = array("jpg", "jpeg", "png");
        if (!in_array($imageFileType, $allowedExtensions)) {
            $errors['motorbikeImage'] = "Sorry, only JPG, JPEG And PNG files are allowed.";
        }

        // If there are no errors, move the uploaded file to the designated directory
        if (empty($errors)) {
            if (move_uploaded_file($_FILES['motorbikeImage']['tmp_name'], $targetFile)) {
                echo "The file " . basename($_FILES['motorbikeImage']['name']) . " has been uploaded.";
            } else {
                $errors['motorbikeImage'] = "Sorry, there was an error uploading your file.";
            }
        }
    }else{
      $errors['motorbikeImage'] = "*Required";
    }

    // If there are no validation errors, proceed with inserting into the database
    if (empty($errors)) {
        // Insert data into the database
        $sql = "INSERT INTO motorbike (motorbikeName, motorbikeDescription, motorbikePrice, quantityAvailable, motorbikeImage) 
                VALUES ('$motorbikeName', '$motorbikeDescription', '$motorbikePrice', '$quantityAvailable', '$targetFile')";

        if ($dbc->query($sql) === TRUE) {
            header("Location: addProduct.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $dbc->error;
        }

        $dbc->close();
    } 
}
?>

<?php 
session_start();
  echo "<script>console.log( " . $_SESSION['admin']. " );</script>";
  if(isset($_SESSION['admin']) && $_SESSION['admin'] === true){ 
    
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
        
        <div class="section hero-section">
            <div class="container" >
              <div class="row">
                <div class="col-6" style="border-right: 1px solid #333;">
                <div class="container-form">
                    <div class="title">Product Details</div>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                        <div class="user__details">
                            <div class="input__box">
                                <span class="details">Name</span>
                                <span class="error"><?php echo $errors['motorbikeName'] ?? '' ?></span>
                                <input type="text" id="motorbikeName" name="motorbikeName" placeholder="Motorbike Name"  >

                            </div>
                            <div class="input__box">
                                <span class="details">Description</span>
                                <span class="error"><?php echo $errors['motorbikeDescription'] ?? '' ?></span>
                                <input type="text" id="motorbikeDescription" name="motorbikeDescription" placeholder="Motorbike Description"  >
                            </div>
                            <div class="input__box">
                                <span class="details">Price</span>
                                <span class="error"><?php echo $errors['motorbikePrice'] ?? '' ?></span>
                                <input type="text" id="motorbikePrice" name="motorbikePrice" placeholder="Motorbike Price"  >
                            </div>
                            <div class="input__box">
                                <span class="details">Quantity</span>
                                <span class="error"><?php echo $errors['quantityAvailable'] ?? '' ?></span>
                                <input type="text" id="quantityAvailable" name="quantityAvailable" placeholder="Motorbike Quantity"  >
                            </div>
                            <div class="input__box">
                                <span class="details">Motorbike Image</span>
                                <span class="error"><?php echo $errors['motorbikeImage'] ?? '' ?></span>
                                <input type="file" id="motorbikeImage" name="motorbikeImage" placeholder="Motorbike Image"  >
                            </div>
                            <div>
                                <button type="submit" class="button-primary">Add Bike</button>
                            </div>
                        </div>
                    </form>
                </div>
</div>
<div class="col-6">
<div class="row">
  <?php  while($row = $result->fetch_assoc()) { ?>
      <div class="col-xl-12 col-md-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between p-md-1">
              <div class="d-flex flex-row">
                <div class="align-self-center m-1">
                  <img height="100" width="100" src="<?php echo $row['motorbikeImage'] ?>"/>
                </div>
                <div class="m-2">
                  <h4><?php echo $row['motorbikeName'] ?></h4>
                  <p class="mb-0"><?php echo $row['motorbikeDescription'] ?></p>
                </div>
              </div>
              <div class="m-2">
              <p class="mb-0">Price: CAD <?php echo $row['motorbikePrice'] ?></p>
                  <p class="mb-0">In Stock: <?php echo $row['quantityAvailable'] ?></p>
                </div>
              <div class="align-self-center">
                <a href="update.php?motorbikeID=<?php echo $row['motorbikeID']; ?>" class="button-primary py-2 px-4">Update</a>
                <a href="delete.php?motorbikeID=<?php echo $row['motorbikeID']; ?>" class="button-primary py-2 px-4" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>              
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php }  ?>
</div>

</div>
</div>
            </div>
        </div>
        <footer>
            <div class="container">
                <div class="footer-wrapper">
                    <div class="footer-content-top">
                        <div class="footer-main-container">
                            <a href="index.html" class="footer-logo-container">
                                <img src="images/logo.png" alt="Logo" class="footer-logo" />
                            </a>
                            <p class="footer-paragraph">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Lectus mattis nunc aliquam tincidunt est non.
                            </p>
                            <div class="_5-column-grid">
                                <a href="https://www.facebook.com/" target="_blank" class="footer-social-link">
                                    <img src="images/facebook.png" alt="Facebook" class="image footer-social-link" />
                                </a>
                                <a href="https://www.instagram.com/" target="_blank" class="footer-social-link">
                                    <img src="images/insta.png" alt="Instagram" class="image footer-social-link" />
                                </a>
                                <a href="https://www.linkedin.com/" target="_blank" class="footer-social-link">
                                    <img src="images/linkedin.png" alt="LinkedIn" class="image footer-social-link" />
                                </a>
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
                                            <a href="about.html" class="footer-link w--current">About</a>
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
                                            <a href="mailto:group5@gmail.com" class="contact-link-wrapper w-inline-block">
                                                <img src="images/email.png" alt="Email Icon" class="image contact-link-icon footer-icon" />
                                                <div>group5@gmail.com</div>
                                            </a>
                                        </li>
                                        <li class="footer-nav-item">
                                            <a href="tel:(343)987-5502" class="contact-link-wrapper w-inline-block">
                                                <img src="images/phone.png" alt="Phone Icon" class="image contact-link-icon footer-icon" />
                                                <div>(343) 987 - 5502</div>
                                            </a>
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
<?php } else { 
  session_destroy();
    echo "<script>alert('Login to access admin portal!'); window.location.href = 'login.php';</script>";
  ?>

<?php } ?>