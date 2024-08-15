<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">List Kelurahan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Kelurahan</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="btn-group">
                  <!-- <a href="<?php echo base_url('kecamatan/input')?>" class="btn btn-sm custom-button">
                      Tambah Data  &nbsp;
                      <i class="fa fa-plus"></i>
                  </a> -->
                </div>
                <?php 
                  $error = session()->getFlashdata('error');
                  if (!empty($error)) 
                  { 
                    echo '<script type="text/javascript">$(document).ready(function() { Swal.fire({ toast: true, position: "top-end", showConfirmButton: false, timer: 3000, icon: "error", title: "'.$error.'", }); });</script>';
                  }

                  $success = session()->getFlashdata('success');
                  if (!empty($success)) 
                  { 
                    echo '<script type="text/javascript">$(document).ready(function() { Swal.fire({ toast: true, position: "top-end", showConfirmButton: false, timer: 3000, icon: "success", title: "'.$success.'", }); });</script>';
                  } 
                ?>
              </div>
              <div class="card-body">
                <input type="hidden" id="csrf_faukes" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> 
                <table class="table table-striped table-bordered table-hover" id="tdata">
                  <thead>
                    <tr>
                      <th><div align="center">#</div></th>
                      <th><div align="center">Provinsi</div></th>
                      <th><div align="center">Kota/Kabupaten</div></th>
                      <th><div align="center">Kecamatan</div></th>
                      <th><div align="center">Kelurahan</div></th>
                      <!-- <th width="8%"><div align="center">Aksi</div></th> -->
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
