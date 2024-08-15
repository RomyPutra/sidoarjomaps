<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $lokasi == null ? 'Add' : 'Edit'; ?> Obyek</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('obyek');?>">Obyek</a></li>
                        <li class="breadcrumb-item active"><?php echo $lokasi == null ? 'Add' : 'Edit'; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
						<form action="<?php echo base_url('obyek/store');?>" method="post" enctype="multipart/form-data">
			                <input type="hidden" id="csrf_faukes" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> 
			                <input type="hidden" id="kode" name="kode" value="<?php echo $lokasi == null ? '' : $lokasi['kode']; ?>" /> 
	                        <div class="card-header">
				                <h3 class="card-title">Obyek</h3>
	                        </div>
	                        <div class="card-body">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="nama">Nama Obyek:</label>
											<input type="text" class="form-control custom-minwidth <?=$validation->hasError('nama') ? 'is-invalid' : ''?>" id="nama" name="nama" value="<?php echo $lokasi == null ? old('nama') : $lokasi['nama']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('nama')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="alamat">Alamat Obyek:</label>
											<input type="text" class="form-control custom-minwidth <?=$validation->hasError('alamat') ? 'is-invalid' : ''?>" id="alamat" name="alamat" value="<?php echo $lokasi == null ? old('alamat') : $lokasi['alamat']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('alamat')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="namacp">Contact Person:</label>
											<input type="text" class="form-control custom-minwidth <?=$validation->hasError('namacp') ? 'is-invalid' : ''?>" id="namacp" name="namacp" value="<?php echo $lokasi == null ? old('namacp') : $lokasi['namacp']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('namacp')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="nomorcp">Nomor Telp/WA:</label>
											<input type="text" class="form-control custom-minwidth <?=$validation->hasError('nomorcp') ? 'is-invalid' : ''?>" id="nomorcp" name="nomorcp" value="<?php echo $lokasi == null ? old('nomorcp') : $lokasi['nomorcp']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('nomorcp')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="kd_kat">Kategori:</label>
											<select class="form-control select2 custom-minwidth" id="kd_kat" name="kd_kat">
												<?php foreach ($kategori as $val):?>
												  <option <?php echo (($lokasi == null ? old('kd_kat') : $lokasi['kd_kat']) == $val['kode']) ? 'selected' : '';?> value="<?php echo $val['kode'];?>"><?php echo $val['kategori'];?></option>
												<?php endforeach;?>
											</select>
											<div class="invalid-feedback">
												<?=$validation->getError('kd_kat')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="kd_desa">Kelurahan:</label>
											<select class="form-control select2 custom-minwidth" id="kd_desa" name="kd_desa">
												<?php foreach ($desa as $val):?>
												  <option <?php echo (($lokasi == null ? old('kd_desa') : $lokasi['kd_desa']) == $val['id']) ? 'selected' : '';?> value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
												<?php endforeach;?>
											</select>
											<div class="invalid-feedback">
												<?=$validation->getError('kd_desa')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="latitude">Titik Latitude:</label>
											<input type="text" class="form-control custom-minwidth <?=$validation->hasError('latitude') ? 'is-invalid' : ''?>" id="latitude" name="latitude" value="<?php echo $lokasi == null ? old('latitude') : $lokasi['latitude']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('latitude')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="longitude">Titik Longitude:</label>
											<input type="text" class="form-control custom-minwidth <?=$validation->hasError('longitude') ? 'is-invalid' : ''?>" id="longitude" name="longitude" value="<?php echo $lokasi == null ? old('longitude') : $lokasi['longitude']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('longitude')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="profile">Profile Lokasi:</label>
											<?php $profileValue = $lokasi === null ? old('profile') : $lokasi['profile'];?>
											<textarea rows="4" cols="" class="form-control custom-minwidth <?=$validation->hasError('profile') ? 'is-invalid' : ''?>" id="profile" name="profile"><?php echo htmlspecialchars($profileValue, ENT_QUOTES, 'UTF-8'); ?></textarea>
											<div class="invalid-feedback">
												<?=$validation->getError('profile')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="images">Gambar Obyek:</label>
											<div class="input-group">
												<input type="file" class="custom-file-input custom-minwidth <?=$validation->hasError('images') ? 'is-invalid' : ''?>" id="images" name="images" accept=".png">
												<label class="custom-file-label" for="images">Choose file</label>
												<div class="invalid-feedback">
													<?=$validation->getError('images')?>
												</div>
											</div>
											<p class="upload-note">Pilih file dengan format png.</p>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="template">Template Detail:</label>
											<select class="form-control select2 custom-minwidth" id="template" name="template" data-dynamic-select>
												<option <?php echo (($lokasi == null ? old('template') : $lokasi['template']) == 1) ? 'selected' : '';?> data-img="<?php echo base_url('public/optionimg/float-left-svgrepo-com.svg');?>" value="1">Gambar Rata Kiri</option>
												<option <?php echo (($lokasi == null ? old('template') : $lokasi['template']) == 2) ? 'selected' : '';?> data-img="<?php echo base_url('public/optionimg/float-right-svgrepo-com.svg');?>" value="2">Gambar Rata Kanan</option>
												<option <?php echo (($lokasi == null ? old('template') : $lokasi['template']) == 3) ? 'selected' : '';?> data-img="<?php echo base_url('public/optionimg/top-center-svgrepo-com.svg');?>" value="3">Gambar Ditengah Atas</option>
												<option <?php echo (($lokasi == null ? old('template') : $lokasi['template']) == 3) ? 'selected' : '';?> data-img="<?php echo base_url('public/optionimg/mid-center-svgrepo-com.svg');?>" value="3">Gambar Ditengah Tengah</option>
											</select>
											<div class="invalid-feedback">
												<?=$validation->getError('template')?>
											</div>
										</div>
									</div>
								</div>
								<input type="submit" class="btn custom-button" value="Submit" />
								<a class="btn btn-danger" href="<?php echo base_url('obyek');?>">Cancel</a>
	                        </div>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
