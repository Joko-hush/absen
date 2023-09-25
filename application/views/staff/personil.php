 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

     <div class="card">
         <div class="card-header">
             Daftar Personil
         </div>
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table table-bordered" id="myTable">
                     <thead>
                         <th>No</th>
                         <th>Nama</th>
                     </thead>
                     <tbody>
                         <?php $n = 1;
                            foreach ($staff as $s) : ?>
                             <tr>
                                 <td><?= $n++; ?></td>
                                 <td><?= $s['NAME_DISPLAY']; ?></td>
                             </tr>
                         <?php endforeach; ?>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>





 </div>