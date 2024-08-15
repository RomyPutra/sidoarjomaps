<div class="content-wrapper" style="min-height: 577px;">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Profil Kecamatan</h1>
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
                        <div class="form-group">
                          <label for="kecamatan">Kecamatan:</label>
                          <select class="form-control select2 custom-minwidth" id="kecamatan" name="kecamatan">
                            <option value="0">Semua Kecamatan</option>
                            <?php foreach ($villages as $val):?>
                              <option value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
                            <?php endforeach;?>
                          </select>
                        </div>
                      </div>
                      <div class="card-body" style="text-align: center;">
                        <div id="map"></div>
                        <div id="detail"></div>
                      </div>
                   	</div>
                </div>
            </div>
        </div>
    </div>
</div>