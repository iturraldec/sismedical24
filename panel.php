<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
     if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION['acceso'] == "enfermera" || $_SESSION['acceso'] == "medico") {

$tra = new Login();
$ses = $tra->ExpiraSession();       
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title></title>
    <link rel="icon" type="image/png" href="assets/img/favicon.png"/>
    <link href="assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <!-- script jquery -->
    <script src="assets/script/jquery.min.js"></script> 
    <script type="text/javascript" src="plugins/chart.js/chart.js"></script>
    <script type="text/javascript" src="plugins/chart.js/legend.js"></script>
    <script type="text/javascript" src="assets/script/graficos.js"></script>
    <!-- script jquery -->

</head>
<body onLoad="muestraReloj()" class="alt-menu sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="load_screen"> 
        <div class="loader">
        <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <?php include('membrete.php'); ?>
    <!--  BEGIN NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN TOPBAR  -->
        <?php include('menu.php'); ?>
        <!--  BEGIN TOPBAR  -->

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="page-header">
                    <div class="page-title">
                        <h3><i data-feather="grid"></i> Dashboard </h3>
                    </div>
                </div>

                <div class="row layout-top-spacing">

                    <?php
                    //$ginecologia = new Login();
                    //$ginecologia = $ginecologia->GraficosGinecologia();
                    ?>

                    <!-- GRAFICO DE CITAS MEDICAS -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-one">
                            <div class="widget-heading">
                                <h5 class="text-dark alert-link"><i data-feather="bar-chart-2"></i> Citas Médicas</h5>
                            </div>
                            <div class="widget-content">
                                <div align="center" id="chart-container" class="widget-content">
									<canvas id="barChart" width="100" height="30"></canvas>
									<!--<h5><div style="clear:left;font-size: 14px;" id="barLegendd"></div></h5>-->
								</div>
                            </div>
                            <script>
                        	$(document).ready(function () {
                            showGraphBarSucursales();
                            });
                            </script>
                        </div>
                    </div>
                    <!-- GRAFICO DE CITAS MEDICAS -->

                    <!-- GRAFICO DE SEXO -->
                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-two">
                            <div class="widget-heading">
                                <h5 class="text-dark alert-link"><i data-feather="bar-chart"></i> Pacientes por Sexo</h5>
                            </div>
                            <div class="widget-content">
                                <div id="canvas-holder">
                                    <canvas id="barChart3" width="50" height="40"/>
                                    <div style="clear:left;" id="barLegend3"></div>
                                </div>
                            </div>
                            <script>
                            $(document).ready(function () {
                                showGraphBarSexo();
                            });
                            </script>
                        </div>
                    </div>
                    <!-- GRAFICO DE SEXO -->

                    <!-- GRAFICO DE GINECOLOGIA -->
                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-two">
                            <div class="widget-heading">
                                <h5 class="text-dark alert-link"><i data-feather="pie-chart"></i> Ginecología</h5>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div align="center" id="canvas-holder" class="widget-content">
									<canvas id="pieChart" width="250" height="140"></canvas>
									<h5><div style="clear:left;font-size: 14px;" id="pieLegend"></div></h5>
								</div>
                            </div>
                            <script>
                        	$(document).ready(function () {
                            	showGraphDoughnut();
                            });
                            </script> 
                        </div>
                    </div>
                    <!-- GRAFICO DE GINECOLOGIA -->

                    <!-- GRAFICO DE RADIOLOGIA -->
                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-two">
                            <div class="widget-heading">
                                <h5 class="text-dark alert-link"><i data-feather="bar-chart"></i> Radiología</h5>
                            </div>
                            <div class="widget-content">
                                <div id="canvas-holder">
                                	<canvas id="barChart2" width="50" height="40"/>
                                	<div style="clear:left;" id="barLegend2"></div>
                                </div>
                            </div>
                            <script>
                            $(document).ready(function () {
                            	showGraphBar();
                            });
                            </script>
                        </div>
                    </div>
                    <!-- GRAFICO DE RADIOLOGIA -->

                    <!-- GRAFICO DE CITAS MEDICAS -->
                    <!--<div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-one">
                            <div class="widget-heading">
                                <h5 class=""><i data-feather="bar-chart-2"></i> Citas Médicas</h5>
                            </div>
                            <div class="widget-content">
                                <div align="center" id="canvas-holder" class="widget-content">
									<canvas id="lineChart" width="150" height="65"></canvas>
									<h5><div style="clear:left;font-size: 14px;" id="lineLegendd"></div></h5>
								</div>
                            </div>
                            <script>
                        	var data = {
                        		labels : ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"],
                        		datasets : [
                        		{
                        			label: "Atendidas",
                        			fillColor : "rgba(220,220,220,0.2)",
                        			strokeColor : "#6b9dfa",
                        			pointColor : "#1e45d7",
                        			pointStrokeColor : "#fff",
                        			pointHighlightFill : "#fff",
                        			pointHighlightStroke : "rgba(220,220,220,1)",
                        			data : [90,30,10,80,15,5,15,34,56,12,34,23]
                        		},
                        		{
                        			label: "Canceladas",
                        			fillColor : "rgba(151,187,205,0.2)",
                        			strokeColor : "#e9e225",
                        			pointColor : "#faab12",
                        			pointStrokeColor : "#fff",
                        			pointHighlightFill : "#fff",
                        			pointHighlightStroke : "rgba(151,187,205,1)",
                        			data : [40,50,70,40,85,55,15,67,89,12,22,45]
                        		},
                        		{
                        			label: "Vencidas",
                        			fillColor : "rgba(151,187,205,0.2)",
                        			strokeColor : "#f56760",
                        			pointColor : "#ca2f27",
                        			pointStrokeColor : "#fff",
                        			pointHighlightFill : "#fff",
                        			pointHighlightStroke : "rgba(151,187,205,1)",
                        			data : [2,3,2,2,4,1,3,5,6,4,3,2]
                        		}
                        		]
                        	}
                        	var ctx = document.getElementById("lineChart").getContext("2d");
                        	var lineChart = new Chart(ctx).Line(data, {
                        		responsive : true,
                        		animation: true,
                        		barValueSpacing : 5,
                        		barDatasetSpacing : 1,
                        		tooltipFillColor: "rgba(0,0,0,0.8)",                
                        		multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
                        	});
                        	legend(document.getElementById("lineLegendd"), data, "<%=label%>: <%=value%>");
                            </script>
                        </div>
                    </div>-->
                    <!-- GRAFICO DE CITAS MEDICAS -->

                </div>

                <div class="footer-wrapper text-primary">
                    <div class="footer-section f-section-1">
                        <i data-feather="copyright"></i> <span class="current-year"></span>.
                    </div>
                    <div class="footer-section f-section-2">
                        <p class="text-primary"><span class="current-detalle"></span></p>
                    </div>
                </div>

            </div>
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/font-icons/feather/feather.min.js"></script>
    <script type="text/javascript">
        feather.replace();
    </script>

    <!-- script jquery -->
    <script src="assets/script/jquery.min.js"></script> 
    <script type="text/javascript" src="assets/script/titulos.js"></script>
    <script type="text/jscript">
    $(window).load(function() {
        $.get('verifica_citas.php', {'Verifica_Citas_Vencidas': true});
    });
    </script>
    <!-- script jquery -->

</body>
</html>
<?php } else { ?>   
        <script type='text/javascript' language='javascript'>
        alert('NO TIENES PERMISO PARA ACCEDER A ESTE MODULO.\nCONSULTA CON EL ADMINISTRADOR PARA QUE TE DE ACCESO')  
        document.location.href='panel'   
        </script> 
<?php } } else { ?>
        <script type='text/javascript' language='javascript'>
        alert('NO TIENES PERMISO PARA ACCEDER AL SISTEMA.\nDEBERA DE INICIAR SESION')  
        document.location.href='logout'  
        </script> 
<?php } ?>