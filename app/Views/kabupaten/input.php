<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $kabupaten == null ? 'Add' : 'Edit'; ?> Kabupaten</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('kabupaten');?>">Kabupaten</a></li>
                        <li class="breadcrumb-item active"><?php echo $kabupaten == null ? 'Add' : 'Edit'; ?></li>
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
						<form action="<?php echo base_url('kabupaten/store');?>" method="post" enctype="multipart/form-data">
			                <input type="hidden" id="csrf_faukes" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> 
			                <input type="hidden" id="id" name="id" value="<?php echo $kabupaten == null ? '' : $kabupaten['id']; ?>" /> 
	                        <div class="card-header">
				                <h3 class="card-title">Kabupaten</h3>	                            
	                        </div>
	                        <div class="card-body">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="province_id">Nama Provinsi:</label>
											<select class="form-control select2 custom-minwidth" id="province_id" name="province_id" disabled>
												<?php foreach ($provinces as $val):?>
												  <option <?php echo (($kabupaten == null ? old('province_id') : $kabupaten['province_id']) == $val['id']) ? 'selected' : '';?> value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
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
											<label for="name">Nama Kabupaten:</label>
											<input type="text" class="form-control custom-minwidth <?=$validation->hasError('name') ? 'is-invalid' : ''?>" id="name" name="name" value="<?php echo $kabupaten == null ? old('name') : $kabupaten['name']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('name')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="alt_name">Nama Alternatif:</label>
											<input type="text" class="form-control custom-minwidth <?=$validation->hasError('alt_name') ? 'is-invalid' : ''?>" id="alt_name" name="alt_name" value="<?php echo $kabupaten == null ? old('name') : $kabupaten['alt_name']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('alt_name')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="btsutara">Batas Utara:</label>
											<input type="text" class="form-control custom-minwidth <?=$validation->hasError('btsutara') ? 'is-invalid' : ''?>" id="btsutara" name="btsutara" value="<?php echo $kabupaten == null ? old('btsutara') : $kabupaten['btsutara']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('btsutara')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="btstimur">Batas Timur:</label>
											<input type="text" class="form-control custom-minwidth <?=$validation->hasError('btstimur') ? 'is-invalid' : ''?>" id="btstimur" name="btstimur" value="<?php echo $kabupaten == null ? old('btstimur') : $kabupaten['btstimur']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('btstimur')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="btsselatan">Batas Selatan:</label>
											<input type="text" class="form-control custom-minwidth <?=$validation->hasError('btsselatan') ? 'is-invalid' : ''?>" id="btsselatan" name="btsselatan" value="<?php echo $kabupaten == null ? old('btsselatan') : $kabupaten['btsselatan']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('btsselatan')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="btsbarat">Batas Barat:</label>
											<input type="text" class="form-control custom-minwidth <?=$validation->hasError('btsbarat') ? 'is-invalid' : ''?>" id="btsbarat" name="btsbarat" value="<?php echo $kabupaten == null ? old('btsbarat') : $kabupaten['btsbarat']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('btsbarat')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="luaswil">Luas Wilayah:</label>
											<input type="number" class="form-control custom-minwidth <?=$validation->hasError('luaswil') ? 'is-invalid' : ''?>" id="luaswil" name="luaswil" value="<?php echo $kabupaten == null ? old('luaswil') : $kabupaten['luaswil']; ?>" step=".01">
											<div class="invalid-feedback">
												<?=$validation->getError('luaswil')?>
											</div>
										</div>
									</div>
								</div>
								<input type="submit" class="btn custom-button" value="Submit" />
								<a class="btn btn-danger" href="<?php echo base_url('kabupaten');?>">Cancel</a>
	                        </div>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
