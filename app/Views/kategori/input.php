<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $kategori == null ? 'Add' : 'Edit'; ?> Kategori</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('kategori');?>">Kategori</a></li>
                        <li class="breadcrumb-item active"><?php echo $kategori == null ? 'Add' : 'Edit'; ?></li>
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
						<form action="<?php echo base_url('kategori/store');?>" method="post" enctype="multipart/form-data">
			                <input type="hidden" id="csrf_faukes" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> 
			                <input type="hidden" id="kode" name="kode" value="<?php echo $kategori == null ? '' : $kategori['kode']; ?>" /> 
	                        <div class="card-header">
				                <h3 class="card-title">Kategori</h3>	                            
	                        </div>
	                        <div class="card-body">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="kategori">Nama Kategori:</label>
											<input type="text" class="form-control custom-minwidth <?=$validation->hasError('kategori') ? 'is-invalid' : ''?>" id="kategori" name="kategori" value="<?php echo $kategori == null ? old('kategori') : $kategori['kategori']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('kategori')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="images">Icon Pin: *</label>
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
								<input type="submit" class="btn custom-button" value="Submit" />
								<a class="btn btn-danger" href="<?php echo base_url('kategori');?>">Cancel</a>
	                        </div>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
