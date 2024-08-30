<div class="content-wrapper" style="min-height: 577px;">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Profil Kategori per Kecamatan</h1>
            </div>
            <div class="col-sm-6">
            </div>
         </div>
      </div>
   </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <input type="hidden" id="csrf_faukes" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> 
                        <div class="katkec">
                          <div class="form-group">
                            <label for="kecamatan">Kecamatan:</label>
                            <select class="form-control select2 custom-minwidth" id="kecamatan" name="kecamatan">
                              <option value="0">Semua Kecamatan</option>
                              <?php foreach ($villages as $val):?>
                                <option value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
                              <?php endforeach;?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="kategori">Kategori:</label>
                            <select class="form-control select2 custom-minwidth" id="kategori" name="kategori">
                              <option value="0">Semua Kategori</option>
                              <?php foreach ($kategori as $val):?>
                                <option value="<?php echo $val->kode;?>"><?php echo $val->kategori;?></option>
                              <?php endforeach;?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div id="map"></div>
                        <div id="detail" style="text-align: justify;"></div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>