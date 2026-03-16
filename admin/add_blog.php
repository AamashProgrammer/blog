<?php
include 'partials/_header.php';
include 'partials/_navbar.php';


// for store author_id in blog table
if(isset($_SESSION['user_data'])){
    $author_id = $_SESSION['user_data']['user_id'];
}

// show categories in select input field 
$show_categories = "SELECT * FROM category";
$show_cat_result = mysqli_query($conn,$show_categories);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <!-- add category form -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Add Blog</h6>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Blog title</label>
                            <input type="text" class="form-control" placeholder="Blog title" name="blog_title">
                        </div>

                        <div class="form-group">
                            <label for="blog">Body/Description</label>
                            <textarea name="blog_body" id="blog" cols="30" rows="10" class="form control"></textarea required>
                        </div>

                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="blog_image" required>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>

                        <select class="form-control mb-3"  name="select_category" required>
                            <option>Select Category</option>
                           <!-- show category through php  -->
                           <?php
                           while($rows = mysqli_fetch_assoc($show_cat_result)){
                                echo '<option value="'.$rows['cat_id'].'">'.$rows['cat_name'].'</option>';
                            }
                            ?>
                            <!-- end  -->
                        </select>

                        <button type="submit" class="btn btn-primary" name="add_blog">Add</button>
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
// add blog work
if(isset($_POST['add_blog'])){
    $blog_title = mysqli_real_escape_string($conn,$_POST['blog_title']);
    $blog_body = mysqli_real_escape_string($conn,$_POST['blog_body']);
    // for image 
    $random = rand(11111111,99999999);
    $file_name = $random.'_' .$_FILES['blog_image']['name'];
    $tmp_name = $_FILES['blog_image']['tmp_name'];
    $size = $_FILES['blog_image']['size'];
    $image_extension = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
    $allow_type = ['jpg','png','jpeg'];
    $destination = "upload./" . $file_name; 
    // for category 
    $select_category = mysqli_real_escape_string($conn,$_POST['select_category']);

    // for check extention 
    if(in_array($image_extension,$allow_type)){
        // for check image size
        if($size<200000000){
            // for upload in folder 
            move_uploaded_file($tmp_name,$destination);
            //  add blog query   
            $add_blog_sql = "INSERT INTO `blog` (`blog_title`, `blog_body`, `blog_image`, `category`, `author_id`, `publish_date`) VALUES ('$blog_title', '$blog_body', '$file_name', '$select_category', '$author_id', current_timestamp())";
            $add_blog_result = mysqli_query($conn,$add_blog_sql);

            // for add blog query
            if($add_blog_result){
                $msg = ['Post published successfully','alert-success'];
                $_SESSION['msg']=$msg;
                header("location:index.php");
            }else{
                $msg = ['Failed! Please try again','alert-danger'];
                $_SESSION['msg']=$msg;
                header("location:add_blog.php");
        
            }
        }else{//if end of size check
            $msg = ['image size should not be grater than 200 mb','alert-danger'];
            $_SESSION['msg']=$msg;
            header("location:add_blog.php");    
        }
    }else{ // if end of check extension
        $msg = ['file is not in jpg, png and jpeg format','alert-danger'];
        $_SESSION['msg']=$msg;
        header("location:add_blog.php");    
    }  

}//end isset 
?>