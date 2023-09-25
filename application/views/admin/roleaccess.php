 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



     <div class="row">
         <div class="col-lg-6">



             <?= $this->session->flashdata('message'); ?>
             <?php unset($_SESSION['message']); ?>

             <h5>Role : <?= $role['role']; ?></h5>

             <table class="table table-hover mt-3">
                 <thead>
                     <tr>
                         <th scope="col">#</th>
                         <th scope="col">Menu</th>
                         <th scope="col">Access</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $i = 1; ?>
                     <?php foreach ($menu as $m) : ?>
                         <tr>
                             <td scope="col"><?= $i++; ?></td>
                             <td><?= $m['menu']; ?></td>
                             <td>
                                 <div class="form-check">
                                     <input class="form-check-input akses" type="checkbox" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>">

                                 </div>
                             </td>
                         </tr>
                     <?php endforeach; ?>
                 </tbody>
             </table>
         </div>
     </div>




 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->