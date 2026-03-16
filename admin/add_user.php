<?php
include 'partials/_header.php';
include 'partials/_navbar.php';
// for redirect to index 
if(isset($_SESSION['user_data'])){
    $role = $_SESSION['user_data']['role'];     
}
if($role!=1){
    header("location:index.php");
}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <!-- add user form -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Add user</h6>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label >User Name</label>
                            <input type="text" class="form-control"  placeholder="User Name" name="add_user_name">
                        </div>

                        <div class="form-group">
                            <label >Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="add_user_email">
                        </div>
                        
                        <div class="form-group">
                            <label >Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="add_user_password">
                        </div>
                        
                  <select class="form-control mb-3" name="add_user_role">
                    <option>Select Role</option>
                    <option value="1">Admin</option>
                    <option value="0">Co Admin</option>
                  </select>
                        <button type="submit" class="btn btn-primary" name="add_user_btn">Submit</button>
                        <a href="users.php" class="btn btn-primary" >Back</a>
                    </form>
                </div>
            </div>
        </div>
        <!-- row end  -->
    </div>
    <!-- container end  -->
</div>

<?php
include 'partials/_footer.php';
// add user query 
if(isset($_POST['add_user_btn'])){
    $add_user_name = mysqli_real_escape_string($conn,$_POST['add_user_name']);
    $add_user_email = mysqli_real_escape_string($conn,$_POST['add_user_email']);
    $add_user_password = mysqli_real_escape_string($conn,sha1($_POST['add_user_password']));
    $add_user_role = mysqli_real_escape_string($conn,$_POST['add_user_role']);
    
    // query for check categroy exists or not
    $check_user_sql = "SELECT * FROM `user` WHERE `email` = '$add_user_email'";
    $check_user_result = mysqli_query($conn,$check_user_sql);
    $check_user_rows = mysqli_num_rows($check_user_result);
   
    if($check_user_rows>0){
        $msg = ['user already exists','alert-danger'];
        $_SESSION['msg']=$msg;
        header("location:add_user.php");        
    }else{
        // if user not exist then run insert  query
        $add_user_sql = "INSERT INTO `user` (`username`, `email`, `role`, `password` ) VALUES ('$add_user_name', '$add_user_email', '$add_user_role', '$add_user_password')";
        $add_user_result = mysqli_query($conn,$add_user_sql);
        
        if($add_user_result){
            $msg = ['user has been Added Successfully','alert-success'];
            $_SESSION['msg']=$msg;
            header("location:users.php");
        }else{
            $msg = ['Failed! Please try again','alert-danger'];;
            $_SESSION['msg']=$msg;
            header("location:add_user.php");
            
        }
    }
}

?>