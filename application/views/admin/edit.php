

  <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                    
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5><?= $member['name']; ?></h5>
                        </div>
                        <?php
                            $r = $this->db->get_where('user_role', ['id' => $member['role_id']])->row_array();
                        ?>
                        <div class="card-body">
                           <?= form_open_multipart('admin/edit'); ?>
                           <input type="hidden" name="id" value="<?= $member['id']; ?>">
                                <div class="form-floating mb-3">
                                  <input type="text" class="form-control" id="floatingInputrole" value="<?= $r['role']; ?>" disabled>
                                  
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-control" aria-label="Default select example" name="role">
                                        
                                          <option selected>Open this select menu</option>
                                          <?php foreach($role as $ro): ?>
                                          <option value="<?= $ro['id']; ?>"><?= $ro['role']; ?></option>
                                          <?php endforeach; ?>
                                          
                                    </select>
                                  
                                </div>
                                <div class="form-floating mb-3">
                                    <?php 
                                    $klinik = $this->db->get('klinik')->result_array();
                                    ?>
                                <select type="text" class="form-control mb-3" id="klinik" name="klinik" >
								    <option placeholder="Select Klinik"></option>
								    <?php foreach($klinik as $k): ?>
								    <option value="<?= $k['id'];?>"><?= $k['nama'];?></option>
								    <?php endforeach; ?>
								</select>
								
								<input type="text" class="form-control" id="klinik2" name="klinik1" placeholder="Jika tidak ada dalam daftar silahkan tulis nama klinik disini" >
								</div>
                                <button type="submit" name="submit" class="btn btn-success">Change</button>
                            </form>
                        </div>
                    </div>
                    
                    
                    
                    
                        
                       
                        
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->