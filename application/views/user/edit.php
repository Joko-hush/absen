  <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                        
                       
                         <div class="col-lg-8">
                            <?= $this->session->flashdata('message'); ?>
                            
                        </div>
                
                <!-- /.container-fluid -->


			<div class="row">
				<div class="col_lg-8">
					<?= form_open_multipart('user/edit'); ?>
						<div class="form-group row">
							<label for="email" class="col-sm-3 col-form-label">Email</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="name" class="col-sm-3 col-form-label">Full Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
								<?= form_error('name', '<small class="text-danger pl-3">','</small>'); ?>
							</div>
							
						</div>
						<div class="form-group row">
							<div class="col-sm-3">Picture</div>
							<div class="col-sm-9">
								<div class="row">
									<div class="col-sm-3">
										<img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
									</div>
									<div class="col-sm-9">
										<div class="custom-file">
											<input type="file" class="custom-file-input" id="image" name="image">
											<label class="custom-file-label" for="image">Choose File</label>							
									
									
									</div>
								</div>
							</div>
						    </div>
						
					
				        </div>
				        <div class="form-group row">
							<label for="phone" class="col-sm-3 col-form-label">Phone</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="phone" name="phone" value="<?= $user['phone']; ?>" >
								<?= form_error('phone', '<small class="text-danger pl-3">','</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="address" class="col-sm-3 col-form-label">Address</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="address" name="address" value="<?= $user['address']; ?>">
								<?= form_error('address', '<small class="text-danger pl-3">','</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="klinik1" class="col-sm-3 col-form-label">Klinik 1*</label>
							<div class="col-sm-9">
								<!--<input type="text" class="form-control" id="klinik1" name="klinik1" value="<?= $user['klinik1']; ?>">-->
								<select type="text" class="form-control" id="klinik1" name="klinik1">
								    <option value="<?= $k1['id']; ?>"><?= $k1['nama']; ?></option>
								    <?php foreach($klinik as $k): ?>
								    <option value="<?= $k['id'];?>"><?= $k['nama'];?></option>
								    <?php endforeach; ?>
								</select>
								<input type="text" class="form-control" id="klinik2" name="klinik12" placeholder="Jika tidak ada dalam daftar silahkan tulis disini" >
								<?= form_error('klinik 1', '<small class="text-danger pl-3">','</small>'); ?>
							</div>
						</div>
							<div class="form-group row">
							<label for="klinik2" class="col-sm-3 col-form-label">Klinik 2</label>
							<div class="col-sm-9">
							
								<select type="text" class="form-control" id="klinik2" name="klinik2">
								     <option value="<?= $k2['id']; ?>"><?= $k2['nama']; ?></option>
								    <option></option>
								    <?php foreach($klinik as $k): ?>
								    <option value="<?= $k['id'];?>"><?= $k['nama'];?></option>
								    <?php endforeach; ?>
								</select>
								<input type="text" class="form-control" id="klinik2" name="klinik22" placeholder="Jika tidak ada dalam daftar silahkan tulis disini" >
							</div>
						</div>
							<div class="form-group row">
							<label for="klinik3" class="col-sm-3 col-form-label">Klinik 3</label>
							<div class="col-sm-9">
								<!--<input type="text" class="form-control" id="klinik3" name="klinik3" value="<?= $user['klinik3']; ?>">-->
								<select type="text" class="form-control" id="klinik3" name="klinik3">
								     <option value="<?= $k3['id']; ?>"><?= $k3['nama']; ?></option>
								    <option></option>
								    <?php foreach($klinik as $k): ?>
								    <option value="<?= $k['id'];?>"><?= $k['nama'];?></option>
								    <?php endforeach; ?>
								</select>
								<input type="text" class="form-control" id="klinik2" name="klinik32" placeholder="Jika tidak ada dalam daftar silahkan tulis disini" >
							</div>
						</div>
				
				
						
				<div class="form-group row">
							<div class="col-sm-3"></div>
							<div class="col-sm-9">
								<button type="submit" class="btn btn-primary">Edit</button>
							</div>
						</div>
				</form>
			</div>
	</div>
            </div>
            <!-- End of Main Content -->