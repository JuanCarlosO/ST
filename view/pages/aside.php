<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="view/dist/img/icono_st.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p class="profile_name"></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> En línea</a>
        </div>
      </div>

      <!-- Dependiendo el perfil del usuario el menu debera cambiar -->
      <?php if ( $_SESSION['perfil_id'] == 1 ): ?>
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Perfil: Solicitante </li>
          <!-- Optionally, you can add icons to the links -->
          <li id="option_aside_1" class=""><a href="index.php?menu=general"><i class="fa fa-pencil"></i> <span>Crear solicitud</span></a></li>
          <li id="option_aside_2" class=""><a href="index.php?menu=listar"><i class="fa fa-book"></i> <span>Listar solicitudes</span></a></li>
          <li id="option_aside_3" class=""><a href="index.php?menu=inst"><i class="fa fa-book"></i> <span>Instructivos</span></a></li>
        </ul>
      <?php elseif ( $_SESSION['perfil_id'] == 2 ): ?>
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Perfil: Soporte Técnico </li>
          <li class="treeview " id="listados" >
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>Listar de solicitudes</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="new" class=""><a href="index.php?menu=general"><i class="fa fa-bell-o"></i>Todas</a></li>
              <li id="alls"><a href="index.php?menu=all"><i class="fa fa-book"></i>Histórico</a></li>
            </ul>
          </li>
          <li id="create_sol" class=""><a href="index.php?menu=create"><i class="fa fa-pencil"></i> <span>Crear solicitud</span></a></li>
          <li id="reports" class=""><a href="index.php?menu=report"><i class="fa fa-file-excel-o"></i> <span>Reportes</span></a></li>
          <li id="repair" class=""><a href="index.php?menu=repair"><i class="fa  fa-wrench"></i> <span>Reparación</span></a></li>

          <!-- 
          <li id="estad" class=""><a href="index.php?menu=esta"><i class="fa fa-line-chart"></i> <span>Estadística</span></a></li> -->
          <!-- 
          <li class="treeview " id="bienes" >
            <a href="#">
              <i class="fa fa-desktop"></i> <span>Bienes</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="alta" class=""><a href="index.php?menu=new_bien"><i class="fa fa-pencil"></i>Agregar</a></li>
              <li id="lis_bien"><a href="index.php?menu=l_bien"><i class="fa fa-list"></i>Listar</a></li>
              <li id="alls"><a href="index.php?menu=all"><i class="fa fa-cubes"></i>Gestionar</a></li>
            </ul>
          </li> -->
        </ul>
      <?php elseif ( $_SESSION['perfil_id'] == 3 ):#Perfil STI ?>
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Perfil: <b><big> S.T.I.</big></b> </li>
          <li class="treeview " id="menu_bienes">
            <a href="#"><i class="fa  fa-television"></i> <span>Bienes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <li id="submenu_listado"><a href="index.php?menu=general"><i class="fa fa-list-ol"></i> Listado</a></li>
              <li id="submenu_alta"><a href="index.php?menu=new_bien"><i class="fa fa-plus"></i> Alta</a></li>
              <!-- <li id="submenu_estadistica"><a href="index.php?menu=generate_esta"><i class="fa fa-line-chart"></i> Estadística</a> </li>-->
              <!-- <li id="submenu_presta"><a href="index.php?menu=presta"><i class="fa fa-reply"></i> Préstamos</a></li> -->
              <!-- <li id="submenu_reasigna"><a href="index.php?menu=reasigna"><i class="fa fa-exchange"></i>  Reasignaciones</a></li> -->
              <li id="submenu_bajas"><a href="index.php?menu=trash"><i class="fa fa-trash"></i>Bajas</a></li>
             <!--  <li id="submenu_asignaciones"><a href="index.php?menu=asignaciones"><i class="fa fa-reply"></i>Asignaciones</a></li> -->
            </ul>
          </li>
          <li class="treeview " id="menu_reparacion">
            <a href="#"><i class="fa fa-wrench"></i> <span>Reparaciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <li id="submenu_r_ext"><a href="index.php?menu=reparacion_ext"><i class="fa fa-plane"></i> Externas</a></li>
              <li id="submenu_r_int"><a href="index.php?menu=reparacion_int"><i class="fa fa-building"></i> Internas</a></li>
            </ul> 
          </li>
          
          <li class="treeview " id="menu_personal">
            <a href="index.php?menu=report"><i class="fa fa-users"></i> <span>Personal</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <li id="submenu_listadoper"><a href="index.php?menu=list_person"><i class="fa  fa-desktop"></i> Listado</a></li>
              <li id="submenu_altaper"><a href="index.php?menu=new_person"><i class="fa fa-user"></i> Alta </a></li>
            </ul>
          </li>
          
          <li class="treeview" id="menu_st">
            <a href="#">
              <i class="fa fa-plug"></i> <span>Soporte Técnico</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="option_aside_1"><a href="index.php?menu=new_sol"><i class="fa fa-pencil"></i> Crear solicitud</a></li>
              <li class="treeview" id="submenu_reportes">
                <a href="#"><i class="fa fa-file-excel-o"></i> <span>Reportes</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                  <li id="submenu2_equipo"><a href="index.php?menu=r_equipo"><i class="fa  fa-desktop"></i> Por equipo</a></li>
                  <li id="submenu2_user"><a href="index.php?menu=r_user"><i class="fa fa-user"></i> Por usuario</a></li>
                  <li id="submenu2_fail"><a href="index.php?menu=r_fail"><i class="fa fa-warning"></i> Por falla específica</a></li>
                  <!-- <li id="submenu2_historial"><a href="index.php?menu=r_history"><i class="fa  fa-list-ol"></i> Historial de asignaciones</a></li> -->
                  
                  
                </ul>
              </li>
            </ul>
          </li>
          <li id="option_cloud">
            <a href="index.php?menu=cloud"><i class="fa fa-cloud"></i> <span>Carpeta digital</span></a>
          </li>
        </ul>
      <?php elseif ( $_SESSION['perfil_id'] == 4 ): ?>
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Perfil: Bienes </li>
          <!-- Optionally, you can add icons to the links -->
          <li id="option_aside_1" class=""><a href="index.php?menu=add"><i class="fa fa-pencil"></i> <span>Alta de bien </span></a></li>
          <li id="option_aside_2" class=""><a href="index.php?menu=general"><i class="fa fa-book"></i> <span>Listar bienes</span></a></li>
          <li class="treeview" id="submenu_reportes">
            <a href="#"><i class="fa fa-file-excel-o"></i> <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <li id="submenu2_equipo"><a href="index.php?menu=r_equipo"><i class="fa  fa-desktop"></i> Por equipo</a></li>
              <li id="submenu2_user"><a href="index.php?menu=r_user"><i class="fa fa-user"></i> Por usuario</a></li>
              
            </ul>
          </li>
        </ul>
      <?php endif ?>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

