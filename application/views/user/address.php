  <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                         <?= $this->session->flashdata('message'); ?>
                       
                        
                
                <!-- /.container-fluid -->


			<div class="row">
				<div class="col_lg">
					<?= form_open_multipart('user/address'); ?>
						<div class="form-group row">
							<label for="phone" class="col-sm-4 col-form-label">Phone</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="phone" name="phone" >
								<?= form_error('phone', '<small class="text-danger pl-3">','</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="address" class="col-sm-4 col-form-label">Address</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="address" name="address">
								<?= form_error('address', '<small class="text-danger pl-3">','</small>'); ?>
							</div>
						</div>
					
						
						<div class="form-group row">
							<div class="col-sm-4"></div>
							<div class="col-sm-8">
								<button type="submit" class="btn btn-primary">Add</button>
							</div>
				</div>	
					
				</div>
				
						
			
				</form>
			</div>
	</div>
            </div>
            <!-- End of Main Content -->