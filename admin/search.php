<?php
include 'partials/_header.php';
include 'partials/_navbar.php';


// for store user_id 
if(isset($_SESSION['user_data'])){
    $user_id = $_SESSION['user_data']['user_id'];
}

// for search

$select_blog_sql = "SELECT * FROM `blog` LEFT JOIN category ON blog.category = category.cat_id LEFT JOIN user ON blog.author_id = user.user_id WHERE blog.blog_title LIKE '%$search%' or blog.blog_body LIKE '%$search%' or blog.publish_date LIKE '%$search%'  AND user.user_id = '$user_id' ORDER BY blog.publish_date DESC;";
$select_blog_result = mysqli_query($conn,$select_blog_sql);
$check_blog = mysqli_num_rows($select_blog_result);
?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="h3 mb-0 text-gray-800">Search result for: <?php echo $search ?></h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Blog</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-12">
            <a class="btn btn-primary mb-2" href="add_blog.php">Add Blog</a>
        </div>
        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Blogs</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">S.NO</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Author</th>
                                <th class="text-center">Date</th>
                                <th class="text-center" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if($check_blog>0){
                                $count = 1;
                                while($rows= mysqli_fetch_assoc($select_blog_result)){
                                    echo '<tr>
                                    <td class="text-center pt-4">'.$count.'</td>
                                    <td class="text-center pt-4">'.$rows['blog_title'].'</td>
                                    <td class="text-center pt-4">'.$rows['cat_name'].'</td>
                                    <td class="text-center pt-4">'.$rows['username'].'</td>
                                    <td class="text-center pt-4">'.date('d-M-Y', strtotime($rows['publish_date'])).'</td>';
                                ++$count;
                            ?>
                                
                                
     
                                <!-- edit  -->
                            <?php
                             echo   '<td class="text-center">
                                        <a href="update_blog.php?id='.$rows['blog_id'].'" class="btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                            <span>Update</span>
                                        </a>
                                     </td>';
                            ?>     
                                <!-- delete  -->
                                    <td>
                                       <!-- delete form -->
                                        <form  method="POST" onsubmit="return confirm('Are you sure want to Delete?')">
                                                    
                                                 <input type="hidden" value="<?php echo $rows['blog_id'] ?>" name="blog_id">
                                                 
                                                 <button type="submit" name="delete_blog" class="btn btn-danger">
                                                 <i class="fas fa-trash"></i>
                                                 <span>Delete</span>

                                                 </button>
                                        </form>         
                                         <!-- delete form end -->
                                   </td> 
                                 <!-- delete end  -->
                        <?php echo  '</tr>';
                        } //while end 
                        }else{
                            echo "no rows Found";
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
if(isset($_POST['delete_blog'])){
    $blog_id = $_POST['blog_id'];
    $delete_sql = "DELETE FROM blog WHERE `blog_id` ='$blog_id'";
    $delete_result=mysqli_query($conn,$delete_sql); 
    if($delete_result){
        $msg = ['blog has been deleted successfully','alert-success'];;
        $_SESSION['msg']=$msg;
        header("location:index.php");
    }else{
        $msg = ['Failed! Please try again','alert-danger'];;
        $_SESSION['msg']=$msg;
        header("location:index.php");
    }
}
// delete query end 
?>