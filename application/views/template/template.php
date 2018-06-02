<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo SITE_TITLE; ?> | <?php echo isset($title) ? $title : ""; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url("assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css"); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url("assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css"); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url("assets/adminlte/bower_components/Ionicons/css/ionicons.min.css"); ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url("assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url("assets/adminlte/dist/css/AdminLTE.min.css"); ?>">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="<?php echo base_url("assets/adminlte/dist/css/skins/skin-blue.min.css"); ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 3 -->
  <script src="<?php echo base_url("assets/adminlte/bower_components/jquery/dist/jquery.min.js"); ?>"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url("assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"); ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url("assets/adminlte/dist/js/adminlte.min.js"); ?>"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url("assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"); ?>"></script>

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo site_url(); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><?php echo SITE_TITLE; ?></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo SITE_TITLE; ?></b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?php echo base_url("assets/adminlte/dist/img/avatar04.png"); ?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo ucwords($this->session->userdata("userName")); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?php echo base_url("assets/adminlte/dist/img/avatar04.png"); ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo ucwords($this->session->userdata("userName")); ?> - <?php echo ucwords($this->session->userdata("levelDesc")); ?>
                  <small>Didaftarkan pada <?php echo $this->session->userdata('userInsertDate'); ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-12 text-center">
                    <a href="#"><?php echo $this->session->userdata('lokasiKet'); ?></a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo site_url("auth/form");?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url("auth/logout"); ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url("assets/adminlte/dist/img/avatar04.png"); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo ucwords($this->session->userdata("userName")); ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $this->session->userdata('lokasiKode'); ?></a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form> -->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Main Menu</li>
        <!-- Optionally, you can add icons to the links -->
        <!-- <li class="active"><a href="<?php echo site_url(); ?>"><i class="fa fa-link"></i> <span>Dashboard</span></a></li> -->

        <?php
        $ur_id = $this->session->userdata("userLevel");
        $sql_menu = 'SELECT m.menu_id, m.menu_ket, m.menu_url FROM hak_akses ha LEFT JOIN menu m ON ha.ha_menu=m.menu_id WHERE m.menu_parent=0 AND ha.ha_ur='.$ur_id.' AND ha.ha_view=1 ORDER BY m.menu_order ASC';
        $qry_menu = $this->db->query($sql_menu);
        $res_menu = $qry_menu->num_rows() > 0 ? $qry_menu->result() : FALSE;

        if ($res_menu !== FALSE)
        {
          foreach ($res_menu as $val_menu)
          {
            $menu_url = $val_menu->menu_url === 'home' ? '' : $val_menu->menu_url;

            $sql_sub_menu = 'SELECT m.menu_id AS menu_id, m.menu_ket, m.menu_url, m.menu_order FROM hak_akses ha LEFT JOIN menu m ON ha.ha_menu = m.menu_id WHERE m.menu_parent='.$val_menu->menu_id.' AND ha.ha_view=1 AND ha.ha_ur='.$ur_id.' GROUP BY m.menu_id, m.menu_ket, m.menu_url, m.menu_order ORDER BY m.menu_order ASC';

            $qry_sub_menu = $this->db->query($sql_sub_menu);
            $res_sub_menu = $qry_sub_menu->num_rows() > 0 ? $qry_sub_menu->result() : FALSE;

            if ($res_sub_menu != FALSE)
            {
              ?>
              <li class="treeview">
                <a href="<?php echo base_url($menu_url); ?>">
                  <i class="fa fa-link"></i>
                  <span><?php echo ucwords($val_menu->menu_ket); ?></span>
                  <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                  </a>
                  <ul class="treeview-menu">
                    <?php
                    foreach ($res_sub_menu as $val_sub_menu)
                    {
                      ?>
                      <li><a href="<?php echo base_url($val_sub_menu->menu_url); ?>"><i class="fa fa-circle-o"></i> <?php echo ucwords($val_sub_menu->menu_ket); ?></a></li>
                      <?php
                    }
                    ?>
                  </ul>
              </li>
              <?php
            }
            else
            {
              ?>
              <li>
                <a href="<?php echo base_url($menu_url); ?>">
                  <i class="fa fa-th"></i> <span><?php echo ucwords($val_menu->menu_ket); ?></span>
                </a>
              </li>
              <?php
            }
          }
        }
        ?>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo isset($title) ? $title : ""; ?>
        <small><?php echo isset($opt_title) ? $opt_title : ""; ?></small>
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <?php echo $contents; ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
    Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="<?php echo site_url(); ?>"><?php echo SITE_TITLE; ?></a>.</strong> All rights reserved.
  </footer>

</div>
<!-- ./wrapper -->

</body>
</html>
