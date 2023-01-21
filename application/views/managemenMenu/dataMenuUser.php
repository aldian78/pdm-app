<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | DataTables</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/css/select2.min.css') ?>" />
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') ?>"/>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.min.css') ?>">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php $this->load->view('template/navbar'); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php $this->load->view('template/sidebar'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>DataTables</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">DataTables</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Menu User</h3>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                  <?php echo $this->session->flashdata('massage'); ?>
                  
                  <button type="button" class="btn btn-block bg-gradient-success btn-sm mb-3" style="width: 150px;" data-toggle="modal" data-target="#modal_tambah">
                    <i class="fas fa-plus"></i>&nbsp Tambah Menu User
                  </button>
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Parent</th>
                        <th width="105" style="text-align: center;">Option</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($getMenuUser as $mu) : ?>
                        <tr>
                          <td><?= $mu->no_setting; ?></td>
                          <td><?= $mu->username; ?></td>
                          <td><?= $mu->parent_name; ?></td>
                          <td class="row" width="130">
                            <div class="col-sm-6">
                               <button type="button" class="btn btn-block bg-gradient-info" data-toggle="modal" data-target="#modal_edit<?php echo $mu->no_setting;?>">
                                <i class="fas fa-pencil-alt"></i>
                              </button>
                            </div>
                            <div class="col-sm-6">
                              <button type="button" class="btn btn-block bg-gradient-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $mu->no_setting;?>">
                                <i class="fas fa-trash-alt"></i>
                              </button>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.modal-dialog -->
          </div>
            <!-- /.col -->
          </div>
                                  
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>

      <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
    <?php $this->load->view('template/footer'); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  
  <!-- Modal add jabatan -->
    <div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Menu User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="form-horizontal" action="<?php echo base_url() . 'DataMenuUser/tambahMenuUser' ?>" method="post">
            <div class="modal-body">
              <div class="form-group">
                <label>User</label>
                <div class="select2-purple">
                  <select
                  class="select2"
                  data-placeholder="Pilih User"
                  data-dropdown-css-class="select2-purple"
                  style="width: 100%" name="user"
                  >
                    <?php foreach ($getUser as $us) : ?>
                      <option value="<?= $us->id_user; ?>"><?= $us->username; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php echo form_error('user', '<small class="text-danger pb-2">', '</small>'); ?>
                </div>
              </div>
              <div class="form-group">
                <label>Parent</label>
                <div class="select2-purple">
                  <select
                  class="select2"
                  data-placeholder="Pilih Parent menu"
                  data-dropdown-css-class="select2-purple"
                  style="width: 100%" name="parent"
                  >
                    <?php foreach ($getParentMenu as $pm) : ?>
                      <option value="<?= $pm->id_parent; ?>"><?= $pm->parent_name; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php echo form_error('parent', '<small class="text-danger pb-2">', '</small>'); ?>
                </div>
              </div>
               <div class="form-group">
                <label>Sub Menu</label>
                <div class="select2-purple">
                  <select
                  class="select2"
                  data-placeholder="Pilih Parent menu"
                  data-dropdown-css-class="select2-purple"
                  style="width: 100%" name="menuId"
                  >
                    <?php foreach ($getMenu as $um) : ?>
                      <option value="<?= $um->menu_id; ?>"><?= $um->menu_name; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php echo form_error('parent', '<small class="text-danger pb-2">', '</small>'); ?>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <button type="submit" class="btn bg-gradient-success btn-flat" id="simpan">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <!-- End Modal add jabatan -->

  <!-- Modal edit jabatan -->
    <?php foreach ($getMenuUser as $m) : ?>
     <div class="modal fade" id="modal_edit<?= $m->no_setting; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Menu User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="form-horizontal" action="<?php echo base_url() . 'DataMenuUser/editMenuUser' ?>" method="post">
            <div class="modal-body">
              <input type="hidden" name="idMenuUser" value="<?= $m->no_setting; ?>">
              <div class="form-group">
                <label>User</label>
                <div class="select2-purple">
                  <select
                  class="select2"
                  data-placeholder="Pilih User"
                  data-dropdown-css-class="select2-purple"
                  style="width: 100%" name="user"
                  >
                    <?php foreach ($getUser as $us) : ?>
                      <option <?php if($m->id_user==$us->id_user) 
                        echo 'selected="selected"'; ?> value="<?= $us->id_user; ?>"><?= $us->username; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php echo form_error('user', '<small class="text-danger pb-2">', '</small>'); ?>
                </div>
              </div>
              <div class="form-group">
                <label>Parent</label>
                <div class="select2-purple">
                  <select
                  class="select2"
                  data-placeholder="Pilih Parent menu"
                  data-dropdown-css-class="select2-purple"
                  style="width: 100%" name="parent"
                  >
                    <?php foreach ($getParentMenu as $pm) : ?>
                       <option <?php if($m->parent_id==$pm->id_parent) 
                        echo 'selected="selected"'; ?> value="<?= $pm->id_parent; ?>"><?= $pm->parent_name; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php echo form_error('parent', '<small class="text-danger pb-2">', '</small>'); ?>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <button type="submit" class="btn bg-gradient-info btn-flat" id="simpan">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
   <?php endforeach; ?>
  <!-- End Modal Edit Jabatan -->

  <!-- Modal Hapus Jabatan -->
    <?php foreach ($getMenuUser as $u) : ?>
      <!--Modal Hapus Pngguna-->
      <div class="modal fade" id="modal_hapus<?php echo $u->no_setting;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Menu User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="<?php echo base_url() . 'DataMenuUser/hapusMenuUser' ?>" method="post">
              <div class="modal-body">
                <input type="hidden" name="idMenuUser" value="<?= $u->no_setting; ?>">
                <p>Apakah Anda yakin mau menghapus Menu User <b><?php echo $u->parent_name;?></b> ?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-gradient-danger btn-flat" id="simpan">Hapus</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <!-- End Modal Hapus Jabatan -->

  <!-- jQuery -->
  <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- DataTables  & Plugins -->
  <!-- Select2 -->
  <script src="<?php echo base_url('assets/plugins/select2/js/select2.full.min.js') ?>"></script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="<?php echo base_url('assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/jszip/jszip.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/pdfmake/pdfmake.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/pdfmake/vfs_fonts.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url('assets/dist/js/adminlte.min.js') ?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url('assets/dist/js/demo.js') ?>"></script>
  <!-- Page specific script -->
  <script>
    $(function () {
      $(".select2").select2();

      //Initialize Select2 Elements
      $(".select2bs4").select2({
        theme: "bootstrap4",
      });

      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });

  </script>
</body>

</html>
