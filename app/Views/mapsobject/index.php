<div class="content-wrapper" style="min-height: 577px;">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Profil Obyek</h1>
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
                          <label for="obyek">Obyek:</label>
                          <div style="display: flex;">
                            <input type="text" id="obyek" name="obyek" class="form-control" style="max-width: 250px;" /> 
                            <button type="submit" class="btn green" id="btn"> <i class="fa fa-search"></i> Cari </button>
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div id="map"></div>
                      </div>
                   	</div>
                </div>
            </div>
        </div>
    </div>
</div>