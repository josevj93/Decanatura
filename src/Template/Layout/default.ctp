<?php
<<<<<<< HEAD

$cakeDescription = 'Control de Activos';



=======
$cakeDescription = 'Control de Activos';
>>>>>>> origin/Develop
?>
<!DOCTYPE html>
<html>
<head>
  <?= $this->Html->charset() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?= $cakeDescription ?>:
    <?= $this->fetch('title') ?>
  </title>
  <?= $this->Html->meta('icon') ?>

  
  <?= $this->Html->css('cake.css') ?>


<<<<<<< HEAD
  <?= $this->Html->css([ 'plugins/bootstrap/css/bootstrap.min.css', 'plugins/font-awesome/css/font-awesome.min.css', 'plugins/datatables/dataTables.bootstrap4.css','sb-admin.css']) ?>
=======
  <?= $this->Html->css(['plugins/bootstrap/css/bootstrap.css','plugins/bootstrap/css/bootstrap.min.css', 'plugins/font-awesome/css/font-awesome.min.css', 'plugins/datatables/dataTables.bootstrap4.css','sb-admin.css']) ?>
>>>>>>> origin/Develop

  <?=
  $this->Html->script([ 'plugins/jquery/jquery.min.js']);
  ?>

<<<<<<< HEAD
  <!--$this->Html->css($this->Html->url('/css/main.css', true));-->

  <!-- Bootstrap core JavaScript-->



<!--
'dataTables.bootstrap.min','jquery.dataTables.min',, 'jquery.easing.min.js','bootstrap.min', 
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <link href="css/sb-admin.css" rel="stylesheet">
 <script src="js/sb-admin.min.js"></script>
   <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  



     <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
   
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
  
   
   
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
<<<<<<< HEAD

         
-->
=======
>>>>>>> origin/Develop

</head>


<<<<<<< HEAD
   <!--script src="js/sb-admin.min.js"></script>
=======
-->
=======

>>>>>>> origin/Develop


<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
<<<<<<< HEAD
    <a class="navbar-brand" href="index.html">Sistema de Activos</a>
=======

      <?=
      $this->Html->link(
      $this->Html->image("acronimo.png", array('style' => 'max-width:100px; margin-top: -7px; margin-right: 40px;'),["alt" => "Facultad de Ingenieria"]),
      "/Pages/display/",
      ['escape' => false]
      );
?>
  

    <a class="navbar-brand" href="index.html">Sistema de Activos</a>




>>>>>>> origin/Develop
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
       <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Usuarios">
        <?=$this->Html->link(
<<<<<<< HEAD
          $this->Html->tag('i','' , array('class' => 'fa fa-users')).$this->Html->tag('span', ' Usuarios', array('class' => 'nav-link-text')),
          array('controller' => 'Users','action' => 'index'),
=======

          $this->Html->tag('i','' , array('class' => 'fa fa-users')).$this->Html->tag('span', ' Usuarios', array('class' => 'nav-link-text')),array('controller' => 'Users','action' => 'index'),
>>>>>>> origin/Develop
          array('class' => 'nav-link',
            'escape'=> false)
        );
        ?>
      </li>
<<<<<<< HEAD
=======
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Roles">
              <?=$this->Html->link(
                  $this->Html->tag('i','' , array('class' => 'fa fa-users')).$this->Html->tag('span', ' Roles', array('class' => 'nav-link-text')),
                  array('controller' => 'Roles','action' => 'index'),
                  array('class' => 'nav-link',
                      'escape'=> false)
              );
              ?>
          </li>
>>>>>>> origin/Develop

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Activos">
        <?=$this->Html->link(
          $this->Html->tag('i','' , array('class' => 'fa fa-users')).$this->Html->tag('span', ' Activos', array('class' => 'nav-link-text')),
          array('controller' => 'Assets','action' => 'index'),
          array('class' => 'nav-link',
            'escape'=> false)
        );
        ?>
      </li>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tipos de activos">
        <?=$this->Html->link(
          $this->Html->tag('i','' , array('class' => 'fa fa-users')).$this->Html->tag('span', ' Tipos de activos', array('class' => 'nav-link-text')),
          array('controller' => 'Types','action' => 'index'),
          array('class' => 'nav-link',
            'escape'=> false)
        );
        ?>
<<<<<<< HEAD
=======

>>>>>>> origin/Develop
      </li>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Prestamos">
        <a class="nav-link" href="tables.html">
          <span class="nav-link-text">Préstamos</span>
        </a>
      </li>
<<<<<<< HEAD
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="InfTencnico">
        <a class="nav-link" href="tables.html">
          <span class="nav-link-text">Informe Técnico</span>
        </a>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Desechos">
        <a class="nav-link" href="tables.html">
          <span class="nav-link-text">Desechos</span>
        </a>
=======
       <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reporte Técnico">
        <?=$this->Html->link(

          $this->Html->tag('i','' , array('class' => 'fa fa-users')).$this->Html->tag('span', ' Reporte Técnico', array('class' => 'nav-link-text')),array('controller' => 'TechnicalReports','action' => 'index'),
          array('class' => 'nav-link',
            'escape'=> false)
        );
        ?>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Desechos">
        <?=$this->Html->link(

          $this->Html->tag('i','' , array('class' => 'fa fa-users')).$this->Html->tag('span', ' Desechos', array('class' => 'nav-link-text')),array('controller' => 'Residues','action' => 'index'),
          array('class' => 'nav-link',
            'escape'=> false)
        );
        ?>
>>>>>>> origin/Develop
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Traslados">
        <a class="nav-link" href="tables.html">
          <span class="nav-link-text">Traslados</span>
        </a>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="UAcademica">
        <a class="nav-link" href="tables.html">
          <span class="nav-link-text">Unidad Académica</span>
        </a>
      </li>
<<<<<<< HEAD
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Ubicaciones">
        <a class="nav-link" href="tables.html">
          <span class="nav-link-text">Ubicaciones</span>
        </a>
=======
       <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Ubicaciones">
        <?=$this->Html->link(

          $this->Html->tag('i','' , array('class' => 'fa fa-users')).$this->Html->tag('span', ' Ubicaciones', array('class' => 'nav-link-text')),array('controller' => 'Locations','action' => 'index'),
          array('class' => 'nav-link',
            'escape'=> false)
        );
        ?>
>>>>>>> origin/Develop
      </li>
    </ul>
    <ul class="navbar-nav sidenav-toggler">
      <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
          <i class="fa fa-fw fa-angle-left"></i>
        </a>
      </li>
    </ul>
<<<<<<< HEAD
    <ul class="navbar-nav ml-auto">        
=======
    <ul class="navbar-nav ml-auto">
        

>>>>>>> origin/Develop
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
          <i class="fa fa-fw fa-sign-out"></i>Salir</a>
        </li>
      </ul>
<<<<<<< HEAD
    </div>
  </nav>

  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="container">
       <?= $this->Flash->render() ?>
       <div class="clearfix"></div>
       <?= $this->fetch('content') ?>
     </div>
   </div>
 </div>
 <!-- /.container-fluid-->
 <!-- /.content-wrapper-->


 <footer class="sticky-footer">
  <div class="container">
    <div class="text-center">
      <small>Copyright Decanatura 2018</small>
    </div>
=======
    </div>
  </nav>



  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="container">
       <?= $this->Flash->render() ?>
       <div class="clearfix"></div>
       <?= $this->fetch('content') ?>
     </div>
   </div>
 </div>
 <!-- /.container-fluid-->
 <!-- /.content-wrapper-->


 <footer class="sticky-footer">
  <div class="container">
    <div class="text-center">
      <small>Copyright Decanatura 2018</small>
    </div>
>>>>>>> origin/Develop
  </div>
</footer>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fa fa-angle-up"></i>
</a>
<!-- Logout Modal-->




<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
<<<<<<< HEAD
        <h5 class="modal-title" id="exampleModalLabel">¿List@ para salir?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Seleccione "Salir" para cerrar sesión.</div>
=======
        <h5 class="modal-title" id="exampleModalLabel">Â¿List@ para salir?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">Ã—</span>
        </button>
      </div>
      <div class="modal-body">Seleccione "Salir" para cerrar sesiÃ³n.</div>
>>>>>>> origin/Develop
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-primary" href="users/logout">Salir</a>
      </div>
    </div>
  </div>
<<<<<<< HEAD
=======
</div>
>>>>>>> origin/Develop



  <?=
  $this->Html->script([ 'plugins/jquery/jquery.min.js','plugins/bootstrap/js/bootstrap.bundle.min.js' ,'sb-admin.min.js',
    'plugins/jquery-easing/jquery.easing.min.js','plugins/datatables/jquery.dataTables.js','plugins/datatables/dataTables.bootstrap4.js',
    'sb-admin-datatables.min.js'
  ])
  ?>


<<<<<<< HEAD


</div>
<!-- Bootstrap core JavaScript-->

=======
>>>>>>> origin/Develop
</body>
</html>






<<<<<<< HEAD
=======


>>>>>>> origin/Develop
