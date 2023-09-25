 <!-- Begin Page Content -->
 <div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



   <div class="row">
     <div class="col-lg-6">

       <?= form_error('menu', '<div class="alert alert-danger alert-sm" role="alert">', '</div>'); ?>

       <?= $this->session->flashdata('message'); ?>

       <?php unset($_SESSION['message']); ?>

       <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newRoleModal">Add New Menu</a>

       <table class="table table-hover mt-3">
         <thead>
           <tr>
             <th scope="col">#</th>
             <th scope="col">Role</th>
             <th scope="col">Action</th>
           </tr>
         </thead>
         <tbody>
           <?php $i = 1; ?>
           <?php foreach ($role as $r) : ?>
             <tr>
               <td scope="col"><?= $i++; ?></td>
               <td><?= $r['role']; ?></td>
               <td>
                 <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>" class="badge badge-warning">access</a>
                 <a href="" class="badge badge-success">Edit</a>
                 <a href="<?= base_url('menu/delete'); ?>?id=<?= $r['id']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">Delete</a>
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

 <!--Modal start-->


 <!-- Modal -->
 <div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newMenuModallabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="newMenuModallabel">New Menu</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <form action="<?= base_url('admin/role'); ?>" method="post">
         <div class="modal-body">
           <div class="mb-3">
             <div class="form-group">
               <input type="text" class="form-control" id="role" name="role" placeholder="role name">
             </div>
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary">Add</button>
         </div>
       </form>
     </div>
   </div>
 </div>