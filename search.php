<?php
include 'partials/_header.php';

// query for search 
$show_blogs = "SELECT * FROM `blog` LEFT JOIN category ON blog.category = category.cat_id LEFT JOIN user ON blog.author_id = user.user_id WHERE blog.blog_title LIKE '%$search%' or blog.blog_body LIKE '%$search%' or category.cat_name LIKE '%$search%'  ORDER BY `blog`.`publish_date` DESC ";
$show_blogs_result = mysqli_query($conn,$show_blogs);
$check_blogs = mysqli_num_rows($show_blogs_result);
?>

<!-- main  -->
<main>
    <section class="section">
        <div class="container">
            <div class="row no-gutters-lg">
                <div class="col-12">
                    <h2 class="section-title">Search result for:  <?php echo $search ?></h2>
                </div>
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="row">

                        <!-- col-md-6 blog start  -->
                        <?php
                        //  blog checking 
                        if($check_blogs>0){ 
                            while($blog_rows=mysqli_fetch_assoc($show_blogs_result)){
                          ?>
                        <div class="col-md-6 mb-4">
                            <article class="card article-card article-card-sm h-100">
                                <a href="article.php?id=<?php echo  $blog_rows['blog_id']; ?>">
                                    <div class="card-image">
                                        <div class="post-info"> <span
                                                class="text-uppercase"><?php echo date('d-M-Y', strtotime($blog_rows['publish_date'])); ?></span>
                                        </div>
                                        <img loading="lazy" decoding="async"
                                            src="admin/upload/<?php echo $blog_rows['blog_image']; ?>"
                                            alt="Post Thumbnail" class="image-fluid">
                                    </div>
                                </a>
                                <div class="card-body px-0 pb-0">
                                    <ul class="post-meta mb-2">
                                        <li>
                                            <a
                                                href="categories_wise.php?id=<?php echo $blog_rows['cat_id']?>"><?php echo $blog_rows['cat_name'];  ?></a>
                                            <span><?php echo "Post by ". $blog_rows['username'];  ?></span>
                                        </li>
                                    </ul>
                                    <h2><a class="post-title"
                                            href="article.php?id=<?php echo  $blog_rows['blog_id']; ?>">
                                            <?php echo $blog_rows['blog_title'];  ?>
                                        </a></h2>
                                    <p class="card-text">
                                        <?php echo strip_tags(substr($blog_rows['blog_body'],0,200));  ?>
                                        ...</p>
                                    <div class="content"> <a class="read-more-btn"
                                            href="article.php?id=<?php echo  $blog_rows['blog_id']; ?>">Read Full
                                            Article</a>
                                    </div>
                                </div>
                            </article>
                            <!-- col-6 blog end  -->
                        </div>
                        <?php
                            }//while end
                        }else{// if end
                            echo "<h2>No BLogs</h2>";
                        }  
                        ?>
                        <!-- row end  -->
                    </div>
                    <!-- col-lg-8 end -->
                </div>
                <!-- sidebar  -->
                <?php include 'partials/_sidebar.php';?>
                <!-- end  -->

                <!-- row end  -->
            </div>
            <!-- container end  -->
        </div>
    </section>
</main>
<!-- main end  -->
<?php
include 'partials/_footer.php';
?>