<script type="text/javascript">
  $(document).ready(function() {
    $('#tdata').DataTable({ 
      processing: true,
      serverSide: true,
      responsive: true,
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      order: [], //init datatable not ordering
      ajax: {
        url: "<?php echo base_url('ajaxsignature') ?>",
        type: "POST",
        "data": {
            csrf_faukes: $('input[name=csrf_faukes]').val(),  //ambil nilai csrf sesuai nama token input dari .env (wajib)
        },
        "data": function(data) {
            data.csrf_faukes = $('input[name=csrf_faukes]').val() //function bridge token view to controller (wajib)
        },
        "dataSrc": function(response) {
            $('input[name=csrf_faukes]').val(response.csrf_faukes); //dataSrc untuk random request token char (wajib)
            return response.data;
        },
      },
      columnDefs: [
        { targets: 0, orderable: false}, //first column is not orderable.
      ]
    });

  });

</script>
