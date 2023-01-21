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
                  <h3 class="card-title">Data Menu</h3>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                  <?php echo $this->session->flashdata('massage'); ?>
                  
                  <button type="button" class="btn btn-block bg-gradient-success btn-sm mb-3" style="width: 150px;" data-toggle="modal" data-target="#modal_tambah">
                    <i class="fas fa-plus"></i>&nbsp Tambah Menu
                  </button>
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Level</th>
                        <th>Nama Menu</th>
                        <th>Link </th>
                        <th>Icon</th>
                        <th>Parent/Induk</th>
                        <th>Status</th>
                        <th width="105" style="text-align: center;">Option</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($getMenu as $mn) : ?>
                        <tr>
                          <td><?= $mn->lvl; ?></td>
                          <td><?= $mn->name_menu; ?></td>
                          <td><?= $mn->link_menu; ?></td>
                          <td><?= $mn->icon_menu; ?></td>
                          <td><?= $mn->induk; ?></td>
                          <?php if($mn->status == 1) : ?>
                            <td>Aktif</td>
                          <?php else : ?>
                            <td>Tidak aktif</td>
                          <?php endif; ?>
                          <td class="row" width="130">
                            <div class="col-sm-6">
                               <button type="button" class="btn btn-block bg-gradient-info" data-toggle="modal" data-target="#modal_edit<?php echo $mn->id_menu;?>">
                                <i class="fas fa-pencil-alt"></i>
                              </button>
                            </div>
                            <div class="col-sm-6">
                              <button type="button" class="btn btn-block bg-gradient-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $mn->id_menu;?>">
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
            <h4 class="modal-title">Tambah Menu</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="form-horizontal" action="<?php echo base_url() . 'DataMenu/tambahMenu' ?>" method="post">
            <div class="modal-body">
              <div class="form-group">
                <label>Level</label>
                <div class="select2-purple">
                  <select
                  class="select2"
                  data-placeholder="Pilih Level"
                  data-dropdown-css-class="select2-purple"
                  style="width: 100%" name="levelId"
                  >
                    <?php foreach ($getLevel as $lvl) : ?>
                      <option value="<?= $lvl->id_level; ?>"><?= $lvl->level; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php echo form_error('levelId', '<small class="text-danger pb-2">', '</small>'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Menu</label>
                <input type="text" name="menuName" class="form-control" placeholder="Nama Menu">
                <?php echo form_error('menuName', '<small class="text-danger pb-2">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Link</label>
                <input type="text" name="menuLink" class="form-control" placeholder="Link">
                <?php echo form_error('menuLink', '<small class="text-danger pb-2">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Icon</label>
                <input type="text" name="menuIcon" class="form-control" placeholder="Icon">
                <?php echo form_error('menuIcon', '<small class="text-danger pb-2">', '</small>'); ?>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Parent/Induk</label>
                    <div class="select2-purple">
                      <select
                      class="select2"
                      data-placeholder="Pilih Parent/Induk"
                      data-dropdown-css-class="select2-purple"
                      style="width: 100%" name="parentId"
                      >
                        <?php foreach ($getParentMenu as $pr) : ?>
                          <option value="<?= $pr->id_parent; ?>"><?= $pr->parent_name; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <?php echo form_error('parentId', '<small class="text-danger pb-2">', '</small>'); ?>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                   <div class="form-group">
                    <label>Status</label>
                    <div class="select2-purple">
                      <select
                      class="select2"
                      data-placeholder="Pilih Parent/Induk"
                      data-dropdown-css-class="select2-purple"
                      style="width: 100%" name="status"
                      >
                        <option value="0">Tidak Aktif</option>
                        <option value="1">Aktif</option>
                      </select>
                      <?php echo form_error('status', '<small class="text-danger pb-2">', '</small>'); ?>
                    </div>
                  </div>
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
    <?php foreach ($getMenu as $mu) : ?>
    <div class="modal fade" id="modal_edit<?php echo $mu->id_menu;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Menu</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="form-horizontal" action="<?php echo base_url() . 'DataMenu/editMenu' ?>" method="post">
            <div class="modal-body">
              <input type="hidden" name="idMenu" value="<?= $mu->id_menu; ?>">
              <div class="form-group">
                <label>Level</label>
                <div class="select2-purple">
                  <select
                  class="select2"
                  data-placeholder="Pilih Level"
                  data-dropdown-css-class="select2-purple"
                  style="width: 100%" name="levelId"
                  >
                    <?php foreach ($getLevel as $lv) : ?>
                      <option <?php if($mu->level_id==$lv->id_level) 
                      echo 'selected="selected"'; ?> value="<?= $lv->id_level; ?>"><?= $lv->level; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php echo form_error('levelId', '<small class="text-danger pb-2">', '</small>'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Menu</label>
                <input type="text" name="menuName" class="form-control" value="<?= $mu->name_menu; ?>" placeholder="Nama Menu">
                <?php echo form_error('menuName', '<small class="text-danger pb-2">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Link</label>
                <input type="text" name="menuLink" class="form-control" value="<?= $mu->link_menu; ?>"  placeholder="Link">
                <?php echo form_error('menuLink', '<small class="text-danger pb-2">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Icon</label>
                <input type="text" name="menuIcon" class="form-control" value="<?= $mu->icon_menu; ?>" placeholder="Icon">
                <?php echo form_error('menuIcon', '<small class="text-danger pb-2">', '</small>'); ?>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Parent/Induk</label>
                    <div class="select2-purple">
                      <select
                      class="select2"
                      data-placeholder="Pilih Parent/Induk"
                      data-dropdown-css-class="select2-purple"
                      style="width: 100%" name="parentId"
                      >
                        <?php foreach ($getParentMenu as $pr) : ?>
                          <option <?php if($mu->id_induk==$pr->id_parent) 
                          echo 'selected="selected"'; ?> value="<?= $pr->id_parent; ?>"><?= $pr->parent_name; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <?php echo form_error('parentId', '<small class="text-danger pb-2">', '</small>'); ?>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Status</label>
                    <div class="select2-purple">
                      <select
                      class="select2"
                      data-placeholder="Pilih Parent/Induk"
                      data-dropdown-css-class="select2-purple"
                      style="width: 100%" name="status"
                      >
                      <option value="0" <?php if($mu->status==0) 
                      echo 'selected="selected"'; ?>>Tidak Aktif</option>
                      <option value="1" <?php if($mu->status==1) 
                      echo 'selected="selected"'; ?>>Aktif</option>
                      </select>
                      <?php echo form_error('status', '<small class="text-danger pb-2">', '</small>'); ?>
                    </div>
                  </div>
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
  <?php foreach ($getMenu as $u) : ?>
    <!--Modal Hapus Pngguna-->
    <div class="modal fade" id="modal_hapus<?php echo $u->id_menu;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Delete Menu</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="form-horizontal" action="<?php echo base_url() . 'DataMenu/hapusMenu' ?>" method="post">
            <div class="modal-body">
              <input type="hidden" name="idMenu" value="<?= $u->id_menu; ?>">
              <p>Apakah Anda yakin mau menghapus Menu <b><?php echo $u->name_menu;?></b> ?</p>
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
