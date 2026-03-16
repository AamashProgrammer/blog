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


// query for categories 
$sql = "SELECT * FROM category";
$result = mysqli_query($conn,$sql);
$check_rows = mysqli_num_rows($result);
?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Categories</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="categories.php">Categories</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-12">
            <a class="btn btn-primary mb-2" href="add_category.php">Add Category</a>
        </div>
        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">S.NO</th>
                                <th class="text-center">Categories</th>
                                <th class="text-center" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- show categories through php     -->
                            <?php
                         if($check_rows>0){
                            $count = 1;
                            while($rows=mysqli_fetch_assoc($result)){
                                echo '<tr>
                                       <td class="text-center pt-4">'.$count.'</td>
                                       <td class="text-center pt-4">'.$rows['cat_name'].'</td>
                                       
                            
                           
                                <!-- edit  -->
                                <td class="text-center">
                                    <a href="update_category.php?id='.$rows['cat_id'].'" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                        <span>Update</span>
                                    </a>
                                </td>';
                                

                                // <!-- delete  -->
                                     echo '<td>';
                                     ?>
                                         
                                                 <!-- delete form -->
                                                 <form  method="POST" onsubmit="return confirm('Are you sure want to Delete?')">
                                                 
                                                 <input type="hidden" value="<?php echo $rows['cat_id'] ?>" name="cat_id">
                                                 
                                                 <button type="submit" name="delete_cat" class="btn btn-danger">
                                                 <i class="fas fa-trash"></i>
                                                 <span>Delete</span>

                                                 </button>
                                                    <!-- delete form end -->
                                                </form>         
                                        <?php
                               echo '</td>';
                                //  <!-- delete end  -->
                           echo '</tr>';
                            ++$count;
                        } //while end 
                    }else{
                       echo 'no rows found'; //category table is empty
                    }
                    ?>

                        </tbody>
                    </table>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
    <!--Row-->
</div>
<!-- container-fluid end  -->

<?php
include 'partials/_footer.php';

// delete query 
if(isset($_POST['delete_cat'])){
    $cat_id = $_POST['cat_id'];
    $delete_sql = "DELETE FROM category WHERE `cat_id` ='$cat_id'";
    $delete_result=mysqli_query($conn,$delete_sql); 
    if($delete_result){
        $msg = ['Category has been deleted successfully','alert-success'];;
        $_SESSION['msg']=$msg;
        header("location:categories.php");
    }else{
        $msg = ['Failed! Please try again','alert-danger'];;
        $_SESSION['msg']=$msg;
        header("location:categories.php");
    }
}
// delete query end 
?>