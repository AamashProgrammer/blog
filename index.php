<?php
include 'partials/_header.php';


// pagintaion 
if(!isset($_GET['page'])){
	$page=1;
}else{
	$page=$_GET['page'];
}
$limit = 4;
$offset = ($page-1) * $limit;
// ************

// query for latest blog 
$show_latest = "SELECT * FROM `blog` LEFT JOIN category ON blog.category = category.cat_id LEFT JOIN user ON blog.author_id = user.user_id ORDER BY `blog`.`publish_date` DESC LIMIT 1";
$show_latest_result = mysqli_query($conn,$show_latest);
$check_latest = mysqli_num_rows($show_latest_result);

// query for blogs 
$show_blogs = "SELECT * FROM `blog` LEFT JOIN category ON blog.category = category.cat_id LEFT JOIN user ON blog.author_id = user.user_id ORDER BY `blog`.`publish_date` DESC LIMIT $offset,$limit ";
$show_blogs_result = mysqli_query($conn,$show_blogs);
$check_blogs = mysqli_num_rows($show_blogs_result);
?>

<!-- main  -->
<main>
    <section class="section">
        <div class="container">
            <div class="row no-gutters-lg">
                <div class="col-12">
                    <h2 class="section-title">Latest Article</h2>
                </div>
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="row">
                        <!-- for latest post  -->
                        <?php
                        // blog checking
                        if($check_latest>0){ 
                            while($rows=mysqli_fetch_assoc($show_latest_result)){
                          ?>
                        <div class="col-12 mb-4">
                            <article class="card article-card">
                                <a href="article.php?id=<?php echo  $rows['blog_id']; ?>">
                                    <div class="card-image">
                                        <div class="post-info"> <span class="text-uppercase">
                                                <?php echo date('d-M-Y', strtotime($rows['publish_date'])); ?>
                                            </span>
                                        </div>
                                        <img loading="lazy" decoding="async"
                                            src="admin/upload/<?php echo $rows['blog_image']; ?>" alt="Post Thumbnail"
                                            class="w-100">
                                    </div>
                                </a>
                                <div class="card-body px-0 pb-1">
                                    <ul class="post-meta mb-2">
                                        <li> <a
                                                href="categories_wise.php?id=<?php echo $rows['cat_id']?>"><?php echo $rows['cat_name'];  ?></a>
                                            <span><?php echo "Post by ". $rows['username'];  ?></span>
                                        </li>
                                    </ul>
                                    <h2 class="h1"><a class="post-title"
                                            href="article.php?id=<?php echo  $rows['blog_id']; ?>">
                                            <?php echo $rows['blog_title'];  ?>
                                        </a></h2>
                                    <p class="card-text">
                                        <?php echo strip_tags(substr($rows['blog_body'],0,200));  ?>....</p>
                                    <div class="content"> <a class="read-more-btn"
                                            href="article.php?id=<?php echo  $rows['blog_id']; ?>">Read Full article</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <?php
                            }//while end
                        }// if end
                           
                        ?>
                        <!-- col-md-6 blog start  -->
                        <?php
                        // checking blog 
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

                <!-- pagination -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <nav class="mt-4">
                                <nav class="mb-md-50">
                                    <ul class="pagination justify-content-center">
                                        <!-- *******************paginaion*************** -->
                                        <?php
				$pagination = "SELECT * FROM blog";
				$run_query = mysqli_query($conn,$pagination);
				$total_posts = mysqli_num_rows($run_query);
				$pages = ceil($total_posts/$limit);
                // previous link
                if($page>1 && $total_posts>$limit){ ?>
                                        <li class="page-item">
                                            <a class="page-link" href="index.php?page=<?php echo ($page-1) ?>"
                                                aria-label="Pagination Arrow">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                                    fill="currentColor" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                                                </svg>
                                            </a>
                                        </li>
                                        <?php } 
                // previuos link end  
                	for($i=1; $i<=$pages; $i++){
					// for active 
                    if($page==$i){
                        $active = "active";
                    }else{  
                        $active = "";
                    }
                    // end 
                    ?>

                                        <li class="page-item  <?php echo $active ?>">
                                            <a href="index.php?page=<?php echo $i ?>"
                                                class="page-link"><?php echo $i ?></a>
                                        </li>

                                        <?php
					}
                    // for next link 
                    if($page!=$pages && $total_posts>$limit){ ?>
                                        <li class="page-item">
                                            <a class="page-link" href="index.php?page=<?php echo ($page+1) ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                                    fill="currentColor" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                                                </svg>
                                            </a>
                                        </li>
                                        <?php } 
                                        
                    // next link end 
                                        ?>
                                        <!-- ******************************************* -->
                                    </ul>
                                </nav>
                            </nav>
                        </div>
                    </div>
                    <!-- pagination div end  -->
                </div>
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