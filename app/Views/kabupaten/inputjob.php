<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $kabupatendtl == null ? 'Add' : 'Edit'; ?> Kabupaten</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('kabupatendtl');?>">Kabupaten</a></li>
                        <li class="breadcrumb-item active"><?php echo $kabupatendtl == null ? 'Add' : 'Edit'; ?></li>
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
						<form action="<?php echo base_url('kabupatenjob/store');?>" method="post" enctype="multipart/form-data">
			                <input type="hidden" id="csrf_faukes" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> 
			                <input type="hidden" id="id" name="id" value="<?php echo $kabupatendtl == null ? '' : $kabupatendtl['id']; ?>" /> 
	                        <div class="card-header">
				                <h3 class="card-title">Kabupaten</h3>	                            
	                        </div>
	                        <div class="card-body">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="regency_id">Nama Kota/Kabupaten:</label>
											<select class="form-control select2 custom-minwidth" id="regency_id" name="regency_id" <?php echo $kabupatendtl == null ? '' : 'disabled'; ?>>
												<?php foreach ($kabupaten as $val):?>
												  <option <?php echo (($kabupatendtl == null ? old('regency_id') : $kabupatendtl['regency_id']) == $val['id']) ? 'selected' : '';?> value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
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
											<label for="pekerjaan">Jenis Pekerjaan:</label>
											<input type="text" class="form-control custom-minwidth <?=$validation->hasError('pekerjaan') ? 'is-invalid' : ''?>" id="pekerjaan" name="pekerjaan" value="<?php echo $kabupatendtl == null ? old('pekerjaan') : $kabupatendtl['pekerjaan']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('pekerjaan')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="thndata">Tahun Data:</label>
											<input type="number" class="form-control custom-minwidth <?=$validation->hasError('thndata') ? 'is-invalid' : ''?>" id="thndata" name="thndata" value="<?php echo $kabupatendtl == null ? old('thndata') : $kabupatendtl['thndata']; ?>">
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
											<input type="number" class="form-control custom-minwidth <?=$validation->hasError('jumlah') ? 'is-invalid' : ''?>" id="jumlah" name="jumlah" value="<?php echo $kabupatendtl == null ? old('jumlah') : $kabupatendtl['jumlah']; ?>" step=".01">
											<div class="invalid-feedback">
												<?=$validation->getError('jumlah')?>
											</div>
										</div>
									</div>
								</div>
								<input type="submit" class="btn custom-button" value="Submit" />
								<a class="btn btn-danger" href="<?php echo base_url('kabupatenjob');?>">Cancel</a>
	                        </div>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
