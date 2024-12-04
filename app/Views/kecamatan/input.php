<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $kecamatan == null ? 'Add' : 'Edit'; ?> Kecamatan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('kecamatan');?>">Kecamatan</a></li>
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
				                <h3 class="card-title">Kecamatan</h3>	                            
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
		                        <div class="card-header">
		                            Batas Wilayah
		                        </div>
		                        <div class="card-body">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="btsutara">Batas Utara:</label>
												<input type="text" class="form-control custom-minwidth <?=$validation->hasError('btsutara') ? 'is-invalid' : ''?>" id="btsutara" name="btsutara" value="<?php echo $kecamatan == null ? old('btsutara') : $kecamatan['btsutara']; ?>">
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
												<input type="text" class="form-control custom-minwidth <?=$validation->hasError('btstimur') ? 'is-invalid' : ''?>" id="btstimur" name="btstimur" value="<?php echo $kecamatan == null ? old('btstimur') : $kecamatan['btstimur']; ?>">
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
												<input type="text" class="form-control custom-minwidth <?=$validation->hasError('btsselatan') ? 'is-invalid' : ''?>" id="btsselatan" name="btsselatan" value="<?php echo $kecamatan == null ? old('btsselatan') : $kecamatan['btsselatan']; ?>">
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
												<input type="text" class="form-control custom-minwidth <?=$validation->hasError('btsbarat') ? 'is-invalid' : ''?>" id="btsbarat" name="btsbarat" value="<?php echo $kecamatan == null ? old('btsbarat') : $kecamatan['btsbarat']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('btsbarat')?>
												</div>
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
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="luaswil">Luas Wilayah:</label>
											<input type="number" class="form-control custom-minwidth <?=$validation->hasError('luaswil') ? 'is-invalid' : ''?>" id="luaswil" name="luaswil" value="<?php echo $kecamatan == null ? old('luaswil') : $kecamatan['luaswil']; ?>" step=".01">
											<div class="invalid-feedback">
												<?=$validation->getError('luaswil')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="bumdes">Bumdes:</label>
											<input type="number" class="form-control custom-minwidth <?=$validation->hasError('bumdes') ? 'is-invalid' : ''?>" id="bumdes" name="bumdes" value="<?php echo $kecamatan == null ? old('bumdes') : $kecamatan['bumdes']; ?>">
											<div class="invalid-feedback">
												<?=$validation->getError('bumdes')?>
											</div>
										</div>
									</div>
								</div>
		                        <div class="card-header">
		                            Jumlah Penduduk
		                        </div>
		                        <div class="card-body">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="totall">Jumlah Penduduk Pria:</label>
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
												<label for="totalp">Jumlah Penduduk Wanita:</label>
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
												<label for="totala">Jumlah Total Penduduk:</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('totala') ? 'is-invalid' : ''?>" id="totala" name="totala" value="<?php echo $kecamatan == null ? old('totala') : $kecamatan['totala']; ?>" readonly>
												<div class="invalid-feedback">
													<?=$validation->getError('totala')?>
												</div>
											</div>
										</div>
									</div>
		                        </div>
		                        <div class="card-header">
		                            Pendidikan Penduduk
		                        </div>
		                        <div class="card-body">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="tbsekolah">Tidak/Belum Sekolah:</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('tbsekolah') ? 'is-invalid' : ''?>" id="tbsekolah" name="tbsekolah" value="<?php echo $kecamatan == null ? old('tbsekolah') : $kecamatan['tbsekolah']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('tbsekolah')?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="btsd">Belum Tamat SD:</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('btsd') ? 'is-invalid' : ''?>" id="btsd" name="btsd" value="<?php echo $kecamatan == null ? old('btsd') : $kecamatan['btsd']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('btsd')?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="sd">SD:</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('sd') ? 'is-invalid' : ''?>" id="sd" name="sd" value="<?php echo $kecamatan == null ? old('sd') : $kecamatan['sd']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('sd')?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="smp">SMP:</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('smp') ? 'is-invalid' : ''?>" id="smp" name="smp" value="<?php echo $kecamatan == null ? old('smp') : $kecamatan['smp']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('smp')?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="sma">SMA:</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('sma') ? 'is-invalid' : ''?>" id="sma" name="sma" value="<?php echo $kecamatan == null ? old('sma') : $kecamatan['sma']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('sma')?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="profesi">DI/DII:</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('profesi') ? 'is-invalid' : ''?>" id="profesi" name="profesi" value="<?php echo $kecamatan == null ? old('profesi') : $kecamatan['profesi']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('profesi')?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="diploma">Akademi/Diploma III:</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('diploma') ? 'is-invalid' : ''?>" id="diploma" name="diploma" value="<?php echo $kecamatan == null ? old('diploma') : $kecamatan['diploma']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('diploma')?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="sarjana">Diploma IV/S1:</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('sarjana') ? 'is-invalid' : ''?>" id="sarjana" name="sarjana" value="<?php echo $kecamatan == null ? old('sarjana') : $kecamatan['sarjana']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('sarjana')?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="magister">Magister(S2):</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('magister') ? 'is-invalid' : ''?>" id="magister" name="magister" value="<?php echo $kecamatan == null ? old('magister') : $kecamatan['magister']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('magister')?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="doctoral">Doktoral(S3):</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('doctoral') ? 'is-invalid' : ''?>" id="doctoral" name="doctoral" value="<?php echo $kecamatan == null ? old('doctoral') : $kecamatan['doctoral']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('doctoral')?>
												</div>
											</div>
										</div>
									</div>
		                        </div>
		                        <div class="card-header">
		                            Pekerjaan Penduduk
		                        </div>
		                        <div class="card-body">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="btkerja">Belum/Tidak Bekerja:</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('btkerja') ? 'is-invalid' : ''?>" id="btkerja" name="btkerja" value="<?php echo $kecamatan == null ? old('btkerja') : $kecamatan['btkerja']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('btkerja')?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="asn">Aparatur/Pejabat Negara:</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('asn') ? 'is-invalid' : ''?>" id="asn" name="asn" value="<?php echo $kecamatan == null ? old('asn') : $kecamatan['asn']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('asn')?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="pengajar">Tenaga Pengajar:</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('pengajar') ? 'is-invalid' : ''?>" id="pengajar" name="pengajar" value="<?php echo $kecamatan == null ? old('pengajar') : $kecamatan['pengajar']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('wiraswasta')?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="wiraswasta">Wiraswasta:</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('wiraswasta') ? 'is-invalid' : ''?>" id="wiraswasta" name="wiraswasta" value="<?php echo $kecamatan == null ? old('wiraswasta') : $kecamatan['wiraswasta']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('wiraswasta')?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="petani">Petani/Peternak:</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('petani') ? 'is-invalid' : ''?>" id="petani" name="petani" value="<?php echo $kecamatan == null ? old('petani') : $kecamatan['petani']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('petani')?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="nelayan">Nelayan:</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('nelayan') ? 'is-invalid' : ''?>" id="nelayan" name="nelayan" value="<?php echo $kecamatan == null ? old('nelayan') : $kecamatan['nelayan']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('nelayan')?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="pemukaagama">Pemuka Agama:</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('pemukaagama') ? 'is-invalid' : ''?>" id="pemukaagama" name="pemukaagama" value="<?php echo $kecamatan == null ? old('pemukaagama') : $kecamatan['pemukaagama']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('pemukaagama')?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="pelajar">Pelajar/Mahasiswa:</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('pelajar') ? 'is-invalid' : ''?>" id="pelajar" name="pelajar" value="<?php echo $kecamatan == null ? old('pelajar') : $kecamatan['pelajar']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('pelajar')?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="nakes">Tenaga Kesehatan:</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('nakes') ? 'is-invalid' : ''?>" id="nakes" name="nakes" value="<?php echo $kecamatan == null ? old('nakes') : $kecamatan['nakes']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('nakes')?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="pensiun">Pensiunan:</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('pensiun') ? 'is-invalid' : ''?>" id="pensiun" name="pensiun" value="<?php echo $kecamatan == null ? old('pensiun') : $kecamatan['pensiun']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('pensiun')?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="lainnya">Lainnya:</label>
												<input type="number" class="form-control custom-minwidth <?=$validation->hasError('lainnya') ? 'is-invalid' : ''?>" id="lainnya" name="lainnya" value="<?php echo $kecamatan == null ? old('lainnya') : $kecamatan['lainnya']; ?>">
												<div class="invalid-feedback">
													<?=$validation->getError('lainnya')?>
												</div>
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
