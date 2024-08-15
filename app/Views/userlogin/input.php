<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $userlogin == null ? 'Add' : 'Edit'; ?> User Login</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('userlogin');?>">User Login</a></li>
                        <li class="breadcrumb-item active"><?php echo $userlogin == null ? 'Add' : 'Edit'; ?></li>
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
						<form action="<?php echo base_url('userlogin/store');?>" method="post" enctype="multipart/form-data">
			                <input type="hidden" id="csrf_faukes" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> 
			                <input type="hidden" id="id" name="id" value="<?php echo $userlogin == null ? '' : $userlogin['id']; ?>" /> 
	                        <div class="card-header">
				                <h3 class="card-title">User Login</h3>
				                <?php echo $userlogin == null ? '' : '<p style="color:red;">Mengedit berarti mengubah password juga!</p>'; ?>
	                        </div>
	                        <div class="card-body">
								<div class="form-group">
									<label for="username">User Name:</label>
									<input type="text" class="form-control custom-minwidth <?=$validation->hasError('username') ? 'is-invalid' : ''?>" id="username" name="username" value="<?php echo $userlogin == null ? old('username') : $userlogin['username']; ?>">
									<div class="invalid-feedback">
										<?=$validation->getError('username')?>
									</div>
								</div>
								<div class="form-group">
									<label for="name">Full Name:</label>
									<input type="text" class="form-control custom-minwidth <?=$validation->hasError('name') ? 'is-invalid' : ''?>" id="name" name="name" value="<?php echo $userlogin == null ? old('name') : $userlogin['name']; ?>">
									<div class="invalid-feedback">
										<?=$validation->getError('name')?>
									</div>
								</div>
								<div class="form-group">
									<label for="email">Email:</label>
									<input type="email" class="form-control custom-minwidth <?=$validation->hasError('email') ? 'is-invalid' : ''?>" id="email" name="email" value="<?php echo $userlogin == null ? old('email') : $userlogin['email']; ?>">
									<div class="invalid-feedback">
										<?=$validation->getError('email')?>
									</div>
								</div>
								<div class="form-group">
									<label for="password">Password:</label>
									<input type="password" class="form-control custom-minwidth <?=$validation->hasError('password') ? 'is-invalid' : ''?>" id="password" name="password" value="<?php echo $userlogin == null ? old('password') : $userlogin['password']; ?>">
									<div class="invalid-feedback">
										<?=$validation->getError('password')?>
									</div>
								</div>
								<div class="form-group">
									<label for="confirm_password">Konfirmasi Password:</label>
									<input type="password" class="form-control custom-minwidth <?=$validation->hasError('confirm_password') ? 'is-invalid' : ''?>" id="confirm_password" name="confirm_password" value="<?php echo $userlogin == null ? old('confirm_password') : $userlogin['confirm_password']; ?>">
									<div class="invalid-feedback">
										<?=$validation->getError('confirm_password')?>
									</div>
								</div>
								<div class="form-group">
									<label for="level">User Level:</label>
									<select class="form-control select2 custom-minwidth <?=$validation->hasError('level') ? 'is-invalid' : ''?>" id="level" name="level">
										<?php foreach ($levellogin as $val):?>
											<option <?php echo (($userlogin == null ? old('level') : $userlogin['level']) == $val->dropdownvalue) ? 'selected' : '';?> value="<?php echo $val->dropdownvalue;?>"><?php echo $val->description;?></option>
										<?php endforeach;?>
									</select>
									<div class="invalid-feedback">
										<?=$validation->getError('level')?>
									</div>
								</div>
								<input type="submit" class="btn custom-button" value="Submit" />
								<a class="btn btn-danger" href="<?php echo base_url('userlogin');?>">Cancel</a>
	                        </div>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
