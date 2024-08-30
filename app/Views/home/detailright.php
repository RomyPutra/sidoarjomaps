<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            Detail Lokasi
                        </div>
						<div class="card">
							<div class="card-body" style="display: contents;">
								<div style="margin: 10px;">
									<h3><?php echo $tempat[0]->nama;?></h3>
									<h4>Alamat: <?php echo $tempat[0]->alamat;?></h4>
									<h4><?php echo $tempat[0]->alt_name;?></h4>
									<h4>Pengurus: <?php echo $tempat[0]->namacp;?></h4>
									<h4>Nomor Pengurus: <?php echo $tempat[0]->nomorcp;?></h4>
									<?php if (isset($tempat[0]->gambar) && $tempat[0]->gambar != '') {;?>
										<img src="<?php echo base_url('public/imgmain/').$tempat[0]->gambar;?>" class="card-img-top" alt="<?php echo $tempat[0]->nama;?>" style="width: 150px; height: 150px;margin-right:15px;margin-bottom: :15px;float: right;">
									<?php } else {;?>
										<img src="<?php echo base_url('public/imgmain/no-image.png');?>" class="card-img-top" alt="No Image" style="width: 150px; height: 150px;margin-right:15px;margin-bottom: :15px;float: right;">
									<?php };?>
									<p style="text-align: justify;"><?php echo $tempat[0]->profile;?></p>
								</div>
								<div style="margin: 10px;">
								    <?php if (isset($dtltempat) && ($dtltempat[0]->dtlimages !== null || trim((string)$dtltempat[0]->dtlimages) !== '')) {?>
										<!-- Main-Slideelement -->
										<div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
										  <div class="carousel-inner">
							                <?php 
							                    $index = 0; 
							                    foreach ($dtltempat as $dtl) {
							                        if ($index === 0) {
							                ?>
							                    <div class="carousel-item active">
											      	<img class="d-block" src="<?php echo base_url('public/imgdtl/').$dtl->dtlimages;?>" alt="Slide" style="width: 350px; height: 350px;">
							                    </div>
							                <?php } else { ?>
							                    <div class="carousel-item">
											      	<img class="d-block" src="<?php echo base_url('public/imgdtl/').$dtl->dtlimages;?>" alt="Slide" style="width: 350px; height: 350px;">
							                    </div>
							                <?php } $index++; } ?>
										  </div>
										</div>
										<!-- Main-Slider-Element ends -->
										<!-- Thumb-Slider-Element starts -->
										<div id="thumbSlider" class="carousel slide" data-interval="false">
										  <div class="carousel-inner">
										    <div class="carousel-item active">
										      <div class="row justify-content-center">
								                <?php 
								                    $index = 0; 
								                    foreach ($dtltempat as $dtl) {
								                        if ($index === 0) {
								                ?>
											        <div data-target="#myCarousel" data-slide-to="<?php echo $index;?>" class="thumb col-sm-2 active">
											          <img src="<?php echo base_url('public/imgdtl/').$dtl->dtlimages;?>" alt="XZ">
											        </div>
								                <?php } else { ?>
											        <div data-target="#myCarousel" data-slide-to="<?php echo $index;?>" class="thumb col-sm-2">
											          <img src="<?php echo base_url('public/imgdtl/').$dtl->dtlimages;?>" alt="XZ">
											        </div>
								                <?php } $index++; } ?>
										      </div>
										    </div>
										  </div>										  
										</div>
										<!-- Thumb-Slider-Element ends -->
								    <?php } ?>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
