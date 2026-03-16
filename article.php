<?php
include 'partials/_header.php';

// for get id 
if(isset($_GET['id'])){
    $blog_id = $_GET['id'];
    $show_blog = "SELECT * FROM `blog` LEFT JOIN category ON blog.category = category.cat_id LEFT JOIN user ON blog.author_id = user.user_id WHERE blog.blog_id = '$blog_id'";
    $show_result = mysqli_query($conn,$show_blog);
    $check = mysqli_num_rows($show_result);
}
?>

<main>
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <?php
                    if($check>0){
                        while($row= mysqli_fetch_assoc($show_result)){
                        ?>
                    <article>
                        <img loading="lazy" decoding="async" src="admin/upload/<?php echo $row['blog_image']; ?>" alt="Post Thumbnail"
                            class="w-100">
                        <ul class="post-meta mb-2 mt-4">
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    style="margin-right:5px;margin-top:-4px" class="text-dark" viewBox="0 0 16 16">
                                    <path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
                                    <path
                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                                    <path
                                        d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
                                </svg> <span> <?php echo date('d-M-Y', strtotime($row['publish_date'])); ?>
                                </span>
                            </li>
                        </ul>
                        <h1 class="my-3"><?php echo $row['blog_title']; ?></h1>
                        <ul class="post-meta mb-4">
                            <li>  <a href="categories_wise.php?id=<?php echo $row['cat_id']?>"><?php echo $row['cat_name']; ?></a>
                            </li>
                        </ul>
                        <div class="content text-left">
                            <h1 id="heading">Blog</h1>
                            <p><?php echo $row['blog_body']; ?></p>

                            <hr>
                            <h2 id="youtube-video">Youtube video</h2>
                            <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                                <iframe src="https://www.youtube-nocookie.com/embed/DDpXdljhstg"
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border:0;"
                                    allowfullscreen title="YouTube Video"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </article>
                    <?php    }// end of while
                    } //end of if
                
                    
                    ?>



                </div>
                <!-- for sidebar  -->
                <?php include 'partials/_sidebar.php';?>
                <!-- end  -->
            </div>
        </div>
    </section>
</main>

<?php
include 'partials/_footer.php';
?>