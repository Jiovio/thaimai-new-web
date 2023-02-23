            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://jiovio.com/" target="_blank" class="footer-link fw-bolder">JioVio HealthCare Pvt Ltd</a>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>
	
    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/custom.js"></script>
<script src="../assets/js/validate.js"></script>
<script>
     setTimeout(() => {
     var divBox = document.getElementById('response');
     divBox.style.display = 'none';
     }, 5000); 
   </script>
    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
   <script>
          $(document).ready(function() {
              var $bpSys = $(".50-200");
    for (i=50;i<=200;i++){
        $bpSys.append($('<option></option>').val(i).html(i))
    }
    
    var $bpDia = $(".40-150");
    for (i=40;i<=150;i++){
        $bpDia.append($('<option></option>').val(i).html(i))
    }
    var $ancPeriod = $(".1-15");
    for (i=1;i<=15;i++){
        $ancPeriod.append($('<option></option>').val(i).html(i))
    }
    var $a = $(".1-50");
    for (i=1;i<=50;i++){
        $a.append($('<option></option>').val(i).html(i))
    }
    var $b = $(".60-400");
    for (i=60;i<=400;i++){
        $b.append($('<option></option>').val(i).html(i))
    }
          });
          </script>
<!-- Select PICME Number -->
<script src="../forms/datatables/ajax_googleapis_jquery_2.1.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


  </body>
</html>
