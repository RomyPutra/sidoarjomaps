<div class="modal fade" id="modal-preview" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">File Preview</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe id="filepath" width="100%" height="600px"></iframe>
      </div>
      <!-- <div class="modal-footer justify-content-between">
        <a id="downloadbtn" class="btn custom-button btn-sm" title="Download"><i class="fa fa-download"></i> Download</a>
      </div> -->
    </div>
  </div>
</div>
<?php 
if(isset($grafik)){
  if(count($grafik) > 0){
    foreach($grafik as $data){
        $total[] = $data['total'];
        $month[] = $data['month'];
    }
  }
}

?>
<aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>

<footer class="main-footer">
    <strong>Copyright &copy; <?php echo date("Y");?> - <?=APP_DESC;?></strong>
</footer>
</div>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
<!-- jQuery, Popper.js, and Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="<?php echo base_url('adminlte/plugins'); ?>/moment/moment.min.js"></script>
<script src="<?php echo base_url('adminlte/plugins'); ?>/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url('adminlte/plugins'); ?>/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url('adminlte/plugins'); ?>/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('adminlte/plugins'); ?>/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('adminlte/plugins'); ?>/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url('adminlte/plugins'); ?>/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url('adminlte/plugins'); ?>/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('adminlte/plugins'); ?>/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url('adminlte/plugins'); ?>/jszip/jszip.min.js"></script>
<script src="<?php echo base_url('adminlte/plugins'); ?>/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url('adminlte/plugins'); ?>/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url('adminlte/plugins'); ?>/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url('adminlte/plugins'); ?>/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url('adminlte/plugins'); ?>/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url('adminlte/plugins'); ?>/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script src="<?php echo base_url('adminlte/plugins'); ?>/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url('adminlte/plugins'); ?>/toastr/toastr.min.js"></script>
<script src="<?php echo base_url('adminlte/plugins'); ?>/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url('optionimg'); ?>/DynamicSelect.js"></script>
<!--fullcalendar plugin files -->
<script src="<?php echo base_url('fullcalendar'); ?>/fullcalendar.js"></script>
<script src="<?php echo base_url('adminlte/dist'); ?>/js/adminlte.min.js"></script>
<!-- <script src="<?php echo base_url('adminlte/dist'); ?>/js/filter.js"></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly" defer></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBacRkkOEw6FVQbABp8oriLkZn0hf2GpBU&callback=initMap" defer></script> -->
<!-- <script>
  (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
    key: "AIzaSyBacRkkOEw6FVQbABp8oriLkZn0hf2GpBU",
    v: "weekly",
    // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
    // Add other bootstrap parameters as needed, using camel case.
  });
</script>
 -->
<?php if (isset($jscript)) { echo view($jscript); }?>

<script type="text/javascript">
  $(document).ready(function() {
    $("#thumbSlider .thumb").on("click", function(){
      $(this).addClass("active");
      $(this).siblings().removeClass("active");    
    });

    $(".select2").select2();
 
    // updateNotificationCount();
    // // Periodically update notification count every 30 seconds
    // setInterval(updateNotificationCount, 30000);
  });
  $(function(){
    /** add active class and stay opened when selected */
    var url = window.location.href;

    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
      // if(url.indexOf(this.href) != -1){
      if(url == this.href){
        return true;
      }
      // return this.href == url;
    }).addClass('active');

    // for treeview
    $('ul.nav-treeview a').filter(function() {
      // if(url.indexOf(this.href) != -1){
      if(url == this.href){
        return true;
      }
      // return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');  
  });

  $('.nilai').blur(function () {
    var $this = $(this);
    if ($this.val() == "" || $this.val() < 0) {
      $this.val(0);
    }
  });

  //Mengisi Tahun Ajaran otomatis
  var currentDate = new Date();
  if ((currentDate.getMonth() + 1) <= 6)
  {
    $('#tahunajaran').val((currentDate.getFullYear()-1)+'-'+currentDate.getFullYear());
  }
  else 
  {
    $('#tahunajaran').val(currentDate.getFullYear()+'-'+(currentDate.getFullYear()+1));
  }

  // Notification
  function updateNotificationCount() {
      // Send AJAX request to server endpoint
      $.ajax({
          url: '<?php echo base_url('getnotif') ?>', // Replace with your server endpoint
          method: 'POST',
          dataType:"json",//return type expected as json
          success: function(response) {
            // Update notification count in the navbar
            // $('#notification-count').text(response.message);
            if (response.recordsTotal > 0)
            {
              $('#notification-count').text(response.recordsTotal);
              $('.circle').css('background-color', '#dc3545');
            } else {
              $('#notification-count').text(0);
              $('.circle').css('background-color', '#fff');
            }

          }
      });
  }

  function isNullOrEmpty(value) {
    return value === null || value === undefined || (typeof value === 'string' && value.trim() === '');
  }

  function truncateString(str, length) {
      if (str.length > length) {
          return str.substring(0, length) + '...';
      }
      return str;
  }
</script>
<?php 
$bulan = "";
$totals = 0;

if(isset($grafik)){
  if(count($grafik) > 0){
    $bulan = json_encode($month);
    $totals = json_encode($total);
  }
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<script>
var chart = document.getElementById("myChart").getContext('2d');
var areaChart = new Chart(chart, {
  type: 'bar',
  data: {
    labels: <?php echo $bulan; ?>,
    datasets: [
      {
        label: "Grafik Penjualan",
        data: <?php echo $totals; ?>,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 255, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 255, 255, 1)',
          'rgba(255, 159, 64, 1)',
        ],
        borderWidth: 1
      }
    ]
  },
  options: {
    scales: {
      yAxes: [
        {
          ticks: {
            beginZero: true
          }
        }
      ]
    }
  }
});
</script>
<?php } ?>
</body>
</html>