<?php include 'admin/partials/_config.php'; 
// for dropdown / category query

$sql = "SELECT * FROM `category` LIMIT 3";
$result = mysqli_query($conn,$sql);
$check = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
	<meta charset="utf-8">
	<title>Blog web</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
	<meta name="description" content="This is meta description">
	<meta name="author" content="Themefisher">
	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
	<link rel="icon" href="images/favicon.png" type="image/x-icon">
  
  <!-- theme meta -->
  <meta name="theme-name" content="reporter" />

	<!-- # Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Neuton:wght@700&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

	<!-- # CSS Plugins -->
	<link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">

	<!-- # Main Style Sheet -->
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

<header class="navigation">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light px-0">
      <a class="navbar-brand order-1 py-0" href="index.php">
      <h1>Blog web</h1>
      </a>
      <div class="navbar-actions order-3 ml-0 ml-md-4">
        <button aria-label="navbar toggler" class="navbar-toggler border-0" type="button" data-toggle="collapse"
          data-target="#navigation"> <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <!-- search work  -->
      <?php
      if(isset($_GET['search'])){
        $search = $_GET['search'];
      }else{
        $search = "";
      }
      ?>

      <form action="search.php"  method="get"  class="search order-lg-3 order-md-2 order-3 ml-auto d-flex justify-content-center">
        <input name="search" type="search" placeholder="Search..." autocomplete="off">

        <button class="btn btn-outline-success">Search</button>
      </form>

      <!-- end  -->
      <div class="collapse navbar-collapse text-center order-lg-2 order-4" id="navigation">
        <ul class="navbar-nav mx-auto mt-3 mt-lg-0">
          <li class="nav-item"> <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Categories
            </a>
            <!-- for categories  -->
            <div class="dropdown-menu">
         <?php if($check>0){
                while($rows = mysqli_fetch_assoc($result)){
           ?>
              <a class="dropdown-item" href="categories_wise.php?id=<?php echo $rows['cat_id'] ?>"><?php echo $rows['cat_name'] ?></a>
              <?php
          } // end of while loop
        }else{
          ?>
                <a class="dropdown-item" ><?php echo "No categories" ?></a>
          <?php
        } ?>
        </div>
         <!-- end  -->
            
          </li>
          <li class="nav-item"> <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</header>