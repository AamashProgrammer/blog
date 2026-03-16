<?php
include 'partials/_header.php';
// for redirect to index.php 
if(isset($_SESSION['user_data'])){
  header("location:index.php");
}

?>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>
                  <form class="user" method="POST">
                    <div class="form-group">
                      <input type="email" class="form-control" 
                        placeholder="Enter Email" name="email">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <button class="btn btn-primary btn-block" name="login_btn">Login</button>
                    </div>
                  </form>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->

  <!-- error message  of invalid email/password-->
          <?php 
           if(isset($_SESSION['error'])){
            $error = $_SESSION['error'];
            echo  
             ' <div class="alert alert-danger alert-dismissible col-6 mx-auto" role="alert">
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
             '. $error .'
           </div>';
              unset($_SESSION['error']);
           }  
          ?>        
  <!-- error message end  -->
<?php
include 'partials/_footer.php';

if(isset($_POST['login_btn'])){
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $password = mysqli_real_escape_string($conn,$_POST['password']);

  // select query for checking email and password is correct or not 
  $sql = "SELECT * FROM user WHERE email = '$email' AND password ='$password'";
  $result = mysqli_query($conn,$sql);
  $data = mysqli_num_rows($result);
  if($data>0){
    $row = mysqli_fetch_assoc($result);
    // make an array for session 
    $user_data = array("user_id"=>$row['user_id'], "user_name"=>$row['username'], "role"=>$row['role']);
    
    // store array in session 
    $_SESSION['user_data'] = $user_data;
    header("location:index.php");
  }else{
    $_SESSION['error'] = "invalid email/password";
    header("location:login.php");
  }
}

?>