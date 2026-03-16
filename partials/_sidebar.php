<?php
// query for latest blog 
$side_recent = "SELECT * FROM `blog` ORDER BY `blog`.`publish_date` DESC LIMIT 1";
$show_side_recent = mysqli_query($conn,$side_recent);
$check_side_recent = mysqli_num_rows($show_side_recent);

// query for blogs 
$side_blogs = "SELECT * FROM `blog` ORDER BY `blog`.`publish_date` DESC ";
$side_blogs_result = mysqli_query($conn,$side_blogs);
$check_side_blogs = mysqli_num_rows($side_blogs_result);

// query for categories
$category_query = "SELECT * FROM `category`";
$category_result = mysqli_query($conn,$category_query);
$check_category = mysqli_num_rows($category_result);
?>
<div class="col-lg-4">
    <div class="widget-blocks">
        <div class="row">
            </div>
            <div class="col-lg-12 col-md-6">
                <div class="widget">
                    <h2 class="section-title mb-3">Recent</h2>
                    <div class="widget-body">
                        <div class="widget-list">
                            <!-- recent blog  -->
                            <?php if($check_side_recent){
                                while($row_recent = mysqli_fetch_assoc($show_side_recent)){
                          ?>
                            <article class="card mb-4">
                                <div class="card-image">

                                    <img loading="lazy" decoding="async"
                                        src="admin/upload/<?php echo $row_recent['blog_image']; ?>" alt="Post Thumbnail"
                                        class="w-100">
                                </div>
                                <div class="card-body px-0 pb-1">
                                    <h3><a class="post-title post-title-sm" href="article.php?id=<?php echo $row_recent['blog_id']?>">
                                            <?php echo $row_recent['blog_title']; ?>
                                        </a></h3>
                                    <p class="card-text">
                                        <?php echo strip_tags(substr($row_recent['blog_body'],0,100));  ?>....
                                    </p>
                                    <div class="content"> <a class="read-more-btn" href="article.php?id=<?php echo $row_recent['blog_id']?>">Read Full
                                            Article</a>
                                    </div>
                                </div>
                            </article>
                            <?php 
                                } //end of while
                                }else{ //end of if
                                    echo "no blogs";
                                } 
                          ?>
                            <!-- side blogs  -->
                            <?php if($check_side_recent){
                                while($rows_side = mysqli_fetch_assoc($side_blogs_result)){
                          ?>

                            <a class="media align-items-center" href="article.php?id=<?php echo  $rows_side['blog_id']; ?>">
                                <img loading="lazy" decoding="async"
                                    src="admin/upload/<?php echo $rows_side['blog_image']; ?>" alt="Post Thumbnail"
                                    class="w-100">
                                <div class="media-body ml-3">
                                    <h3 style="margin-top:-5px">
                                        <?php echo $rows_side['blog_title']; ?>
                                    </h3>
                                    <p class="mb-0 small">
                                        <?php echo strip_tags(substr($rows_side['blog_body'],0,100));  ?>....</p>
                                </div>
                            </a>
                            <?php 
                                } //end of while
                                } //end of if
                          ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-6">
                <div class="widget">
                    <h2 class="section-title mb-3">Categories</h2>
                    <div class="widget-body">
                        <ul class="widget-list">
                            <?php if($check_category){
                          while($rows_category = mysqli_fetch_assoc($category_result)){
                        ?>
                            <li> <a href="categories_wise.php?id=<?php echo $rows_category['cat_id']?>"><?php echo $rows_category['cat_name']; ?></a>
                            </li>
                            <?php 
                        } //end of while
                      }else{//end of if
                        echo "no categories";
                      } 
                    ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>