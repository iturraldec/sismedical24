<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
     if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "enfermera") {

$tra = new Login();
$ses = $tra->ExpiraSession(); 

$reg = $tra->ValoresPorId();

if(isset($_POST["proceso"]) and $_POST["proceso"]=="update")
{
$reg = $tra->ActualizarValores();
exit;
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title></title>
    <link rel="icon" type="image/png" href="assets/img/favicon.png"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="plugins/dropify/dropify.min.css">
    <link href="assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->

</head>
<body onLoad="muestraReloj()" class="sidebar-noneoverflow">
    
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
        
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">
                    <div id="custom_styles" class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                        <div class="widget-content-area statbox widget box box-shadow">
                            
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h5 class="card-subtitle text-dark alert-link"><i data-feather="align-justify"></i> Gestión de Valores</h5>
                                    </div>                 
                                </div>
                            </div>

    <div class="widget-content widget-content-area">                                
        <form class="form-material" novalidate method="post" action="#" name="updatevaloresexamenes" id="updatevaloresexamenes" enctype="multipart/form-data">
            
        <div id="save">
               <!-- error will be shown here ! -->
        </div>

        <input type="hidden" name="proceso" id="proceso" value="update"/>
        <input type="hidden" name="codvalores" id="codvalores" value="<?php echo $reg[0]['codvalores']; ?>">

        <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
        <tbody>
        <tr>
        <td colspan="3" class="alert-link">HEMATOLOGÍA</td>
        <td colspan="3" class="alert-link">QUÍMICA SANGUÍNEA</td>
        </tr>
        <tr>
        <td width="134" class="alert-link">EXÁMEN</td>
        <td colspan="2" class="alert-link">VALOR NORMAL</td>
        <td class="alert-link">EXÁMEN</td>
        <td colspan="2" class="alert-link">VALOR NORMAL </td>
        </tr>
        <tr>
        <td><span style="font-size: 12px">HEMATOCRITO</span></td>
        <td width="214"><input name="hematocritov" type="text" class="form-control" id="hematocritov" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['hematocritov']; ?>" required="" aria-required="true"></td>
        <td width="102"><div align="right" style="font-size: 12px">%</div></td>
        <td width="162"><span style="font-size: 12px">GLUCOSA</span></td>
        <td width="195"><input name="glucosav" type="text" class="form-control" id="glucosav" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['glucosav']; ?>" required="" aria-required="true"/></td>
        <td width="93"><div align="right" style="font-size: 12px">mg/dl</div></td>
        </tr>
        <tr>
        <td><span style="font-size: 12px">HEMOGLOBINA</span></td>
        <td><input name="hemoglobinav" type="text" class="form-control" id="hemoglobinav" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['hemoglobinav']; ?>" required="" aria-required="true"/></td>
        <td><div align="right" style="font-size: 12px">gr/dl</div></td>
        <td><span style="font-size: 12px">COLESTEROL TOTAL</span></td>
        <td><input name="colesteroltotalv" type="text" class="form-control" id="colesteroltotalv" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['colesteroltotalv']; ?>" required="" aria-required="true"/></td>
        <td><div align="right" style="font-size: 12px">mg/dl</div></td>
        </tr>
        <tr>
        <td><span style="font-size: 12px">LEUCOCITOS</span></td>
        <td><input name="leucocitosv" type="text" class="form-control" id="leucocitosv" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['leucocitosv']; ?>" required="" aria-required="true"/></td>
        <td><div align="right" style="font-size: 12px">mm3</div></td>
        <td><span style="font-size: 12px">COLESTEROL HDL</span></td>
        <td><input name="colesterolhdlv" type="text" class="form-control" id="colesterolhdlv" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['colesterolhdlv']; ?>" required="" aria-required="true" /></td>
        <td><div align="right" style="font-size: 12px">mg/dl</div></td>
        </tr>
        <tr>
        <td><span style="font-size: 12px">NEUTROFILOS</span></td>
        <td><input name="neutrofilosv" type="text" class="form-control" id="neutrofilosv" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['neutrofilosv']; ?>" required="" aria-required="true" /></td>
        <td><div align="right" style="font-size: 12px">%</div></td>
        <td><span style="font-size: 12px">COLESTEROL LDL</span></td>
        <td><input name="colesterolldlv" type="text" class="form-control" id="colesterolldlv" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['colesterolldlv']; ?>" required="" aria-required="true"/></td>
        <td><div align="right" style="font-size: 12px">mg/dl</div></td>
        </tr>
        <tr>
        <td><span style="font-size: 12px">LINFOCITOS</span></td>
        <td><input name="linfocitosv" type="text" class="form-control" id="linfocitosv" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['linfocitosv']; ?>" required="" aria-required="true"/></td>
        <td><div align="right" style="font-size: 12px">%</div></td>
        <td><span style="font-size: 12px">TRIGLICERIDOS</span></td>
        <td><input name="trigliceridosv" type="text" class="form-control" id="trigliceridosv" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['trigliceridosv']; ?>" required="" aria-required="true"/></td>
        <td><div align="right" style="font-size: 12px">mg/dl</div></td>
        </tr>
        <tr>
        <td><span style="font-size: 12px">EOSINOFILOS</span></td>
        <td><input name="eosinofilosv" type="text" class="form-control" id="eosinofilosv" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['eosinofilosv']; ?>" required="" aria-required="true"/></td>
        <td><div align="right" style="font-size: 12px">%</div></td>
        <td><span style="font-size: 12px">ACIDO &Uacute;RICO</span></td>
        <td><input name="acidouricov" type="text" class="form-control" id="acidouricov" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['acidouricov']; ?>" required="" aria-required="true" /></td>
        <td><div align="right" style="font-size: 12px">mg/dl</div></td>
        </tr>
        <tr>
        <td><span style="font-size: 12px">MONOCITOS</span></td>
        <td><input name="monositosv" type="text" class="form-control" id="monositosv" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['monositosv']; ?>" required="" aria-required="true"/></td>
        <td><div align="right" style="font-size: 12px">%</div></td>
        <td><span style="font-size: 12px">NITROGENO UREICO</span></td>
        <td><input name="nitrogenoureicov" type="text" class="form-control" id="nitrogenoureicov" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['nitrogenoureicov']; ?>"required="" aria-required="true"/></td>
        <td><div align="right" style="font-size: 12px">mg/dl</div></td>
        </tr>
        <tr>
        <td><span style="font-size: 12px">BASOFILOS</span></td>
        <td><input name="basofilosv" type="text" class="form-control" id="basofilosv" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['basofilosv']; ?>" required="" aria-required="true" /></td>
        <td><div align="right" style="font-size: 12px">%</div></td>
        <td><span style="font-size: 12px">CREATININA</span></td>
        <td><input name="creatininav" type="text" class="form-control" id="creatininav" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['creatininav']; ?>" required="" aria-required="true"/></td>
        <td><div align="right" style="font-size: 12px">mg/dl</div></td>
        </tr>
        <tr>
        <td><span style="font-size: 12px">CAYADOS</span></td>
        <td><input name="cayadosv" type="text" class="form-control" id="cayadosv" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['cayadosv']; ?>" required="" aria-required="true" /></td>
        <td><div align="right" style="font-size: 12px">%</div></td>
        <td><span style="font-size: 12px">PROTEINAS TOTALES</span></td>
        <td><input name="proteinastotalesv" type="text" class="form-control" id="proteinastotalesv" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['proteinastotalesv']; ?>" required="" aria-required="true" /></td>
        <td><div align="right" style="font-size: 12px">mg/dl</div></td>
        </tr>
        <tr>
        <td><span style="font-size: 12px">PLAQUETAS</span></td>
        <td><input name="plaquetasv" type="text" class="form-control" id="plaquetasv" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['plaquetasv']; ?>" required="" aria-required="true" /></td>
        <td><div align="right" style="font-size: 12px">mm3</div></td>
        <td><span style="font-size: 12px">ALB&Uacute;MINA</span></td>
        <td><input name="albuminav" type="text" class="form-control" id="albuminav" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['albuminav']; ?>" required="" aria-required="true" /></td>
        <td><div align="right" style="font-size: 12px">mg/dl</div></td>
        </tr>
        <tr>
        <td><span style="font-size: 12px">RETICULOCITOS</span></td>
        <td><input name="reticulositosv" type="text" class="form-control" id="reticulositosv" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['reticulositosv']; ?>" required="" aria-required="true" /></td>
        <td><div align="right" style="font-size: 12px">%</div></td>
        <td><span style="font-size: 12px">GLOBULINAS</span></td>
        <td><input name="globulinav" type="text" class="form-control" id="globulinav" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['globulinav']; ?>" required="" aria-required="true"/></td>
        <td><div align="right" style="font-size: 12px">mg/dl</div></td>
        </tr>
        <tr>
        <td><span style="font-size: 12px">V.S.G</span></td>
        <td><input name="vsgv" type="text" class="form-control" id="vsgv" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['vsgv']; ?>" required="" aria-required="true"/></td>
        <td><div align="right" style="font-size: 12px">mm/hr</div></td>
        <td><span style="font-size: 12px">BILIRRUBINA TOTAL</span></td>
        <td><input name="bilirrubinatotalv" type="text" class="form-control" id="bilirrubinatotalv" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['bilirrubinatotalv']; ?>" required="" aria-required="true" /></td>
        <td><div align="right" style="font-size: 12px">mg/dl</div></td>
        </tr>
        <tr>
        <td><span style="font-size: 12px">PT</span></td>
        <td><input name="ptv" type="text" class="form-control" id="ptv" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['ptv']; ?>" required="" aria-required="true" /></td>
        <td><div align="right" style="font-size: 12px">seg. CD</div></td>
        <td><span style="font-size: 12px">BILIRRUBINA DIRECTA</span></td>
        <td><input name="bilirrubinadirectav" type="text" class="form-control" id="bilirrubinadirectav" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['bilirrubinadirectav']; ?>" required="" aria-required="true" /></td>
        <td><div align="right" style="font-size: 12px">mg/dl</div></td>
        </tr>
        <tr>
        <td><span style="font-size: 12px">PTT</span></td>
        <td><input name="pttv" type="text" class="form-control" id="pttv" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['pttv']; ?>" required="" aria-required="true" /></td>
        <td><div align="right" style="font-size: 12px">seg. CD</div></td>
        <td><span style="font-size: 12px">BILIRRUBINA INDIRECTA</span></td>
        <td><input name="bilirrubinaindirectav" type="text" class="form-control" id="bilirrubinaindirectav" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['bilirrubinaindirectav']; ?>" required="" aria-required="true"/></td>
        <td><div align="right" style="font-size: 12px">mg/dl</div></td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><span style="font-size: 12px">FOSFATASA ALCALINA</span></td>
        <td><input name="fosfatasaalcalinav" type="text" class="form-control" id="fosfatasaalcalinav" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" value="<?php echo $reg[0]['fosfatasaalcalinav']; ?>" placeholder="Valor Normal" required="" aria-required="true"/></td>
        <td><div align="right" style="font-size: 12px">UI/L</div></td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><span style="font-size: 12px">TGO/AST</span></td>
        <td><input name="tgov" type="text" class="form-control" id="tgov" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['tgov']; ?>" required="" aria-required="true" /></td>
        <td><div align="right" style="font-size: 12px">UI/L</div></td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><span style="font-size: 12px">TGP/ALT</span></td>
        <td><input name="tgpv" type="text" class="form-control" id="tgpv" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['tgpv']; ?>" required="" aria-required="true"/></td>
        <td><div align="right" style="font-size: 12px">UI/L</div></td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><span style="font-size: 12px">AMILASA</span></td>
        <td><input name="amilasav" type="text" class="form-control" id="amilasav" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Valor Normal" value="<?php echo $reg[0]['amilasav']; ?>" required="" aria-required="true"/></td>
        <td><div align="right" style="font-size: 12px">UI/L</div></td>
        </tr>
        </tbody>
        </table>

                                    <div class="text-right">
        <button type="submit" name="btn-update" id="btn-update" class="btn btn-primary"><i data-feather="edit-2"></i> Actualizar</button>
        <button class="btn btn-dark" type="reset"><i data-feather="x-circle"></i> Cancelar</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

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
        <!--  END CONTENT AREA  -->

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
    <script src="plugins/dropify/dropify.min.js"></script>
    <script src="plugins/blockui/jquery.blockUI.min.js"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="assets/js/users/account-settings.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    
    <script src="plugins/font-icons/feather/feather.min.js"></script>
    <script type="text/javascript">
        feather.replace();
    </script>

    <!-- script jquery 
    <script src="assets/script/jquery.min.js"></script> -->
    <script type="text/javascript" src="assets/script/titulos.js"></script>
    <script type="text/javascript" src="assets/script/validation.min.js"></script>
    <script type="text/javascript" src="assets/script/script.js"></script>
    <!-- script jquery -->

    <!-- jQuery Noty-->
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <!-- jQuery Noty-->

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