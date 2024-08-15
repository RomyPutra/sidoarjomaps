<div class="content-wrapper" style="min-height: 577px;">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Profil Kategori</h1>
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
                          <label for="kategori">Kategori:</label>
                          <select class="form-control select2 custom-minwidth" id="kategori" name="kategori">
                            <option value="0">Semua Kategori</option>
                            <?php foreach ($kategori as $val):?>
                              <option value="<?php echo $val->kode;?>"><?php echo $val->kategori;?></option>
                            <?php endforeach;?>
                          </select>
                        </div>
                      </div>
                      <div class="card-body">
                        <p>MetaPolije Kabupaten Sidoarjo mengakomodir gambaran profil obyek yang terbagi menjadi <?php $idx = 0; foreach ($kategori as $val): if ($idx === 0) { echo $val->jumlah.' obyek '.$val->kategori; } else { echo ', '.$val->jumlah.' obyek '.$val->kategori; }; $idx++; endforeach;?></p>
                        <div id="map"></div>
                      </div>
                   	</div>
                </div>
            </div>
        </div>
    </div>
</div>