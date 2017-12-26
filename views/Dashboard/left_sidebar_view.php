<div class="fixed-sidebar-left">
  <ul id="principal-navbar" class="nav navbar-nav side-nav nicescroll-bar">
    <li class="navigation-header">
      <span>Menú Principal</span> 
      <i class="zmdi zmdi-more"></i>
    </li>
    <?php
      if($userRole == 'superadmin') {
        ?>
          <li class="menu-click">
            <a href="#!/Entities"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Gestionar Agencias</span></div><div class="clearfix"></div></a>
          </li>
        <?php
      } else if($userRole == 'admin' || $userRole == 'subagencia') {
        ?>
          <li class="menu-click" id="client-management">
            <a href="#"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Gestionar Clientes</span></div><div class="clearfix"></div></a>
          </li>
          <li class="menu-click" id="category-management">
            <a href="#"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Gestionar Categorías</span></div><div class="clearfix"></div></a>
          </li>
          <li class="menu-click" id="item-management">
            <a href="#"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Gestionar Artículos</span></div><div class="clearfix"></div></a>
          </li>
        <?php
      } else {
        ?>
          <li class="menu-click">
            <a href="#!/Clients/ViewInvoices"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Mis Facturas</span></div><div class="clearfix"></div></a>
          </li>
        <?php
      }
    ?>
    <!-- <li class="navigation-header">
      <span>Menú Clientes</span> 
      <i class="zmdi zmdi-more"></i>
    </li>
    <li class="menu-click" id="upgrade-request">
      <a href="#"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Solicitar Upgrade</span></div><div class="clearfix"></div></a>
    </li> -->
  </ul>
</div>