<?php
include 'partials/_header.php';
// for stop smtp warning 
error_reporting(0);
?>

<main>
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumbs mb-4"> <a href="index.php">Home</a>
                        <span class="mx-1">/</span> Contact
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="pr-0 pr-lg-4">
                        <div class="content">For more info contact with us
                            <div class="mt-5">
                                <p class="h3 mb-3 font-weight-normal"><a class="text-dark"
                                        href="mailto:hello@reporter.com">abc@xyz.com</a>
                                </p>
                                <p class="mb-3"><a class="text-dark" href="tel:&#43;123456789">&#43;123456789</a>
                                </p>
                                <p class="mb-2">782 abc Apt. MG C3G8A4</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <form method="POST" action="" class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control mb-4" placeholder="Name" name="name" id="name"
                                required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control mb-4" placeholder="Email" name="email" id="email"
                                required>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control mb-4" placeholder="Subject" name="subject"
                                id="subject" required>
                        </div>
                        <div class="col-12">
                            <textarea name="message" id="message" class="form-control mb-4"
                                placeholder="Type You Message Here" rows="5" required></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-outline-primary" name="send_btn" type="submit">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>




<?php
// for send email 
if(isset($_POST['send_btn'])){
	// for admin email 
	$sql = "SELECT user.email FROM user WHERE user.role = '1'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);  
	$to = $row[0];

  // from user to website
  $name = $_POST['name'];
  $sender = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];
  $header = "From: $sender";   
  
  
  if(mail($to,$subject,$message,$header)){
     echo "email has been sent";
  }else{

    ?>
<div class="alert alert-danger alert-dismissible col-6 mx-auto" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
	This website is on local server
</div>

<?php
  }

}


include 'partials/_footer.php';


?>