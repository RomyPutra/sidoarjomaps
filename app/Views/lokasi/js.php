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
        url: "<?php echo base_url('ajaxlokasi') ?>",
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

    $('#province_id').change(function(){
      if ($('#province_id option:selected').val() !== '')
      {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('ajaxdropkota') ?>/"+$('#province_id option:selected').val(),
            dataType:"json",//return type expected as json
            success: function(response){
              var html = '<option value="">Pilih Kota/Kabupaten</option>';
              var i;
              for(i=0; i<response.kabupaten.length; i++){
                  html += '<option value='+response.kabupaten[i].id+'>'+response.kabupaten[i].name+'</option>';
              }
              $('#regency_id').html(html);
            },
        });
      }
      else
      {
        var html = '<option value="">Pilih Kota/Kabupaten</option>';
        var i;
        $('#regency_id').html(html);
      }
    });

    $('#regency_id').change(function(){
      if ($('#regency_id option:selected').val() !== '')
      {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('ajaxdropkecamatan') ?>/"+$('#regency_id option:selected').val(),
            dataType:"json",//return type expected as json
            success: function(response){
              var html = '<option value="">Pilih Kecamatan</option>';
              var i;
              for(i=0; i<response.kota.length; i++){
                  html += '<option value='+response.kota[i].id+'>'+response.kota[i].name+'</option>';
              }
              $('#district_id').html(html);
            },
        });
      }
      else
      {
        var html = '<option value="">Pilih Kecamatan</option>';
        var i;
        $('#district_id').html(html);
      }
    });

    $('#images').on('change',function(){
      //get the file name
      var fileName = $(this).val();
      //replace the "Choose a file" label
      $(this).siblings('.custom-file-label').html(fileName);
    });

    var idlokasi = $('#idlokasi').val();
    $('#tdatadtl').DataTable({ 
      processing: true,
      serverSide: true,
      responsive: true,
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      order: [], //init datatable not ordering
      ajax: {
        url: "<?php echo base_url('ajaxlokasidtl') ?>/"+idlokasi,
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

    $('#fileimages').on('change',function(){
      //get the file name
      var fileName = $(this).val();
      //replace the "Choose a file" label
      $(this).siblings('.custom-file-label').html(fileName);
    });

  });

</script>
