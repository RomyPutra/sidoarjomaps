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
			                <input type="hidden" id="id" name="id" value="<?php echo $kecamatan == null ? '' : $kecamatan['id']; ?>" /> 
	                        <div class="card-header">
				                <h3 class="card-title">Kelurahan</h3>	                            
	                        </div>
	                        <div class="card-body">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="province_id">Nama Provinsi:</label>
											<select class="form-control select2 custom-minwidth" id="province_id" name="province_id" disabled>
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
											<select class="form-control select2 custom-minwidth" id="regency_id" name="regency_id" disabled>
												<?php foreach ($kabupaten as $val):?>
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
											<label for="name">Nama Kecamatan:</label>
											<input type="text" class="form-control custom-minwidth <?=$validation->hasError('name') ? 'is-invalid' : ''?>" id="name" name="name" value="<?php echo $kecamatan == null ? old('name') : $kecamatan['name']; ?>" readonly>
											<div class="invalid-feedback">
												<?=$validation->getError('name')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="totala">Total Penduduk Semua:</label>
											<input type="number" class="form-control custom-minwidth <?=$validation->hasError('totala') ? 'is-invalid' : ''?>" id="totala" name="totala" value="<?php echo $kecamatan == null ? old('totala') : $kecamatan['totala']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('totala')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="totall">Total Penduduk Pria:</label>
											<input type="number" class="form-control custom-minwidth <?=$validation->hasError('totall') ? 'is-invalid' : ''?>" id="totall" name="totall" value="<?php echo $kecamatan == null ? old('totall') : $kecamatan['totall']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('totall')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="totalp">Total Penduduk Wanita:</label>
											<input type="number" class="form-control custom-minwidth <?=$validation->hasError('totalp') ? 'is-invalid' : ''?>" id="totalp" name="totalp" value="<?php echo $kecamatan == null ? old('totalp') : $kecamatan['totalp']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('totalp')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="luaswil">Luas Wilayah:</label>
											<input type="number" class="form-control custom-minwidth <?=$validation->hasError('luaswil') ? 'is-invalid' : ''?>" id="luaswil" name="luaswil" value="<?php echo $kecamatan == null ? old('luaswil') : $kecamatan['luaswil']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('luaswil')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="thndata">Tahun Data:</label>
											<input type="number" class="form-control custom-minwidth <?=$validation->hasError('thndata') ? 'is-invalid' : ''?>" id="thndata" name="thndata" value="<?php echo $kecamatan == null ? old('thndata') : $kecamatan['thndata']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('thndata')?>
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
