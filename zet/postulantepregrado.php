<br>
<?php
$pagina=1;
$txtdatosbuscar='';
$cant=0;
$cnpost = conectar();
if(isset($_REQUEST) and count($_REQUEST)>0) {
    foreach ($_REQUEST as $key => $valor) {
        $$key = $valor;
    }
    $vsqlpost="CALL sp_admBuscarPostulanteAdmision('$txtdatosbuscar',$pagina,".GL_NUM_REG_X_PAG.")";
    $rs = mysqli_query($cn,	$vsqlpost);

    if(@$rs->error=='') {
        $cant = $rs->num_rows;
        $row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
        $total = $row['total'];
    }else{
        $cant=0;
        $total=0;
    }

}
$param='d='.$d.'&nav='.$nav.'&txtdatosbuscar='.$txtdatosbuscar;
?>
<div class="widget-content">
    <div class="nonboxy-widget">
        <form name="frmBuscarPostulante" method="post" action="?d<?php echo $d?>&nav=<?php echo $nav?>" id="frmBuscarPostulante" class="form-search">
            <input id="hidtipogrado" name="hidtipogrado" type="hidden" value="B">

            <div class="input-group  col-lg-6">
                <input type="text" id="txtdatosbuscar" name="txtdatosbuscar" value="<?php echo $txtdatosbuscar?>" class="form-control col-lg-6" placeholder="Buscar por Apellidos y Nombres." autocomplete="off" onkeypress="if(gKeyEnter(event)){btnBuscar.click();}" aria-controls="DataTables_Table_0"></label>
                <span class="input-group-btn">
                  <button id="btnBuscar" class="btn margin-fix" style="height: 34px;margin-top: 0px"><i class="icon-search"></i>Buscar</button>
                    <a  style="height: 34px;margin-top: 0px" href="postulantenuevo.html?d=<?php echo $_REQUEST['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Datos Postulante')?>" id="btnNuevo" class="btn btn-primary" >
                    <i class="icon-plus-sign"></i>Nuevo
                </a>
                </span>
            </div>
        </form>
    </div>
    <br/>
    <div class="row-fluid">
        <div class="span12">
            <div class="nonboxy-widget">

                <table class="data-tbl-simple table table-bordered user-tbl">
                    <thead>
                    <tr>
                        <th style="text-align: center;width:5%">Nro.</th>
                        <th style="text-align: center;width:5%">Persona</th>
                        <th style="text-align: center;">Apellidos y Nombres</th>
                        <th style="text-align: center;width:10%">DNI</th>
                        <th style="text-align: center;width:10%">TIPO</th>
                        <th style="text-align: center;width:12%">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php if($cant==0){?>
                        <tr>
                            <td colspan="6">
                                <div class="alert alert-info fade in center">
                                    <strong>No se encontraron registros.</strong>
                                </div>
                            </td>
                        </tr>
                    <?php }else {
                            #rownum  persona   nombrecompleto                   numerodocumento  postulante   total
                            mysqli_data_seek($rs,0);
                            while ($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
                                //print_r($row);
                                ?>
                                <tr>
                                    <td><?php echo substr('000'.$row['rownum'],-3) ?></td>
                                    <td><?php echo $row['persona'] ?></td>
                                    <td><?php echo $row['nombrecompleto'] ?></td>
                                    <td><?php echo $row['numerodocumento'] ?></td>
                                    <td><?php echo $row['postulante'] ?></td>
                                    <td>
                                        <a class="btn btn-default" href="postulantenuevo.html?d=<?php echo $_REQUEST['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Editar Datos Postulante')?>&persona=<?php echo $row['persona']?>&tipo=B">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <?php if($row['postulante']==''){?>
                                            <a class="btn btn-default disabled" href="javascript:void(0)">
                                                <i class="fa fa-vcard"></i>
                                            </a>
                                        <?php }else{?>
                                            <a class="btn btn-default" href="postulante.html?d=<?php echo $_REQUEST['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Datos de Inscripci&oacute;n')?>&persona=<?php echo $row['persona']?>&tipo=B">
                                                <i class="fa fa-vcard"></i>
                                            </a>
                                        <?php }?>
                                    </td>
                                </tr>
                                <?php
                            }
                    }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
if($cant>0) {
    echo paginador($pagina, $total, GL_NUM_REG_X_PAG,$param);
}
?>