  <!-- Begin Page Content -->
  <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



      <div class="row">
          <div class="col-lg-6">

              <?= form_error('menu', '<div class="alert alert-danger alert-sm" role="alert">', '</div>'); ?>

              <?= $this->session->flashdata('message'); ?>

              <a href="" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#newMenuModal">Add New Menu</a>

              <table class="table table-hover mt-3">
                  <thead>
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col">Menu</th>
                          <th scope="col">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php $i = 1; ?>
                      <?php foreach ($menu as $m) : ?>
                          <tr>
                              <td scope="col"><?= $i++; ?></td>
                              <td><?= $m['menu']; ?></td>
                              <td>
                                  <a href="" class="badge badge-success">Edit</a>
                                  <a href="<?= base_url('menu/hapusmenu'); ?>?id=<?= $m['id']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">Delete</a>
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
  <div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModallabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="newMenuModallabel">New Menu</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="<?= base_url('menu'); ?>" method="post">
                  <div class="modal-body">
                      <div class="mb-3">
                          <div class="form-group">
                              <input type="text" class="form-control" id="menu" name="menu" placeholder="menu name">
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