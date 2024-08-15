<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $kecamatan == null ? 'Add' : 'Edit'; ?> Kelurahan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('kecamatan');?>">Kelurahan</a></li>
                        <li class="breadcrumb-item active"><?php echo $kecamatan == null ? 'Add' : 'Edit'; ?></li>
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
						<form action="<?php echo base_url('kecamatan/store');?>" method="post" enctype="multipart/form-data">
			                <input type="hidden" id="csrf_faukes" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> 
			                <input type="hidden" id="kode" name="kode" value="<?php echo $kecamatan == null ? '' : $kecamatan['kode']; ?>" /> 
	                        <div class="card-header">
				                <h3 class="card-title">Kelurahan</h3>	                            
	                        </div>
	                        <div class="card-body">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="province_id">Nama Provinsi:</label>
											<select class="form-control select2 custom-minwidth" id="province_id" name="province_id">
												<?php foreach ($provinces as $val):?>
												  <option <?php echo (($kecamatan == null ? old('province_id') : $kecamatan['province_id']) == $val['id']) ? 'selected' : '';?> value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
												<?php endforeach;?>
											</select>
											<div class="invalid-feedback">
												<?=$validation->getError('province_id')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="regency_id">Nama Kota/Kabupaten:</label>
											<select class="form-control select2 custom-minwidth" id="regency_id" name="regency_id">
												<?php foreach ($provinces as $val):?>
												  <option <?php echo (($kecamatan == null ? old('regency_id') : $kecamatan['regency_id']) == $val['id']) ? 'selected' : '';?> value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
												<?php endforeach;?>
											</select>
											<div class="invalid-feedback">
												<?=$validation->getError('regency_id')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="district_id">Nama Kecamatan:</label>
											<select class="form-control select2 custom-minwidth" id="district_id" name="district_id">
												<?php foreach ($provinces as $val):?>
												  <option <?php echo (($kecamatan == null ? old('district_id') : $kecamatan['district_id']) == $val['id']) ? 'selected' : '';?> value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
												<?php endforeach;?>
											</select>
											<div class="invalid-feedback">
												<?=$validation->getError('district_id')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="kelurahan">Nama Kelurahan:</label>
											<input type="text" class="form-control custom-minwidth <?=$validation->hasError('kelurahan') ? 'is-invalid' : ''?>" id="kelurahan" name="kelurahan" value="<?php echo $kecamatan == null ? old('kelurahan') : $kecamatan['kelurahan']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('kelurahan')?>
											</div>
										</div>
									</div>
								</div>
								<input type="submit" class="btn custom-button" value="Submit" />
								<a class="btn btn-danger" href="<?php echo base_url('kecamatan');?>">Cancel</a>
	                        </div>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
