<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $kecamatandtl == null ? 'Add' : 'Edit'; ?> Kecamatan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('kecamatanjob');?>">Kecamatan</a></li>
                        <li class="breadcrumb-item active"><?php echo $kecamatandtl == null ? 'Add' : 'Edit'; ?></li>
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
						<form action="<?php echo base_url('kecamatanjob/store');?>" method="post" enctype="multipart/form-data">
			                <input type="hidden" id="csrf_faukes" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> 
			                <input type="hidden" id="id" name="id" value="<?php echo $kecamatandtl == null ? '' : $kecamatandtl['id']; ?>" /> 
	                        <div class="card-header">
				                <h3 class="card-title">Kecamatan</h3>	                            
	                        </div>
	                        <div class="card-body">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="district_id">Nama Kecamatan:</label>
											<select class="form-control select2 custom-minwidth" id="district_id" name="district_id" <?php echo $kecamatandtl == null ? '' : 'disabled'; ?>>
												<?php foreach ($kecamatan as $val):?>
												  <option <?php echo (($kecamatandtl == null ? old('district_id') : $kecamatandtl['district_id']) == $val['id']) ? 'selected' : '';?> value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
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
											<label for="pendidikan">Pendidikan:</label>
											<input type="text" class="form-control custom-minwidth <?=$validation->hasError('pendidikan') ? 'is-invalid' : ''?>" id="pendidikan" name="pendidikan" value="<?php echo $kecamatandtl == null ? old('pendidikan') : $kecamatandtl['pendidikan']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('pendidikan')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="thndata">Tahun Data:</label>
											<input type="number" class="form-control custom-minwidth <?=$validation->hasError('thndata') ? 'is-invalid' : ''?>" id="thndata" name="thndata" value="<?php echo $kecamatandtl == null ? old('thndata') : $kecamatandtl['thndata']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('thndata')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="jumlah">Jumlah Pekerja:</label>
											<input type="number" class="form-control custom-minwidth <?=$validation->hasError('jumlah') ? 'is-invalid' : ''?>" id="jumlah" name="jumlah" value="<?php echo $kecamatandtl == null ? old('jumlah') : $kecamatandtl['jumlah']; ?>" step=".01">
											<div class="invalid-feedback">
												<?=$validation->getError('jumlah')?>
											</div>
										</div>
									</div>
								</div>
								<input type="submit" class="btn custom-button" value="Submit" />
								<a class="btn btn-danger" href="<?php echo base_url('kecamatanjobedu');?>">Cancel</a>
	                        </div>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
