  <!-- Begin Page Content -->
  <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> </h1>


      <!-- <div class="card">
                        
                        <div class="card-header bg-primary text-white">
                            <div>
                            <h5>Daftar user</h5>
                            </div>
                            
                                <?= form_open_multipart('admin/index'); ?>
                                    <div class="input-group content-end">
                                       
                                        <input class="form-control me-2" type="search" placeholder="Search" name="keyword" autofocus>
                                        <input class="btn btn-outline-success" type="submit" name="submit">
                                      
                                    </div>
                                </form>
                       
                      
                        </div>
                        <div class="card-body">
                            <table class="table table-hover bordered text-center">
                                <thead>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>action</th>
                                </thead>
                                
                                <?php $i = 1; ?>
                                
                                <?php foreach ($client as $c) : ?>
                                <tbody>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $c['name']; ?></td>
                                        <?php
                                        $r = $this->db->get_where('user_role', ['id' => $c['role_id']])->row_array();
                                        ?>
                                        <td><?= $r['role']; ?></td>
                                        <td>
                                            <a class="badge badge-warning" href="<?= base_url('admin/edit') . '?id=' . $c['id']; ?>">Edit</a>
                                            <a class="badge badge-danger" href="<?= base_url('admin/delete') . '?id=' . $c['id']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php endforeach; ?>
                                
                            </table>
                            
                             <?= $this->pagination->create_links(); ?>
                        </div>
                    </div> -->







  </div>
  <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->