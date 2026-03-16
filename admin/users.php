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
// query for users 
$sql = "SELECT * FROM user";
$result = mysqli_query($conn,$sql);
$check_rows = mysqli_num_rows($result);
?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="users.php">users</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-12">
            <a class="btn btn-primary mb-2" href="add_user.php">Add User</a>
        </div>
        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Users</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">S.NO</th>
                                <th class="text-center">User Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- show users through php     -->
                            <?php
                         if($check_rows>0){
                            $count = 1;
                            while($rows=mysqli_fetch_assoc($result)){
                                echo '<tr>
                                       <td class="text-center pt-4">'.$count.'</td>
                                       <td class="text-center pt-4">'.$rows['username'].'</td>
                                       <td class="text-center pt-4">'.$rows['email'].'</td>';
                                       
                                       if($rows['role']=='1'){
                                           echo '<td class="text-center pt-4">Admin</td>';
                                        }else{
                                           echo '<td class="text-center pt-4">Co Admin</td>';
                                        }
                            
                                
                                // <!-- delete  -->
                                     echo '<td>';
                                     ?>
                                         
                                                 <!-- delete form -->
                                                 <form  method="POST" onsubmit="return confirm('Are you sure want to Delete?')">
                                                 
                                                 <input type="hidden" value="<?php echo $rows['user_id'] ?>" name="user_id">
                                                 
                                                 <button type="submit" name="delete_user" class="btn btn-danger">
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
if(isset($_POST['delete_user'])){
    $user_id = $_POST['user_id'];
    $delete_sql = "DELETE FROM user WHERE `user_id` ='$user_id'";
    $delete_result=mysqli_query($conn,$delete_sql); 
    if($delete_result){
        $msg = ['User has been deleted successfully','alert-success'];;
        $_SESSION['msg']=$msg;
        header("location:users.php");
    }else{
        $msg = ['Failed! Please try again','alert-danger'];;
        $_SESSION['msg']=$msg;
        header("location:users.php");
    }
}
// delete query end 
?>