 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-users"></i> <?= $title; ?> </h1>

     <div class="card shadow">
         <div class="card-header">
             <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newRoleModal">Add New Menu</a>
         </div>
         <div class="card-body">
             <div class="row">
                 <div class="col-lg-6">

                     <?= form_error('menu', '<div class="alert alert-danger alert-sm" role="alert">', '</div>'); ?>

                     <?= $this->session->flashdata('message'); ?>

                     <?php unset($_SESSION['message']); ?>



                     <table class="table table-hover">
                         <thead>
                             <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Nama</th>
                                 <th scope="col">Role</th>
                                 <th scope="col">Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php $i = 1; ?>
                             <?php foreach ($userlist as $u) : ?>
                                 <tr>
                                     <td scope="col"><?= $i++; ?></td>
                                     <td><?= $u['name']; ?></td>
                                     <?php
                                        $role = $this->db->get_where('user_role', ['id' => $u['role_id']])->row_array();
                                        ?>
                                     <td><?= $role['role']; ?></td>
                                     <td>
                                         <a href="<?= base_url('admin/roleaccess/') . $role['id']; ?>" class="badge badge-warning">access</a>
                                         <a href="" class="badge badge-success">Edit</a>
                                         <a href="<?= base_url('menu/delete'); ?>?id=<?= $role['id']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">Delete</a>
                                     </td>
                                 </tr>
                             <?php endforeach; ?>
                         </tbody>
                     </table>
                 </div>
             </div>

         </div>
     </div>






 </div>
 <!-- /.container-fluid -->

 </div>