 <!-- wrapper  -->
 <!-- ============================================================== -->
 <div class="dashboard-wrapper">
     <div class="container-fluid dashboard-content">
         <!-- ============================================================== -->
         <!-- pageheader -->
         <!-- ============================================================== -->
         <div class="row">
             <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                 <div class="page-header">
                     <h2 class="pageheader-title">Presensi Bimbingan Proyek</h2>
                     <hr>
                 </div>
             </div>
         </div>
         <!-- ============================================================== -->
         <!-- end pageheader -->
         <!-- ============================================================== -->
         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="card">
                 <center>
                     <h5 class="card-header">Form Presensi Bimbingan</h5>
                 </center>
                 <div class="card-body">
                     <table class="table table-bordered">
                         <thead>
                             <tr>
                                 <th scope="col-lg-2">No</th>
                                 <th scope="col">Tanggal Bimbingan</th>
                                 <th scope="col">Catatan Kemajuan Materi</th>
                                 <th scope="col">Paraf Dosen Pembimbing</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php $no = 1; ?>
                             <?php foreach ($tes as $tes) : ?>
                                 <tr>
                                     <th scope="row"><?= $no++  ?></th>
                                     <td><?= $tes['tanggal']; ?></td>
                                     <td><?= $tes['materi']; ?></td>
                                     <td> <img width="10%" src="<?= base_url('assets/File/tandatangan_dosen/') . $tes['paraf_dosen'];  ?>" alt=""></td>
                                 </tr>
                             <?php endforeach; ?>
                             <tr>
                                 <th scope="row" colspan="3">Total Bimbingan</th>
                                 <td colspan="2">-</td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- ============================================================== -->
 <!-- end main wrapper -->