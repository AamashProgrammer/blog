<?php 
// for not showing footer on  login page
$page = basename($_SERVER['PHP_SELF']);
// end 
?>

<!-- Footer -->
 <!-- for not showing footer on  login page -->
<?php if($page!="login.php"){
   echo   '<footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; |'. date('Y') .' </span>
          </div>
        </div>

      </footer>';
}
?>
<!-- Footer -->
</div>
</div>

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/ruang-admin.min.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="js/demo/chart-area-demo.js"></script>
<!--  for blog editor  -->
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
            <script>
            CKEDITOR.replace('blog');
            </script>
</body>
</html>