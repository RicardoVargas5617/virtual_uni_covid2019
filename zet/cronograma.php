<?php
$pagina='1';

foreach ($_REQUEST as $key=>$valor)
{
    $$key=$valor;
    $key=substr($key,3);
    $$key=$valor;
}
$cn=conectar();
$vsql="call sp_maeConsultarSedes(1,'')";
$rs=mysqli_query($cn,$vsql);
$cnsemestre=conectar();
$vsql="call sp_maeConsultarSemestre(3,'')";
$rssemestre=mysqli_query($cnsemestre,$vsql);
$cncronograma=conectar();
$vsql="CALL sp_admBuscarCronograma('$sede','$semestre',$pagina,".GL_NUM_REG_X_PAG.")";
$rscronograma=mysqli_query($cncronograma,$vsql);
if($cncronograma->error=='') {
    $cant = $rscronograma->num_rows;
    $row = mysqli_fetch_array($rscronograma, MYSQLI_ASSOC);
    $total = $row['total'];
}else{
    $cant=0;
    $total=0;
}
?>
<div class="form-group col-lg-12">
</div>
<div class="nonboxy-widget ">
            <form name="frmcronograma" id="frmcronograma" action="cronograma.html?d=<?php echo $d?>&nav=<?php echo $nav?>" method="post">

                <div class="form-inline">
                    <div class="input-append">
                        <label class="pull-left col-lg-1">Sede:</label>
                        <select name="lstsede" id="lstsede" data-requerido="true" data-requerido-texto="Sede" class="form-control col-lg-7" onchange="$('#frmcronograma').submit()">
                            <option value="">SELECCIONAR...</option>
                            <?php
                            while($row=mysqli_fetch_array($rs,MYSQLI_ASSOC)){
                                echo '<option value="'.$row['sede'].'" '.($row['estado']==0?'class="disabled" ':'').($row['sede']==$sede?'selected':'').'>'.$row['descripcion'].'</option>';
                            }
                            ?>
                        </select>
                        <label class="pull-left col-lg-1">Semestre:</label>
                        <select name="lstsemestre" id="lstsemestre" class="form-control col-lg-7" onchange="$('#frmcronograma').submit()">
                            <option value="">SELECCIONAR...</option>
                            <?php
                            while($row=mysqli_fetch_array($rssemestre,MYSQLI_ASSOC)){
                                echo '<option value="'.$row['semestre'].'" '.($row['semestre']==$semestre?'selected':'').'>'.$row['descripcion'].'</option>';
                            }
                            ?>
                        </select>


                        <!--<button id="btnBuscar" class="btn  margin-fix" type="submit"><i class="icon-search"></i>Buscar</button>-->
                        <a class="btn btn-primary" type="button" href="cronogramanuevo.html?d=<?php echo $_REQUEST['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Nuevo Cronograma')?>&sede=<?php echo $sede?>&semestre=<?php echo $semestre?>">
                            <i class="icon-plus-sign "></i>Nuevo
                        </a>
                    </div>

                </div>
            </form>
                <br>
                <div class="table_content">
                    <div class="" id="outQuery">
                        <div id="divListado">
        <table class="data-tbl-simple table table-bordered" style="width:100%;">
            <thead>
                <tr>
                    <th style="width:1%; text-align:center">Nro.</th>
                    <th style="width:3%; text-align:center" colspan="2">Acciones</th>
                    <th style="width:15%;text-align:center;">Sede</th>
                    <th style="width:10%; text-align:center">Semestre</th>
                    <th style="width:5%;text-align:center;">Fase</th>
                    <th style="text-align:center;">Modalidad Admisi&oacute;n</th>
                </tr>
            </thead>
            <tbody>
            <?php if($cant>0){
                mysqli_data_seek($rscronograma,0);
                while ($row=mysqli_fetch_array($rscronograma,MYSQLI_ASSOC)) {
                    ?>
                    <tr>
                        <td style="width:1%; text-align:center"><?php echo $row['rownum'] ?></td>
                        <td style="width:3%; text-align:center" colspan="2">
                            <a class="icon_size2" style="text-decoration: none" rel="nolink" href="cronogramanuevo.html?d=<?php echo $_REQUEST['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Editar Cronograma')?>&modalidad=<?php echo $row['modalidad']?>&sede=<?php echo $row['sede']?>&semestre=<?php echo $row['semestre']?>&fase=<?php echo $row['fase']?>&modalidadadmision=<?php echo $row['modalidadadmision']?>">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a class="icon_size2" style="text-decoration: none" rel="nolink" data-mensaje="Esta seguro de elimiar el Registro?" href="cronogramaeliminar.html?<?php echo base64_encode('modalidad')?>=<?php echo base64_encode($row['modalidad'])?>&<?php echo base64_encode('sede')?>=<?php echo base64_encode($row['sede'])?>&<?php echo base64_encode('semestre')?>=<?php echo base64_encode($row['semestre'])?>&<?php echo base64_encode('fase')?>=<?php echo base64_encode($row['fase'])?>&<?php echo base64_encode('modalidadadmision')?>=<?php echo  base64_encode($row['modalidadadmision'])?>&<?php echo base64_encode('t')?>=<?php echo  base64_encode(1)?>">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                        <td style="width:15%;text-align:center;"><?php echo $row['nomsede'] ?></td>
                        <td style="width:10%; text-align:center"><?php echo $row['semestre'] ?></td>
                        <td style="width:5%;text-align:center;"><?php echo $row['fase'] ?></td>
                        <td style="text-align:center;"><?php echo $row['nommodalidadadmision'] ?></td>
                    </tr>
                    <?php
                }
                }elseif($cncronograma->error!=''){?>
                <tr>
                    <td colspan="10">
                        <div class="alert alert-danger fade in center">
                            <strong><?php echo $cncronograma->error?>.</strong>
                        </div>
                    </td>
                </tr>
                <?php

            } else{?>
                <tr>
                    <td colspan="10">
                        <div class="alert alert-info fade in center">
                            <strong>No se encontraron registros.</strong>
                        </div>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        </div>
                        <?php
                        if($cant>0) {
                            echo paginador($pagina, $total, GL_NUM_REG_X_PAG);
                        }
                        ?>
                    </div>
                </div>
                <div class="clear">&nbsp;</div>
        <table class="data-tbl-simple table table-bordered" align="center" style="width:10%">
            <thead>
                <tr><th colspan="4" style="text-align:center">Leyenda</th></tr>
            </thead>
            <tbody>
            <tr><td style="width:1%"><span class="color-icons page_white_edit_co"></span></td><td>Editar registro</td><td style="width:1%"><span class="color-icons cross_co"></span></td><td>Eliminar registro</td>
            </tr>
            </tbody>
        </table>
            </div>