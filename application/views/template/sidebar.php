 <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="<?= base_url('assets/dist/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo base_url('assets/dist/img/' . $user['foto']) ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $user['username'] ?></a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <?php
              $role_id = $user['id_user'];
              $level   = $user['id_jenis_user'];
              $getParent = "SELECT * FROM `menu_user` JOIN `parent_menu` ON `menu_user`.`parent_id` = `parent_menu`.`id_parent` WHERE `menu_user`.`id_user` = $role_id";
              $menu = $this->db->query($getParent)->result_array();

              //for open dropdown if child active
              $getParentName = "SELECT * FROM parent_menu";
              $parents = $this->db->query($getParentName)->result_array();
            ?>

            <?php foreach ($menu as $mn) : ?>
            <?php if($this->session->userdata('id_user') == $mn['id_user']) : ?>
              <?php foreach ($parents as $ps) : ?>
                <?php if($this->uri->segment(1) == "Dashboard") : ?>
                  <li class="nav-item">
                <?php elseif($mn['parent_name'] == $ps['parent_name']) : ?>
                  <li class="nav-item menu-open">
                <?php else : ?>
                  <li class="nav-item">
                <?php endif; ?>
              <?php endforeach; ?>
                 <a href="#" class="nav-link">
                  <i class="<?= $mn['parent_icon']; ?>"></i>
                  <p>
                    <?= $mn['parent_name']; ?>
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>

                <?php
                  $idParent = $mn['parent_id'];
                  $query = "SELECT * FROM `menu` JOIN `parent_menu` ON `parent_menu`.`id_parent` = `menu`.`parent_id` WHERE `menu`.`is_active` = 1 AND `parent_menu`.`id_parent` = $idParent";
                  $subMenu =  $this->db->query($query)->result_array();
                ?>

                 <?php foreach ($subMenu as $sm) : ?>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="<?= base_url($sm['menu_link']); ?>" class="nav-link <?php if($this->uri->segment(1)==$sm['menu_link']){echo 'active';}?> subMenu">
                        <i class="<?= $sm['menu_icon']; ?>"></i>
                        <p><?= $sm['menu_name']; ?></p>
                      </a>
                    </li>
                  </ul>
                <?php endforeach; ?>
               <?php endif; ?>
              </li>
            <?php endforeach; ?>
          
           <!--  <li class="nav-item">
              <a href="pages/widgets.html" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Widgets
                  <span class="right badge badge-danger">New</span>
                </p>
              </a>
            </li> -->

            <li class="nav-header">LABELS</li>
            <li class="nav-item">
              <a href="<?php echo base_url('login/logout') ?>" class="nav-link">
                <i class="nav- far fa-sign-out"></i>
                <p class="text">Logout</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>