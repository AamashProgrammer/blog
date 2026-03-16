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


// for no direct access to update_categroy.php  
if(!isset($_GET['id'])){
    header("location:index.php");
}

// initialize variable
$cat_name = ""; 
// get id from url 
if(isset($_GET['id'])){
   $cat_id  = $_GET['id'];
//    select query for update category 
    $select_sql_update = "SELECT * FROM `category` WHERE cat_id = '$cat_id'";
    $select_result_update = mysqli_query($conn,$select_sql_update);
    // for no user can changes with url 
    $check_exists = mysqli_num_rows($select_result_update);
    if($check_exists>0){
        // fetch array 
        // fetch data in $row variable 
        $row = mysqli_fetch_assoc($select_result_update);
        $cat_name = $row['cat_name'];
    }else{
        header("location:index.php");
    }      
}
// url work end 
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <!-- update category form -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Update Category</h6>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="update_category">Category</label>
                            <input type="text" class="form-control" id="update_category" placeholder="Category" name="update_category_name" value="<?php echo $cat_name 
                            ?>">
                        </div>
                        <button type="submit" class="btn btn-primary" name="update_category_btn">Update</button>
                        
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
// update category query 
if(isset($_POST['update_category_btn'])){
    $update_category_name = mysqli_real_escape_string($conn,$_POST['update_category_name']);
    
    // query for check category exists or not
    // (category is from same id then run update query if not from same id then don't run.)
    $check_category_sql = "SELECT * FROM `category` WHERE cat_name = '$update_category_name' AND cat_id != '$cat_id'";
    $check_category_result = mysqli_query($conn,$check_category_sql);
    $check_category_rows = mysqli_num_rows($check_category_result);
   
    if($check_category_rows>0){
        $msg = ['Category already exists','alert-danger'];
        $_SESSION['msg']=$msg;
        header("location:update_category.php");        
    }else{
        // if category not exist then run update  query
        $update_category_sql = "UPDATE `category` SET `cat_name` = '$update_category_name' WHERE `category`.`cat_id` = '$cat_id'";
        $update_category_result = mysqli_query($conn,$update_category_sql);
        
        if($update_category_result){
            $msg = ['Category has been updated Successfully','alert-success'];
            $_SESSION['msg']=$msg;
            header("location:categories.php");
        }else{
            $msg = ['Failed! Please try again','alert-danger'];;
            $_SESSION['msg']=$msg;
            header("location:update_category.php");
            
        }
    }
}

?>