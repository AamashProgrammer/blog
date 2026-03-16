<?php
include 'partials/_header.php';
include 'partials/_navbar.php';

// for store author_id in blog table
if(isset($_SESSION['user_data'])){
    $author_id = $_SESSION['user_data']['user_id'];
}

// for no direct access to update_blog.php 
if(!isset($_GET['id'])){
    header("location:index.php");
}

// show categories in select input field 
$show_categories = "SELECT * FROM category";
$show_cat_result = mysqli_query($conn,$show_categories);

// variable initailzation 
$blog_title = "";
$blog_body = "";
$blog_image = "";
$cat_id = "";
$cat_name = "";
// check GET METHOD
if(isset($_GET['id'])){
    $blog_id=$_GET['id'];
// query 
    $update_select = "SELECT * FROM blog LEFT JOIN category ON blog.category=category.cat_id LEFT JOIN user ON blog.author_id=user.user_id WHERE blog.blog_id='$blog_id'";
    $update_select_result = mysqli_query($conn,$update_select);
    // for no user can changes wuith url 
    $check_exists = mysqli_num_rows($update_select_result);
    if($check_exists>0){
        // fetch array 
    $update_blog_rows = mysqli_fetch_assoc($update_select_result);
        // value store  in variable
    $blog_title = $update_blog_rows['blog_title'];
    $blog_body = $update_blog_rows['blog_body'];
    $blog_image = "upload/".$update_blog_rows['blog_image'];
    $cat_id = $update_blog_rows['cat_id'];
    $cat_name = $update_blog_rows['cat_name'];
}else{ // end if of $check_exists
    header("location:index.php");
}
}

?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <!-- add category form -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Update Blog</h6>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Blog title</label>
                            <input type="text" class="form-control" placeholder="Blog title" name="blog_title" value="<?php echo $blog_title; ?>">
                        </div>

                        <div class="form-group">
                            <label for="blog">Body/Description</label>
                            <textarea name="blog_body" id="blog" cols="30" rows="10" class="form control"><?php echo $blog_body; ?></textarea >
                        </div>

                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="blog_image" >
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <img  class="mb-3" src="<?php echo $blog_image; ?>" width="100px">
                               <?php echo $blog_image; ?>
                            </div>
                        </div>

                        <select class="form-control mb-3 mt-3"  name="select_category" >
                           <!-- show category through php  -->
                           <option value="<?php echo $cat_id; ?>" ><?php echo $cat_name; ?></option>   
                                    <?php
                                    // show_cat_result                
                                    while($cats=mysqli_fetch_assoc($show_cat_result)){
                                        if ($cats['cat_id'] == $cat_id) {
                                            continue;
                                          }
                                    echo "<option value='". $cats['cat_id']."'>".$cats['cat_name']."</option>";
                                    }
                                     ?>
                            <!-- end  -->
                        </select>

                        <button type="submit" class="btn btn-primary" name="update_blog">Update</button>
                        <a href="index.php" class="btn btn-primary" >Back</a>
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
if(isset($_POST['update_blog'])){
    $blog_title = mysqli_real_escape_string($conn,$_POST['blog_title']);
    $blog_body = mysqli_real_escape_string($conn,$_POST['blog_body']);
    // for image 
    // we are not generate random number here because filename should be empty when we don't want to update image 
    $file_name = $_FILES['blog_image']['name'];
    $tmp_name = $_FILES['blog_image']['tmp_name'];
    $size = $_FILES['blog_image']['size'];
    $image_extension = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
    $allow_type = ['jpg','png','jpeg'];
    // end 
    $select_category = mysqli_real_escape_string($conn,$_POST['select_category']);

    // if you  want to update image also 
    if(!empty($file_name)){
        if(in_array($image_extension,$allow_type)){
            if($size<200000000){
                unlink($blog_image);
                // for generating random name
                $random = rand(11111111,99999999);
                // filename concatenate with random number
                $file_name = $random.'_'.$file_name;
                // $destination variable initialized here is beacuse we need to upload file with random nmber 
                $destination = "upload./" . $file_name;
                // for uploading image 
                move_uploaded_file($tmp_name,$destination);
                $update_blog = "UPDATE `blog` SET `blog_title` = '$blog_title', `blog_body` = '$blog_body', `blog_image` = '$file_name', `category` = '$select_category', `author_id` = '$author_id' WHERE `blog`.`blog_id` = $blog_id";
                $update_query = mysqli_query($conn,$update_blog);
    
                if($update_query){
                    $msg = ['Post updated successfully image','alert-success'];
                    $_SESSION['msg']=$msg;
                    header("location:index.php");
                }else{
                    $msg = ['Failed! Please try again','alert-danger'];
                    $_SESSION['msg']=$msg;
                    header("location:update_blog.php");
            
                }
            }else{
                $msg = ['image size should  not be grater than 200 mb','alert-danger'];
                $_SESSION['msg']=$msg;
                header("location:update_blog.php");    
            }
        }else{
            $msg = ['file is not in jpg, png and jpeg format','alert-danger'];
            $_SESSION['msg']=$msg;
            header("location:update_blog.php");    
        }
    
    }else{
    //    image is empty 
    $update_blog = "UPDATE `blog` SET `blog_title` = '$blog_title', `blog_body` = '$blog_body', `category` = '$select_category', `author_id` = '$author_id' WHERE `blog`.`blog_id` = $blog_id";
                $update_query = mysqli_query($conn,$update_blog);
    
                if($update_query){
                    $msg = ['Post updated successfully','alert-success'];
                    $_SESSION['msg']=$msg;
                    header("location:index.php");
                }else{
                    $msg = ['Failed! Please try again','alert-danger'];
                    $_SESSION['msg']=$msg;
                    header("location:update_blog.php");
            
                }
    }
    
}//isset if end
?>