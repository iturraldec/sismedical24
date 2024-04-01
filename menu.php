<?php 
if(isset($_SESSION['acceso'])) { 
  if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION['acceso'] == "enfermera" || $_SESSION['acceso'] == "medico") {

$count = new Login();
//$p = $count->ContarRegistros();
?>


<?php 
switch($_SESSION['acceso'])  {

case 'administrador':  ?>

        <!--  BEGIN TOPBAR  -->
        <div class="topbar-nav header navbar" role="banner">
            <nav id="topbar">
                <ul class="navbar-nav theme-brand flex-row  text-center">
                    <li class="nav-item theme-logo">
                        <a href="panel">
                            <img src="assets/img/logo2.svg" class="navbar-logo" alt="logo">
                        </a>
                    </li>
                    <li class="nav-item theme-text">
                        <a href="panel" class="nav-link"> CLINIC </a>
                    </li>
                </ul>

                <ul class="list-unstyled menu-categories" id="topAccordion">

                    <li class="menu single-menu active">
                        <a href="panel">
                            <div class="">
                                <span><i data-feather="home"></i>Panel</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu single-menu">
                        <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span><i data-feather="settings"></i>Administración</span>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="app" data-parent="#topAccordion">
                            <li class="sub-sub-submenu-list">
                                <a href="#datatable" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Configuración 
                                    <i data-feather="chevron-right"></i>
                                </a>
                                <ul class="collapse list-unstyled sub-submenu" id="datatable" data-parent="#datatable">
                                    <li>
                                        <a href="configuracion"> Configuración</a>
                                    </li>
                                    <li>
                                        <a href="documentos"> Tipos Documentos </a>
                                    </li>
                                    <li>
                                        <a href="seguros"> Seguros Privados </a>
                                    </li>
                                    <li>
                                        <a href="especialidades"> Especialidades </a>
                                    </li>
                                    <li>
                                        <a href="valores"> Valores Laboratorio </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="sucursales"> Sucursales </a>
                            </li>
                            <li>
                                <a href="plantillasecograficas"> Plantillas Ecograficas </a>
                            </li>
                            <li>
                                <a href="plantillaslecturarx"> Plantillas Lectura Rx </a>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#datatable" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Seguridad 
                                    <i data-feather="chevron-right"></i>
                                </a>
                                <ul class="collapse list-unstyled sub-submenu" id="datatable" data-parent="#datatable">
                                    <li>
                                        <a href="usuarios"> Usuarios</a>
                                    </li>
                                    <li>
                                        <a href="logs"> Historial de Acceso</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#datatable" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Base de Datos 
                                    <i data-feather="chevron-right"></i>
                                </a>
                                <ul class="collapse list-unstyled sub-submenu" id="datatable" data-parent="#datatable">
                                    <li>
                                        <a href="backup"> Backup</a>
                                    </li>
                                    <li>
                                        <a href="restore"> Restore</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="menu single-menu">
                        <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span><i data-feather="users"></i>Mantenimiento</span>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="app" data-parent="#topAccordion">
                            <li class="sub-sub-submenu-list">
                                <a href="#datatable" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Médicos 
                                    <i data-feather="chevron-right"></i>
                                </a>
                                <ul class="collapse list-unstyled sub-submenu" id="datatable" data-parent="#datatable">
                                    <li>
                                        <a href="formedico"> Nuevo Médico</a>
                                    </li>
                                    <li>
                                        <a href="medicos"> Búsqueda General</a>
                                    </li>
                                    <li>
                                        <a href="medicosxsucursal"> Médicos x Sucursal</a>
                                    </li>
                                    <li>
                                        <a href="horarios"> Horarios Asignados </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="pacientes"> Pacientes </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu single-menu">
                        <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span><i data-feather="calendar"></i>Citas Médicas</span>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="app" data-parent="#topAccordion">
                            <li>
                                <a href="forcita"> Nueva Cita </a>
                            </li>
                            <li>
                                <a href="citasmedicas"> Búsqueda General </a>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#datatable" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Reportes 
                                    <i data-feather="chevron-right"></i>
                                </a>
                                <ul class="collapse list-unstyled sub-submenu" id="datatable" data-parent="#datatable">
                                    <li>
                                        <a href="citasxfechas"> Citas x Fechas</a>
                                    </li>
                                    <li>
                                        <a href="citasxmedicos"> Citas x Médico</a>
                                    </li>
                                    <li>
                                        <a href="citasxpacientes"> Citas x Pacientes</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="menu single-menu">
                        <a href="#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                            <div class="">
                                <i data-feather="folder-plus"></i><span>Módulos Médicos</span>
                            </div>
                            <i data-feather="chevron-down"></i>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="menu2" data-parent="#topAccordion">
                            <!--<li>
                                <a href="javascript:void(0);"> Submenu 1 </a>
                            </li>-->
                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Consultorio <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="aperturasc"> Apertura de Historias </a>
                                    </li>
                                    <li>
                                        <a href="hojasc"> Hojas Evolutivas </a>
                                    </li>
                                    <li>
                                        <a href="remisionesc"> Remisiones </a>
                                    </li>
                                    <li>
                                        <a href="formulasmedicasc"> Recetas Médicas </a>
                                    </li>
                                    <li>
                                        <a href="ordenesmedicasc"> Órdenes Médicas </a>
                                    </li>
                                    <li>
                                        <a href="formulasterapias"> Fórmulas Terapias </a>
                                    </li>
                                    <li>
                                        <a href="solicitudexamenes"> Solicitud Examenes </a>
                                    </li>
                                    <li>
                                        <a href="consultoriosxfechas"> Consultorio x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="consultoriosxmedicos"> Consultorio x Médico </a>
                                    </li>
                                    <li>
                                        <a href="consultoriosxpacientes"> Consultorio x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Ginecología <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="aperturasg"> Apertura de Historias </a>
                                    </li>
                                    <li>
                                        <a href="hojasg"> Hojas Evolutivas </a>
                                    </li>
                                    <li>
                                        <a href="remisionesg"> Remisiones </a>
                                    </li>
                                    <li>
                                        <a href="formulasmedicasg"> Fórmulas Médicas </a>
                                    </li>
                                    <li>
                                        <a href="ordenesmedicasg"> Órdenes Médicas </a>
                                    </li>
                                    <li>
                                        <a href="criocauterizaciones"> Criocauterización </a>
                                    </li>
                                    <li>
                                        <a href="colposcopias"> Colposcopias </a>
                                    </li>
                                    <li>
                                        <a href="ecografias"> Ecografías </a>
                                    </li>
                                    <li>
                                        <a href="ginecologiasxfechas"> Ginecología x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="ginecologiasxmedicos"> Ginecología x Médico </a>
                                    </li>
                                    <li>
                                        <a href="ginecologiasxpacientes"> Ginecología x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Laboratorio <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="forlaboratorio"> Nuevo Examen </a>
                                    </li>
                                    <li>
                                        <a href="laboratorios"> Búsqueda General </a>
                                    </li>
                                    <li>
                                        <a href="laboratoriosxfechas"> Exámenes x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="laboratoriosxmedicos"> Exámenes x Médico </a>
                                    </li>
                                    <li>
                                        <a href="laboratoriosxpacientes"> Exámenes x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Imagenes <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="forradiologia"> Nueva Imagenen </a>
                                    </li>
                                    <li>
                                        <a href="radiologias"> Búsqueda General </a>
                                    </li>
                                    <li>
                                        <a href="radiologiasxfechas"> Imagenes x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="radiologiasxmedicos"> Imagenes x Médico </a>
                                    </li>
                                    <li>
                                        <a href="radiologiasxpacientes"> Imagenes x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Consent. Informados <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="forconsentimiento"> Nuevo Consentimiento </a>
                                    </li>
                                    <li>
                                        <a href="consentimientos"> Búsqueda General </a>
                                    </li>
                                    <li>
                                        <a href="consentimientosxfechas"> Consent. x Fechas</a>
                                    </li>
                                    <li>
                                        <a href="consentimientosxmedicos"> Consent. x Médico</a>
                                    </li>
                                    <li>
                                        <a href="consentimientosxpacientes"> Consent. x Pacientes</a>
                                    </li>
                                </ul>
                            </li>


                        </ul>
                    </li>


                    <li class="menu single-menu">
                        <a href="logout">
                            <div class="">
                                <span><i data-feather="power"></i>Cerrar Sesión</span>
                            </div>
                        </a>
                    </li>
                    
                </ul>
            </nav>
        </div>
        <!--  END TOPBAR  -->

<?php
break;
case 'secretaria': ?>

        <!--  BEGIN TOPBAR  -->
        <div class="topbar-nav header navbar" role="banner">
            <nav id="topbar">
                <ul class="navbar-nav theme-brand flex-row  text-center">
                    <li class="nav-item theme-logo">
                        <a href="panel">
                            <img src="assets/img/logo2.svg" class="navbar-logo" alt="logo">
                        </a>
                    </li>
                    <li class="nav-item theme-text">
                        <a href="panel" class="nav-link"> CLINIC </a>
                    </li>
                </ul>

                <ul class="list-unstyled menu-categories" id="topAccordion">

                    <li class="menu single-menu active">
                        <a href="panel">
                            <div class="">
                                <span><i data-feather="home"></i>Panel</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu single-menu">
                        <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span><i data-feather="settings"></i>Administración</span>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="app" data-parent="#topAccordion">
                            <li class="sub-sub-submenu-list">
                            
                            <li>
                                <a href="documentos"> Tipos Documentos </a>
                            </li>
                            <li>
                                <a href="seguros"> Seguros Privados </a>
                            </li>
                            <li>
                                <a href="especialidades"> Especialidades </a>
                            </li>
                            <li>
                                <a href="plantillasecograficas"> Plantillas Ecograficas </a>
                            </li>
                            <li>
                                <a href="plantillaslecturarx"> Plantillas Lectura Rx </a>
                            </li>

                        </ul>
                    </li>

                    <li class="menu single-menu">
                        <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span><i data-feather="users"></i>Mantenimiento</span>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="app" data-parent="#topAccordion">
                            <li class="sub-sub-submenu-list">
                                <a href="#datatable" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Médicos 
                                    <i data-feather="chevron-right"></i>
                                </a>
                                <ul class="collapse list-unstyled sub-submenu" id="datatable" data-parent="#datatable">
                                    <li>
                                        <a href="formedico"> Nuevo Médico</a>
                                    </li>
                                    <li>
                                        <a href="medicos"> Búsqueda General</a>
                                    </li>
                                    <li>
                                        <a href="medicosxsucursal"> Médicos x Sucursal</a>
                                    </li>
                                    <li>
                                        <a href="horarios"> Horarios Asignados </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="pacientes"> Pacientes </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu single-menu">
                        <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span><i data-feather="calendar"></i>Citas Médicas</span>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="app" data-parent="#topAccordion">
                            <li>
                                <a href="forcita"> Nueva Cita </a>
                            </li>
                            <li>
                                <a href="citasmedicas"> Búsqueda General </a>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#datatable" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Reportes 
                                    <i data-feather="chevron-right"></i>
                                </a>
                                <ul class="collapse list-unstyled sub-submenu" id="datatable" data-parent="#datatable">
                                    <li>
                                        <a href="citasxfechas"> Citas x Fechas</a>
                                    </li>
                                    <li>
                                        <a href="citasxmedicos"> Citas x Médico</a>
                                    </li>
                                    <li>
                                        <a href="citasxpacientes"> Citas x Pacientes</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="menu single-menu">
                        <a href="#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                            <div class="">
                                <i data-feather="folder-plus"></i><span>Módulos Médicos</span>
                            </div>
                            <i data-feather="chevron-down"></i>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="menu2" data-parent="#topAccordion">
                            <!--<li>
                                <a href="javascript:void(0);"> Submenu 1 </a>
                            </li>-->
                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Consultorio <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="aperturasc"> Apertura de Historias </a>
                                    </li>
                                    <li>
                                        <a href="hojasc"> Hojas Evolutivas </a>
                                    </li>
                                    <li>
                                        <a href="remisionesc"> Remisiones </a>
                                    </li>
                                    <li>
                                        <a href="formulasmedicasc"> Fórmulas Médicas </a>
                                    </li>
                                    <li>
                                        <a href="ordenesmedicasc"> Órdenes Médicas </a>
                                    </li>
                                    <li>
                                        <a href="formulasterapias"> Fórmulas Terapias </a>
                                    </li>
                                    <li>
                                        <a href="solicitudexamenes"> Solicitud Examenes </a>
                                    </li>
                                    <li>
                                        <a href="consultoriosxfechas"> Consultorio x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="consultoriosxmedicos"> Consultorio x Médico </a>
                                    </li>
                                    <li>
                                        <a href="consultoriosxpacientes"> Consultorio x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Ginecología <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="aperturasg"> Apertura de Historias </a>
                                    </li>
                                    <li>
                                        <a href="hojasg"> Hojas Evolutivas </a>
                                    </li>
                                    <li>
                                        <a href="remisionesg"> Remisiones </a>
                                    </li>
                                    <li>
                                        <a href="formulasmedicasg"> Fórmulas Médicas </a>
                                    </li>
                                    <li>
                                        <a href="ordenesmedicasg"> Órdenes Médicas </a>
                                    </li>
                                    <li>
                                        <a href="criocauterizaciones"> Criocauterización </a>
                                    </li>
                                    <li>
                                        <a href="colposcopias"> Colposcopias </a>
                                    </li>
                                    <li>
                                        <a href="ecografias"> Ecografías </a>
                                    </li>
                                    <li>
                                        <a href="ginecologiasxfechas"> Ginecología x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="ginecologiasxmedicos"> Ginecología x Médico </a>
                                    </li>
                                    <li>
                                        <a href="ginecologiasxpacientes"> Ginecología x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Laboratorio <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="laboratorios"> Búsqueda General </a>
                                    </li>
                                    <li>
                                        <a href="laboratoriosxfechas"> Exámenes x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="laboratoriosxmedicos"> Exámenes x Médico </a>
                                    </li>
                                    <li>
                                        <a href="laboratoriosxpacientes"> Exámenes x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Imagenes <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="radiologias"> Búsqueda General </a>
                                    </li>
                                    <li>
                                        <a href="radiologiasxfechas"> Imagenes x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="radiologiasxmedicos"> Imagenes x Médico </a>
                                    </li>
                                    <li>
                                        <a href="radiologiasxpacientes"> Imagenes x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Terapeuta <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="terapias"> Búsqueda General </a>
                                    </li>
                                    <li>
                                        <a href="terapiasxfechas"> Terapias x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="terapiasxmedicos"> Terapias x Médico </a>
                                    </li>
                                    <li>
                                        <a href="terapiasxpacientes"> Terapias x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Odontología <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="odontologias"> Búsqueda General </a>
                                    </li>
                                    <li>
                                        <a href="odontologiasxfechas"> Odontología x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="odontologiasxmedicos"> Odontología x Médico </a>
                                    </li>
                                    <li>
                                        <a href="odontologiasxpacientes"> Odontología x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Consent. Informados <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="consentimientos"> Búsqueda General </a>
                                    </li>
                                    <li>
                                        <a href="consentimientosxfechas"> Consent. x Fechas</a>
                                    </li>
                                    <li>
                                        <a href="consentimientosxmedicos"> Consent. x Médico</a>
                                    </li>
                                    <li>
                                        <a href="consentimientosxpacientes"> Consent. x Pacientes</a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </li>

                    <li class="menu single-menu">
                        <a href="logout">
                            <div class="">
                                <span><i data-feather="power"></i>Cerrar Sesión</span>
                            </div>
                        </a>
                    </li>
                    
                </ul>
            </nav>
        </div>
        <!--  END TOPBAR  -->

<?php
break;
case 'enfermera': ?>


        <!--  BEGIN TOPBAR  -->
        <div class="topbar-nav header navbar" role="banner">
            <nav id="topbar">
                <ul class="navbar-nav theme-brand flex-row  text-center">
                    <li class="nav-item theme-logo">
                        <a href="panel">
                            <img src="assets/img/logo2.svg" class="navbar-logo" alt="logo">
                        </a>
                    </li>
                    <li class="nav-item theme-text">
                        <a href="panel" class="nav-link"> CLINIC </a>
                    </li>
                </ul>

                <ul class="list-unstyled menu-categories" id="topAccordion">

                    <li class="menu single-menu active">
                        <a href="panel">
                            <div class="">
                                <span><i data-feather="home"></i>Panel</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu single-menu">
                        <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span><i data-feather="settings"></i>Administración</span>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="app" data-parent="#topAccordion">
                            <li class="sub-sub-submenu-list">
                            
                            <li>
                                <a href="documentos"> Tipos Documentos </a>
                            </li>
                            <li>
                                <a href="seguros"> Seguros Privados </a>
                            </li>
                            <li>
                                <a href="especialidades"> Especialidades </a>
                            </li>
                            <li>
                                <a href="valores"> Valores Laboratorio </a>
                            </li>
                            <li>
                                <a href="plantillasecograficas"> Plantillas Ecograficas </a>
                            </li>
                            <li>
                                <a href="plantillaslecturarx"> Plantillas Lectura Rx </a>
                            </li>

                        </ul>
                    </li>

                    <li class="menu single-menu">
                        <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span><i data-feather="users"></i>Mantenimiento</span>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="app" data-parent="#topAccordion">
                            <li class="sub-sub-submenu-list">
                                <a href="#datatable" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Médicos 
                                    <i data-feather="chevron-right"></i>
                                </a>
                                <ul class="collapse list-unstyled sub-submenu" id="datatable" data-parent="#datatable">
                                    <li>
                                        <a href="formedico"> Nuevo Médico</a>
                                    </li>
                                    <li>
                                        <a href="medicos"> Búsqueda General</a>
                                    </li>
                                    <li>
                                        <a href="medicosxsucursal"> Médicos x Sucursal</a>
                                    </li>
                                    <li>
                                        <a href="horarios"> Horarios Asignados </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="pacientes"> Pacientes </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu single-menu">
                        <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span><i data-feather="calendar"></i>Citas Médicas</span>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="app" data-parent="#topAccordion">
                            <li>
                                <a href="forcita"> Nueva Cita </a>
                            </li>
                            <li>
                                <a href="citasmedicas"> Búsqueda General </a>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#datatable" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Reportes 
                                    <i data-feather="chevron-right"></i>
                                </a>
                                <ul class="collapse list-unstyled sub-submenu" id="datatable" data-parent="#datatable">
                                    <li>
                                        <a href="citasxfechas"> Citas x Fechas</a>
                                    </li>
                                    <li>
                                        <a href="citasxmedicos"> Citas x Médico</a>
                                    </li>
                                    <li>
                                        <a href="citasxpacientes"> Citas x Pacientes</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="menu single-menu">
                        <a href="#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                            <div class="">
                                <i data-feather="folder-plus"></i><span>Módulos Médicos</span>
                            </div>
                            <i data-feather="chevron-down"></i>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="menu2" data-parent="#topAccordion">
                            <!--<li>
                                <a href="javascript:void(0);"> Submenu 1 </a>
                            </li>-->
                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Consultorio <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="aperturasc"> Apertura de Historias </a>
                                    </li>
                                    <li>
                                        <a href="hojasc"> Hojas Evolutivas </a>
                                    </li>
                                    <li>
                                        <a href="remisionesc"> Remisiones </a>
                                    </li>
                                    <li>
                                        <a href="formulasmedicasc"> Fórmulas Médicas </a>
                                    </li>
                                    <li>
                                        <a href="ordenesmedicasc"> Órdenes Médicas </a>
                                    </li>
                                    <li>
                                        <a href="formulasterapias"> Fórmulas Terapias </a>
                                    </li>
                                    <li>
                                        <a href="solicitudexamenes"> Solicitud Examenes </a>
                                    </li>
                                    <li>
                                        <a href="consultoriosxfechas"> Consultorio x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="consultoriosxmedicos"> Consultorio x Médico </a>
                                    </li>
                                    <li>
                                        <a href="consultoriosxpacientes"> Consultorio x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Ginecología <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="aperturasg"> Apertura de Historias </a>
                                    </li>
                                    <li>
                                        <a href="hojasg"> Hojas Evolutivas </a>
                                    </li>
                                    <li>
                                        <a href="remisionesg"> Remisiones </a>
                                    </li>
                                    <li>
                                        <a href="formulasmedicasg"> Fórmulas Médicas </a>
                                    </li>
                                    <li>
                                        <a href="ordenesmedicasg"> Órdenes Médicas </a>
                                    </li>
                                    <li>
                                        <a href="criocauterizaciones"> Criocauterización </a>
                                    </li>
                                    <li>
                                        <a href="colposcopias"> Colposcopias </a>
                                    </li>
                                    <li>
                                        <a href="ecografias"> Ecografías </a>
                                    </li>
                                    <li>
                                        <a href="ginecologiasxfechas"> Ginecología x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="ginecologiasxmedicos"> Ginecología x Médico </a>
                                    </li>
                                    <li>
                                        <a href="ginecologiasxpacientes"> Ginecología x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Laboratorio <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="forlaboratorio"> Nuevo Examen </a>
                                    </li>
                                    <li>
                                        <a href="laboratorios"> Búsqueda General </a>
                                    </li>
                                    <li>
                                        <a href="laboratoriosxfechas"> Exámenes x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="laboratoriosxmedicos"> Exámenes x Médico </a>
                                    </li>
                                    <li>
                                        <a href="laboratoriosxpacientes"> Exámenes x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Imagenes <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="forradiologia"> Nueva Imagenen </a>
                                    </li>
                                    <li>
                                        <a href="radiologias"> Búsqueda General </a>
                                    </li>
                                    <li>
                                        <a href="radiologiasxfechas"> Imagenes x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="radiologiasxmedicos"> Imagenes x Médico </a>
                                    </li>
                                    <li>
                                        <a href="radiologiasxpacientes"> Imagenes x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Terapeuta <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="forterapia"> Nueva Terapia </a>
                                    </li>
                                    <li>
                                        <a href="terapias"> Búsqueda General </a>
                                    </li>
                                    <li>
                                        <a href="terapiasxfechas"> Terapias x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="terapiasxmedicos"> Terapias x Médico </a>
                                    </li>
                                    <li>
                                        <a href="terapiasxpacientes"> Terapias x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Odontología <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="forodontologia"> Nueva Odontología </a>
                                    </li>
                                    <li>
                                        <a href="forhojaodontologia"> Hoja Evolutiva </a>
                                    </li>
                                    <li>
                                        <a href="odontologias"> Búsqueda General </a>
                                    </li>
                                    <li>
                                        <a href="odontologiasxfechas"> Odontología x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="odontologiasxmedicos"> Odontología x Médico </a>
                                    </li>
                                    <li>
                                        <a href="odontologiasxpacientes"> Odontología x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Consent. Informados <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="forconsentimiento"> Nuevo Consentimiento </a>
                                    </li>
                                    <li>
                                        <a href="consentimientos"> Búsqueda General </a>
                                    </li>
                                    <li>
                                        <a href="consentimientosxfechas"> Consent. x Fechas</a>
                                    </li>
                                    <li>
                                        <a href="consentimientosxmedicos"> Consent. x Médico</a>
                                    </li>
                                    <li>
                                        <a href="consentimientosxpacientes"> Consent. x Pacientes</a>
                                    </li>
                                </ul>
                            </li>


                        </ul>
                    </li>

                    <li class="menu single-menu">
                        <a href="logout">
                            <div class="">
                                <span><i data-feather="power"></i>Cerrar Sesión</span>
                            </div>
                        </a>
                    </li>
                    
                </ul>
            </nav>
        </div>
        <!--  END TOPBAR  -->

<?php
break;
case 'medico': ?>


        <!--  BEGIN TOPBAR  -->
        <div class="topbar-nav header navbar" role="banner">
            <nav id="topbar">
                <ul class="navbar-nav theme-brand flex-row  text-center">
                    <li class="nav-item theme-logo">
                        <a href="panel">
                            <img src="assets/img/logo2.svg" class="navbar-logo" alt="logo">
                        </a>
                    </li>
                    <li class="nav-item theme-text">
                        <a href="panel" class="nav-link"> CLINIC </a>
                    </li>
                </ul>

                <ul class="list-unstyled menu-categories" id="topAccordion">

                    <li class="menu single-menu active">
                        <a href="panel">
                            <div class="">
                                <span><i data-feather="home"></i>Panel</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu single-menu">
                        <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span><i data-feather="settings"></i>Administración</span>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="app" data-parent="#topAccordion">
                            <li>
                                <a href="edit_datos"> Actualizar Datos </a>
                            </li>

                            <li>
                                <a href="horarios"> Consultar Horarios </a>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="menu single-menu">
                        <a href="pacientes">
                            <div class="">
                                <span><i data-feather="users"></i>Pacientes</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu single-menu">
                        <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span><i data-feather="calendar"></i>Citas Médicas</span>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="app" data-parent="#topAccordion">
                            <li>
                                <a href="forcita"> Nueva Cita </a>
                            </li>
                            <li>
                                <a href="citasmedicas"> Búsqueda General </a>
                            </li>
                            <li>
                                <a href="citasxfechas"> Citas x Fechas</a>
                            </li>
                            <li>
                                <a href="citasxpacientes"> Citas x Pacientes</a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu single-menu">
                        <a href="#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                            <div class="">
                                <i data-feather="folder-plus"></i><span>Módulos Médicos</span>
                            </div>
                            <i data-feather="chevron-down"></i>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="menu2" data-parent="#topAccordion">

                        <?php
                        $modulos = explode(",", $_SESSION['modulos']);

                        if(in_array("1", $modulos)){ ?>
                            
                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Consultorio <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="aperturasc"> Apertura de Historias </a>
                                    </li>
                                    <li>
                                        <a href="hojasc"> Hojas Evolutivas </a>
                                    </li>
                                    <li>
                                        <a href="remisionesc"> Remisiones </a>
                                    </li>
                                    <li>
                                        <a href="formulasmedicasc"> Fórmulas Médicas </a>
                                    </li>
                                    <li>
                                        <a href="ordenesmedicasc"> Órdenes Médicas </a>
                                    </li>
                                    <li>
                                        <a href="formulasterapias"> Fórmulas Terapias </a>
                                    </li>
                                    <li>
                                        <a href="solicitudexamenes"> Solicitud Examenes </a>
                                    </li>
                                    <li>
                                        <a href="consultoriosxfechas"> Consultorio x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="consultoriosxpacientes"> Consultorio x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                        <?php } ?>

                        <?php
                        if(in_array("2", $modulos)){ ?>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Ginecología <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="aperturasg"> Apertura de Historias </a>
                                    </li>
                                    <li>
                                        <a href="hojasg"> Hojas Evolutivas </a>
                                    </li>
                                    <li>
                                        <a href="remisionesg"> Remisiones </a>
                                    </li>
                                    <li>
                                        <a href="formulasmedicasg"> Fórmulas Médicas </a>
                                    </li>
                                    <li>
                                        <a href="ordenesmedicasg"> Órdenes Médicas </a>
                                    </li>
                                    <li>
                                        <a href="criocauterizaciones"> Criocauterización </a>
                                    </li>
                                    <li>
                                        <a href="colposcopias"> Colposcopias </a>
                                    </li>
                                    <li>
                                        <a href="ecografias"> Ecografías </a>
                                    </li>
                                    <li>
                                        <a href="ginecologiasxfechas"> Ginecología x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="ginecologiasxpacientes"> Ginecología x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                        <?php } ?>

                        <?php
                        if(in_array("3", $modulos)){ ?>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Laboratorio <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="forlaboratorio"> Nuevo Examen </a>
                                    </li>
                                    <li>
                                        <a href="laboratorios"> Búsqueda General </a>
                                    </li>
                                    <li>
                                        <a href="laboratoriosxfechas"> Exámenes x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="laboratoriosxpacientes"> Exámenes x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                        <?php } ?>

                        <?php
                        if(in_array("4", $modulos)){ ?>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Imagenes <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="forradiologia"> Nueva Imagenen </a>
                                    </li>
                                    <li>
                                        <a href="radiologias"> Búsqueda General </a>
                                    </li>
                                    <li>
                                        <a href="radiologiasxfechas"> Imagenes x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="radiologiasxpacientes"> Imagenes x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                        <?php } ?>

                        <?php
                        if(in_array("5", $modulos)){ ?>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Terapeuta <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="forterapia"> Nueva Terapia </a>
                                    </li>
                                    <li>
                                        <a href="terapias"> Búsqueda General </a>
                                    </li>
                                    <li>
                                        <a href="terapiasxfechas"> Terapias x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="terapiasxpacientes"> Terapias x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                        <?php } ?>

                        <?php
                        if(in_array("6", $modulos)){ ?>

                            <li class="sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Odontología <i data-feather="chevron-right"></i></a>
                                <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                                    <li>
                                        <a href="forodontologia"> Nueva Odontología </a>
                                    </li>
                                    <li>
                                        <a href="forhojaodontologia"> Hoja Evolutiva </a>
                                    </li>
                                    <li>
                                        <a href="odontologias"> Búsqueda General </a>
                                    </li>
                                    <li>
                                        <a href="odontologiasxfechas"> Odontología x Fechas </a>
                                    </li>
                                    <li>
                                        <a href="odontologiasxpacientes"> Odontología x Paciente </a>
                                    </li>
                                </ul>
                            </li>

                        <?php } ?>

                        </ul>
                    </li>

                    <li class="menu single-menu">
                        <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span><i data-feather="file-text"></i>Consent. Informado</span>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="app" data-parent="#topAccordion">
                            <li>
                                <a href="forconsentimiento"> Nuevo Consentimiento </a>
                            </li>
                            <li>
                                <a href="consentimientos"> Búsqueda General </a>
                            </li>

                            <li class="sub-sub-submenu-list">
                                <a href="#datatable" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Reportes 
                                    <i data-feather="chevron-right"></i>
                                </a>
                                <ul class="collapse list-unstyled sub-submenu" id="datatable" data-parent="#datatable">
                                    <li>
                                        <a href="consentimientosxfechas"> Consent. x Fechas</a>
                                    </li>
                                    <li>
                                        <a href="consentimientosxpacientes"> Consent. x Pacientes</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="menu single-menu">
                        <a href="logout">
                            <div class="">
                                <span><i data-feather="power"></i>Cerrar Sesión</span>
                            </div>
                        </a>
                    </li>
                    
                </ul>
            </nav>
        </div>
        <!--  END TOPBAR  -->

<?php
break; } ?>



<?php } else { ?>   
        <script type='text/javascript' language='javascript'>
        alert('NO TIENES PERMISO PARA ACCEDER A ESTA PAGINA.\nCONSULTA CON EL ADMINISTRADOR PARA QUE TE DE ACCESO')  
        document.location.href='panel'   
        </script> 
<?php } } else { ?>
        <script type='text/javascript' language='javascript'>
        alert('NO TIENES PERMISO PARA ACCEDER AL SISTEMA.\nDEBERA DE INICIAR SESION')  
        document.location.href='logout'  
        </script> 
<?php } ?> 