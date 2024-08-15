<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $lokasidtl == null ? 'Add' : 'Edit'; ?> Gambar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('obyek/detail/').$idlokasi;?>">Gambar</a></li>
                        <li class="breadcrumb-item active"><?php echo $lokasidtl == null ? 'Add' : 'Edit'; ?></li>
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
						<form action="<?php echo base_url('obyek/storedtl');?>" method="post" enctype="multipart/form-data">
			                <input type="hidden" id="csrf_faukes" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> 
			                <input type="hidden" id="idlokasi" name="idlokasi" value="<?php echo $idlokasi; ?>">
			                <input type="hidden" id="kode" name="kode" value="<?php echo $lokasidtl == null ? '' : $lokasidtl['kode']; ?>" /> 
	                        <div class="card-header">
				                <h3 class="card-title">Obyek</h3>
	                        </div>
	                        <div class="card-body">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="fileimages">Gambar Obyek:</label>
											<div class="input-group">
												<input type="file" class="custom-file-input custom-minwidth <?=$validation->hasError('fileimages') ? 'is-invalid' : ''?>" id="fileimages" name="fileimages" accept="images/*">
												<label class="custom-file-label" for="fileimages">Choose file</label>
												<div class="invalid-feedback">
													<?=$validation->getError('fileimages')?>
												</div>
											</div>
											<p class="upload-note">Pilih file dengan format gambar.</p>
										</div>
									</div>
								</div>
								<input type="submit" class="btn custom-button" value="Submit" />
								<a class="btn btn-danger" href="<?php echo base_url('obyek/detail/').$idlokasi;?>">Cancel</a>
	                        </div>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
