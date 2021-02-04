<?php
$pagina='1';
$faseadmision='';
$cnmodalidad=conectar();
$vsql = "SELECT modalidad,descripcion FROM mae_modalidad";
$rsmodalidad=mysqli_query($cnmodalidad,$vsql);
$row=mysqli_fetch_array($rsmodalidad,MYSQLI_ASSOC);
$modalidad=$row['modalidad'];
mysqli_data_seek($rsmodalidad,0);
foreach($_REQUEST as $key=>$valor){
    $$key=$valor;
    // echo '<br>';
}
foreach($_POST as $key=>$valor){
    $key=strtolower(substr($key,3));
    $$key=$valor;
    // echo '<br>';
}

$cn=conectar();
$cnsemestre=conectar();
$cnfase=conectar();
$cnrespuesta=conectar();
$cnmodalidad=conectar();
$vsql="call sp_maeConsultarSedes(1,'')";
$rs=mysqli_query($cn,$vsql);
$vsql="call sp_maeConsultarSemestre(3,'')";
$rssemestre=mysqli_query($cnsemestre,$vsql);
$vsql="call sp_adm_listaSemestreFase('$modalidad','$sede','$semestre')";
$rsfase=mysqli_query($cnfase,$vsql);
$row=mysqli_fetch_array($rsfase,MYSQLI_ASSOC);
$faseadmision=$faseadmision==''?$row['fase']:$faseadmision;

$vsqlrespuesta="call sp_admConsultarFaseRespuesta('$modalidad','$sede','$semestre','$faseadmision',$pagina,".GL_NUM_REG_X_PAG.")";
$rsrespuesta=mysqli_query($cnrespuesta,$vsqlrespuesta);

if(@$rsrespuesta->error=='') {
    $cant = $rsrespuesta->num_rows;
    $row = mysqli_fetch_array($rsrespuesta, MYSQLI_ASSOC);
    $total = $row['total'];
}else{
    $cant=0;
    $total=0;
}

$param='d='.$d.'&nav='.$nav.'&sede='.$sede.'&semestre='.$semestre.'&faseadmision='.$faseadmision;
?>
        <div class="form-inline">
            <br>
            <div class="input-append controls" id="fbusca">
                <form action="" method="post" id="frmrespuesta" name="frmrespuesta">
                    <label class="col-lg-1" style="display: none">Modalidad:</label>
                    <div class="col-lg-2" style="display: none">
                        <select name="lstmodalidad" id="lstmodalidad" data-requerido="true" data-requerido-texto="Modalidad" class="form-control col-lg-6" onchange="$('#lstsemestre').change();">
                            <?php
                            while($row=mysqli_fetch_array($rsmodalidad,MYSQLI_ASSOC)){
                                echo '<option value="'.$row['modalidad'].'" '.($row['modalidad']==$modalidad?' selected ':'').'  >'.$row['descripcion'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                <label class="col-lg-1">Sede :</label>
                <div class="col-lg-2">
                    <select name="lstsede" id="lstsede" data-requerido="true" data-requerido-texto="Sede" class="form-control col-lg-6" onchange="$('#lstsemestre').change();">
                        <option value="">SELECCIONAR...</option>
                        <?php
                        while($row=mysqli_fetch_array($rs,MYSQLI_ASSOC)){
                            echo '<option value="'.$row['sede'].'" '.($row['sede']==$sede?' selected ':'').($row['estado']==0?'class="disabled"':'').'  >'.$row['descripcion'].'</option>';
                        }
                        ?>
                    </select>
                </div>&nbsp;&nbsp;
                <label class="col-lg-1">Semestre:</label>
                <div class="col-lg-1">
                    <select name="lstsemestre" id="lstsemestre" class="form-control col-lg-7" style="width: 85px" data-requerido="true" data-requerido-texto="Semestre"
                            onchange="dataselectjason('lstfaseadmision',{proc:'<?php echo base64_encode('sp_adm_listaSemestreFase')?>',listproc:$('#lstmodalidad').val()+','+$('#lstsede').val()+','+this.value,listcam:'<?php echo base64_encode('fase,descripcion')?>'});">
                        <option value="">SELECCIONAR...</option>
                        <?php
                        while($row=mysqli_fetch_array($rssemestre,MYSQLI_ASSOC)){
                            echo '<option value="'.$row['semestre'].'" '.($row['semestre']==$semestre?' selected ':'').'>'.$row['descripcion'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <label  class="col-lg-1">Fase:</label>
                <div  class="col-lg-2">
                    <select name="lstfaseadmision" id="lstfaseadmision" data-requerido="true" data-requerido-texto="Fase" class="form-control col-lg-7" onchange="$('#frmrespuesta').submit()">
                        <option value="">SELECCIONAR...</option>
                        <?php
                        mysqli_data_seek($rsfase,0);
                        while($row=mysqli_fetch_array($rsfase,MYSQLI_ASSOC)){
                            echo '<option value="'.$row['fase'].'" '.($row['fase']==$faseadmision?'selected':'').'>'.$row['descripcion'].'</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="pull-left">
                    <!--<button id="btnBuscar" class="btn margin-fix" type="submit"><i class="icon-search"></i>Buscar</button>&nbsp;&nbsp;&nbsp;-->
                    <button id="BtnMantenimientoNuevo" class="btn btn-primary" onclick="agregarrespuesta($('#lstmodalidad').val(),$('#lstsede').val(),$('#lstsemestre').val(),$('#lstfaseadmision').val())" type="button"><i class="icon-white icon-ok"></i>Agregar</button>
                </div>
                </div>
            </form>
            </div>
                <table class="data-tbl-simple table table-bordered" style="border-left:#ccc 1px solid;border-right:0px;width:100%;">
                    <thead>
                    <tr>
                        <th style="text-align:center;width: 5%">Nro.</th>
                        <th style="text-align:center;width: 5%">Accion</th>
                        <th style="text-align:center;width: 10%">Pregunta</th>
                        <th style="text-align:center;">Respuesta</th>
                                            </tr>
                    </thead>
                    <tbody>
                        <?php if($rsrespuesta->num_rows==0){?>
                        <tr>
                            <td colspan="7">
                                <div class="alert alert-info fade in center">
                                    <strong>No se encontraron registros.</strong>
                                </div>
                            </td>
                        </tr>
                    <?php }else{
                            $r=0;
                            mysqli_data_seek($rsrespuesta,0);
                            while($row=mysqli_fetch_array($rsrespuesta,MYSQLI_ASSOC)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['rownum']?></td>
                                    <td style="text-align: center">
                                        <a class="icon_size2" style="text-decoration: none" rel="nolink" data-mensaje="Esta seguro de elimiar el Registro?" href="respuestaeliminar.html?<?php echo base64_encode('modalidad')?>=<?php echo base64_encode($row['modalidad'])?>&<?php echo base64_encode('sede')?>=<?php echo base64_encode($row['sede'])?>&<?php echo base64_encode('semestre')?>=<?php echo base64_encode($row['semestre'])?>&<?php echo base64_encode('fase')?>=<?php echo base64_encode($row['fase'])?>&<?php echo base64_encode('pregunta')?>=<?php echo  base64_encode($row['pregunta'])?>&<?php echo base64_encode('tipo')?>=<?php echo  base64_encode('E')?>">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <td><?php echo $row['pregunta']?></td>
                                    <td><?php echo $row['respuesta']?></td>
                                </tr>
                                <?php
                            }
                            }?>
                    </tbody>
                    </table>
<?php
if($rsrespuesta->num_rows>0) {
    echo paginador($pagina, $total, GL_NUM_REG_X_PAG,$param);
}
?>
<table class="data-tbl-simple table table-bordered" align="center" style="width:10%">
    <thead>
    <tr><th colspan="4" style="text-align:center">Leyenda</th></tr>
    </thead>
    <tbody>
    <tr>
        <td style="width:1%"><span class="fa fa-trash"></span></td><td>Eliminar</td>
    </tr>
    </tbody>
</table>

<script>
    function agregarrespuesta(modalidad,sede,semestre,fase){
        var error=0;
        $('#fbusca input[data-requerido=true],'+'#fbusca select[data-requerido=true] ').each(function(i) {
            var valor = $(this).val();
            var texto=$(this).attr('data-requerido-texto');
            if(valor=='' || valor==null){
                error=1;
                setTimeout(function(){
                    toastr.warning(texto,'Campo Obligatorio');
                },500 + ( i * 200 ));
                $(this).addClass('validar-error').delay(6000);
            }
        });

        if(error==0) {
            bootbox.dialog({
                title: 'Agregar Respuesta',
                message: '<div id="dvRespuesta"><i class="fa fa-spinner faa-spin animated"></i>Cargado....</div>',
                buttons: {
                    submit: {
                        label: 'Agregar',
                        className: 'btn-primary',
                        callback: function (result) {
                            $('#frmMantenimientoRespuesta').submit();
                            return false;
                        }
                    },
                    cancel: {
                        label: 'Cancelar',
                        className: 'btn-default'
                    },

                }
            });
            $('#dvRespuesta').load("../zet/respuesta.php?modalidad="+modalidad+"&sede=" + sede + "&semestre=" + semestre + "&fase=" + fase);
        }
    }
</script>