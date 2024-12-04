<div class="content-wrapper" style="min-height: 577px;">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Kabupaten Sidoarjo</h1>
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
                        <div id="map"></div>
                        <div>
                          <p>Kabupaten Sidoarjo memiliki luas wilayah <?php echo $kabupaten[0]->luaswil;?> km2 dengan batas-batas wilayah yaitu :</p>
                          <p>- Sebelah utara berbatasan dengan <?php echo $kabupaten[0]->btsutara;?></p>
                          <p>- Sebelah timur berbatasan dengan <?php echo $kabupaten[0]->btstimur;?></p>
                          <p>- Sebelah selatan berbatasan dengan <?php echo $kabupaten[0]->btsselatan;?></p>
                          <p>- Sebelah barat berbatasan dengan <?php echo $kabupaten[0]->btsbarat;?></p>
                          <p>Data tahun <?php echo $kabupatendtl[0]->thndata;?> menunjukkan penduduk Kabupaten Sidoarjo menurut kelompok umur dan jenis kelamin sebagai berikut :</p>
                          <table class="table table-striped table-bordered table-hover">
                            <thead>
                              <tr>
                                <th><div align="center">Kelompok Usia</div></th>
                                <th><div align="center">Jumlah Laki-laki</div></th>
                                <th><div align="center">Jumlah Perempuan</div></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($kabupatendtl as $data) :?>
                                <tr>
                                  <th><div align="left"><?php echo $data->usia;?></div></th>
                                  <th><div align="right"><?php echo number_format($data->totall);?></div></th>
                                  <th><div align="right"><?php echo number_format($data->totalp);?></div></th>
                                </tr>
                              <?php endforeach;?>
                            </tbody>
                          </table>
                          <p>Data tahun <?php echo $kabupatenjob[0]->thndata;?> menunjukkan jumlah penduduk yang bekerja :</p>
                          <table class="table table-striped table-bordered table-hover">
                            <thead>
                              <tr>
                                <?php foreach ($kabupatenjob as $data) :?>
                                  <th><div align="center">Sektor <?php echo $data->pekerjaan;?></div></th>
                                <?php endforeach;?>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <?php foreach ($kabupatenjob as $data) :?>
                                  <th><div align="right"><?php echo number_format($data->jumlah);?> jiwa.</div></th>
                                <?php endforeach;?>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                   	</div>
                </div>
            </div>
        </div>
    </div>
</div>