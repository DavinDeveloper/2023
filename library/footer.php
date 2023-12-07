  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span><a href="https://davinwardana.com/" target="_BLANK">Davin Wardana</a></span></strong>. All Rights Reserved
    </div>
    <!--<div class="credits">-->
    <!--  Designed by <a href="https://davinwardana.com/" target="_BLANK">Davin Wardana</a>-->
    <!--</div>-->
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<? echo $cf['url']; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<? echo $cf['url']; ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<? echo $cf['url']; ?>assets/vendor/tinymce/tinymce.min.js"></script>
<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        }
    }
    function showPosition(position) {
        document.querySelector(".needs-validation input[name=\'latitude\']").value = position.coords.latitude;
        document.querySelector(".needs-validation input[name=\'longitude\']").value = position.coords.longitude;
    }
    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert("Allow your location for next.");
                location.reload();
                break;
        }
    }
</script>
  <!-- Template Main JS File -->
  <? if (!empty($js)) { echo $js; } ?>
  <? if (!empty($pr)) { ?>
  <script>
    setInterval(function(){
        location.reload();
    }, <?php echo $pr*1000; ?>);
  </script>
  <? } ?>
<? if ($_SESSION['chat'] == TRUE) { ?>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/653e895aa84dd54dc4866997/1hdu4h3cv';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<? } ?>
<script src="<? echo $cf['url']; ?>assets/js/main.js"></script>
</body>

</html>