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
            <!-- add category form -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Add Category</h6>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="add_category">Category</label>
                            <input type="text" class="form-control" id="add_category" placeholder="Category" name="add_category_name">
                        </div>
                        <button type="submit" class="btn btn-primary" name="add_category_btn">Add</button>
                        <a href="categories.php" class="btn btn-primary" >Back</a>
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
// add category query 
if(isset($_POST['add_category_btn'])){
    $add_category_name = mysqli_real_escape_string($conn,$_POST['add_category_name']);
    
    // query for check categroy exists or not
    $check_category_sql = "SELECT * FROM `category` WHERE cat_name = '$add_category_name'";
    $check_category_result = mysqli_query($conn,$check_category_sql);
    $check_category_rows = mysqli_num_rows($check_category_result);
   
    if($check_category_rows>0){
        $msg = ['Category already exists','alert-danger'];
        $_SESSION['msg']=$msg;
        header("location:add_category.php");        
    }else{
        // if category not exist then run insert  query
        $add_category_sql = "INSERT INTO `category` (`cat_name`) VALUES ('$add_category_name')";
        $add_category_result = mysqli_query($conn,$add_category_sql);
        
        if($add_category_result){
            $msg = ['Category has been Added Successfully','alert-success'];
            $_SESSION['msg']=$msg;
            header("location:categories.php");
        }else{
            $msg = ['Failed! Please try again','alert-danger'];;
            $_SESSION['msg']=$msg;
            header("location:add_category.php");
            
        }
    }
}

?>