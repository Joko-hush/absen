  <!-- Begin Page Content -->
  <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



      <div class="row">
          <div class="col-lg">
              <?php if (validation_errors()) : ?>
                  <div class="alert alert-danger alert-sm" role="alert">
                      <?= validation_errors(); ?>
                  </div>
              <?php endif; ?>


              <?= $this->session->flashdata('message'); ?>

              <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#newsubMenuModal">Add New Submenu</a>

              <table class="table table-hover mt-3">
                  <thead>
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col">Title</th>
                          <th scope="col">Menu</th>
                          <th scope="col">Url</th>
                          <th scope="col">Icon</th>
                          <th scope="col">Active</th>
                          <th scope="col">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php $i = 1; ?>
                      <?php foreach ($SubMenu as $sm) : ?>
                          <tr>
                              <td scope="col"><?= $i++; ?></td>
                              <td><?= $sm['title']; ?></td>
                              <td><?= $sm['menu']; ?></td>
                              <td><?= $sm['url']; ?></td>
                              <td><?= $sm['icon']; ?></td>
                              <td><?= $sm['is_active']; ?></td>
                              <td>
                                  <a href="" class="badge badge-success">Edit</a>
                                  <a href="<?= base_url('menu/deletesubmenu'); ?>?id=<?= $sm['id']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">Delete</a>
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
  <div class="modal fade" id="newsubMenuModal" tabindex="-1" aria-labelledby="newMenuModallabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="newMenuModallabel">Add New Submenu</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="<?= base_url('menu/submenu'); ?>" method="post">
                  <div class="modal-body">
                      <div class="mb-3">
                          <div class="form-group">
                              <input type="text" class="form-control" id="title" name="title" placeholder="Sub menu title">
                          </div>
                          <div class="form-group">
                              <select name="menu_id" id="menu_id" class="form-control">
                                  <option>Select Menu</option>
                                  <?php foreach ($menu as $m) : ?>
                                      <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                  <?php endforeach; ?>
                              </select>
                          </div>
                          <div class="form-group">
                              <input type="text" class="form-control" id="url" name="url" placeholder="Sub menu url">
                          </div>
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" id="icon" name="icon" placeholder="Sub menu icon">
                      </div>
                      <div class="form-group">
                          <div class="form-check">
                              <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
                              <label class="form-check-label" for="is_active">Active?</label>
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