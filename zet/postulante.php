<?php
$tipo='B';
$cnmodalidad=conectar();
$vsql = "SELECT modalidad,descripcion FROM mae_modalidad";
$rsmodalidad=mysqli_query($cnmodalidad,$vsql);
$row=mysqli_fetch_array($rsmodalidad,MYSQLI_ASSOC);
$modalidad=$row['modalidad'];
mysqli_data_seek($rsmodalidad,0);
foreach ($_POST as $k=>$v)
{
    $$k=$v;
}
$cn=conectar();
$cnsemestre=conectar();
$cnmodalidad=conectar();
$cnpostulante=conectar();
$cnmedio=conectar();
$vsql="call sp_maeConsultarSedes(1,'')";
$rs=mysqli_query($cn,$vsql);
$vsql="call sp_maeConsultarSemestre(3,'')";
$rssemestre=mysqli_query($cnsemestre,$vsql);
$vsql="call sp_admListarModalidadAdmision()";
$rsmodalidadadmision=mysqli_query($cnmodalidad,$vsql);
$vsql="CALL sp_admListarPostulantesAdmision('$persona')";
$rspostulante=mysqli_query($cnpostulante,$vsql);
$numpostulante= $rspostulante->num_rows;
$vsqlmedio="SELECT a.*,b.descripcion AS nomtipomedio FROM mae_mediocomunicacion a INNER JOIN mae_tipomedio b ON a.tipomedio=b.tipomedio";
$rsmedio=mysqli_query($cnmedio,$vsqlmedio);
?>

<form id="frmpostulante" name="frmpostulante"  class="form-horizontal  porlets-content" action="../zet/postulantegrabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
    <input type="hidden" id="hidpersona" name="hidpersona" value="<?php echo $persona?>">
    <input type="hidden" id="hidtipogrado" name="hidtipogrado" value="<?php echo $tipo?>">
    <div class="row-fluid" style="background:none">

            <div class="form-group col-lg-12">
                <a href="postulante<?php echo $tipo=='B'?'pregrado':'posgrado'?>.html?d=<?php echo $_REQUEST['d']?>&nav=<?php echo base64_encode('Postulante '.($tipo=='B'?'Pregrado':'Postgrado'))?>&codigo=<?php echo $codigo;?>&paginaactual=<?php echo $paginaactual?>"><i class="fa fa-mail-reply"></i> Regresar</a>
            </div>
            <div class="form-group col-lg-6" style="display: none">
                <label class="control-label col-lg-5"><label style="color:#990000">(*)</label> Modalidad:</label>
                <div class="controls">
                    <select name="lstmodalidad" id="lstmodalidad" class="col-lg-7" onchange="$('#lstsemestre').change();" data-requerido="true" data-requerido-texto="Modalidad">
                        <?php
                        while($row=mysqli_fetch_array($rsmodalidad,MYSQLI_ASSOC)){
                            echo '<option value="'.$row['modalidad'].'" '.($row['modalidad']==$modalidad?'selected':'') .'>'.$row['descripcion'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group col-lg-6">
                <label class="control-label col-lg-5"><font class="CampoObligatorio">(*)</font>  Sede:</label>
                <div class="controls">
                    <select name="lstsede" id="lstsede" data-requerido="true" data-requerido-texto="Sede inscripcion" class="col-lg-7" onchange="codigopostulante($('#lstsede').val(),$('#lstsemestre').val(),$('#lstfaseadmision').val(),'txtpostulante');$('#lstsemestre').change();crearselect('lstestructura',{})">
                        <option value="">SELECCIONAR...</option>
                    <?php
                        while($row=mysqli_fetch_array($rs,MYSQLI_ASSOC)){
                            echo '<option value="'.$row['sede'].'" '.($row['estado']==0?'class="disabled"':'').'  >'.$row['descripcion'].'</option>';
                        }
                    ?>
                    </select>
                </div>
            </div>
        <div class="form-group col-lg-6" style="height: 36px;">
            <label class="control-label col-lg-5">Postulante:</label>
            <div class="controls">
                <div class="input-group col-lg-4">
                    <input type="text" class="col-lg-12" readonly="" value="" name="txtpostulante" id="txtpostulante"><!--<input type="text" class="form-control">-->
                    <span class="input-group-addon popovers" data-trigger="hover" data-toggle="popover" data-content="Codigo correlativo de postulante(4 digitos)" data-original-title="Codigo">(AUTO)</span>
                </div>

            </div>
        </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-5"><font class="CampoObligatorio">(*)</font>  Semestre:</label>
                <div class="controls">
                    <select name="lstsemestre" id="lstsemestre" class="col-lg-7" data-requerido="true" data-requerido-texto="Semestre del postulante"
                            onchange="codigopostulante($('#lstsede').val(),$('#lstsemestre').val(),$('#lstfaseadmision').val(),'txtpostulante');
                                dataselectjason('lstfaseadmision',{proc:'<?php echo base64_encode('sp_adm_listaSemestreFase')?>',listproc:$('#lstmodalidad').val()+','+$('#lstsede').val()+','+this.value,listcam:'<?php echo base64_encode('fase,descripcion')?>'});crearselect('lstestructura',{});$('#lstfaseadmision').change()">
                        <option value="">SELECCIONAR...</option>
                        <?php
                        while($row=mysqli_fetch_array($rssemestre,MYSQLI_ASSOC)){
                            echo '<option value="'.$row['semestre'].'">'.$row['descripcion'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-5"><font class="CampoObligatorio">(*)</font>  Fase:</label>
                <div class="controls" id="dvfaseadmision">
                    <select name="lstfaseadmision" id="lstfaseadmision" data-requerido="true" data-requerido-texto="Fase que postula" class="span12" onchange="codigopostulante($('#lstsede').val(),$('#lstsemestre').val(),$('#lstfaseadmision').val(),'txtpostulante');dataselectjason('lstestructura',{proc:'<?php echo base64_encode('sp_admListarSemestreFaseEstructura')?>',listproc:$('#lstmodalidad').val()+','+$('#lstsede').val()+','+$('#lstsemestre').val()+','+this.value,listcam:'<?php echo base64_encode('estructura,descripcion')?>'});">
                        <option value="">SELECCIONAR...</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-5"><font class="CampoObligatorio">(*)</font>  Carreras Profesional:</label>
                <div class="controls" id="dvestructuraadmision">
                    <select name="lstestructura" id="lstestructura" data-requerido="true" data-requerido-texto="Carrera Profesional"><option value="">SELECCIONAR...</option></select>
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-5"><font class="CampoObligatorio">(*)</font>  Modalidad de Admisi&oacute;n:</label>
                <div class="controls">
                    <select name="lsttipoingreso" id="lsttipoingreso" class="col-lg-7" data-requerido="true" data-requerido-texto="Modalidad Ingreso">
                        <?php
                        $nomtipoexamen='';
                        $i=0;
                        while($row=mysqli_fetch_array($rsmodalidadadmision,MYSQLI_ASSOC)){

                            if($nomtipoexamen!=$row['nomtipoexamen']){
                                if($nomtipoexamen!='' and $i>0){
                                    echo '</optgroup>';
                                }
                                echo '<optgroup label="'.$row['nomtipoexamen'].'">';
                            }
                            ++$i;
                            $nomtipoexamen=$row['nomtipoexamen'];
                            echo '<option value="'.$row['modalidadadmision'].'">'.$row['nommodalidadadmision'].'</option>';
                        }
                        ?>
                        </optgroup>
                    </select>
                </div>
            </div>
            <!--<div class="form-group col-lg-6">
                <label class="control-label col-lg-5">Modalidad:</label>
                <div class="controls">
                    <select name="lstmodalidad" id="lstmodalidad" class="span12" data-requerido="true" data-requerido-texto="Modalidad Estudio">
                        <option title="PRESENCIAL" value="P" selected="selected">PRESENCIAL</option>
                    </select>
                </div>
            </div>-->

            <div class="form-group col-lg-6" style="height: 36px">
                <label class="control-label col-lg-5">Resoluci&oacute;n:</label>
                <div class="controls">
                    <input type="text" name="txtresolucion"  class="col-lg-7" id="txtresolucion" value="">
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-5">Fecha Resoluci&oacute;n:</label>
                <div class="controls">
                    <input type="text" class="col-lg-3" id="txtfecharesolucion" readonly=""  name="txtfecharesolucion" value="">
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-5">Fecha Pago:</label>
                <div class="controls">
                    <input type="text" class="col-lg-3" id="txtfechapago" data-requerido="true" data-requerido-texto="Fecha Pago"  name="txtfechapago" value="">
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-5">Nro. Recibo:</label>
                <div class="controls">
                    <input type="text"  data-trigger="hover" data-toggle="popover" data-content="Numero Recibo" data-requerido="true" data-requerido-texto="Numero Recibo" data-original-title="Recibo" class="col-lg-3 popovers mask" data-inputmask="'mask':'999-999999'" id="txtnumerorecibo"  name="txtnumerorecibo" value="">
                </div>
            </div>
            <div class="form-group col-lg-6" style="height: 36px">
                <label class="control-label col-lg-5">Observacion Pago:</label>
                <div class="controls">
                    <input type="text" name="txtobspago"  class="col-lg-7" id="txtobspago" value="">
                </div>
            </div>
            <div class="form-group col-lg-6" style="height: 36px">
                <label class="control-label col-lg-5">Promotor:</label>
                <div class="controls">
                    <select name="lstpromotor" id="lstpromotor" class="popovers" data-trigger="hover" data-toggle="popover" data-content="Buscar Promotor">
                        <option value="">SELECCIONAR....</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-lg-6" style="height: 36px">
                <label class="control-label col-lg-5">Fecha Captacion:</label>
                <div class="controls">
                    <input type="text" name="txtfechacaptacion"  class="col-lg-3" id="txtfechacaptacion" value="">
                </div>
            </div>
        <div class="form-group col-lg-8" style="height: 36px">
            <label class="control-label col-lg-5">Medio Comunicacion:</label>
            <div class="controls col-lg-7">
        <select name="lstmediocomunicacion" id="lstmediocomunicacion" class="chosen-select col-lg-6">
            <option value="">SELECCIONAR...</option>
            <?php
            $nomtipomedio='';
            $i=0;
            while($row=mysqli_fetch_array($rsmedio,MYSQLI_ASSOC)){

                if($nomtipomedio!=$row['nomtipomedio']){
                    if($nomtipomedio!='' and $i>0){
                        echo '</optgroup>';
                    }
                    echo '<optgroup label="'.$row['nomtipomedio'].'">';
                }
                ++$i;
                $nomtipomedio=$row['nomtipomedio'];
                echo '<option value="'.$row['tipomedio'].$row['mediocomunicacion'].'">'.$row['descripcion'].'</option>';
            }
            ?>
            </optgroup>
            </select>
            </div>
        </div>
    </div>

    <div class="form-actions  col-lg-12" style="text-align: center;">
        <button type="submit" class="btn btn-primary"><i class="icon-white icon-book"></i> Inscribir Postulante</button>
    </div>
</form>
<!--
<form>
    <header class="dark col-lg-12 fa-hover">
        <div class="panel-heading">
            <h3 class="panel-title"> <i class="fa fa-leaf"></i>
                Estado de inscripci&oacute;n
            </h3>
        </div>
    </header>
    <div class="row-fluid" style="background:none">
        <div class="form-group col-lg-12">
        </div>
        <div class="form-group col-lg-12">
            <div class="controls">
                <select id="cboestado" name="cboestado" class="col-lg-6" style="display: inline;">
                    <option value="_none_">SELECCIONAR...</option><option title="Pre Inscrito" value="P">Pre Inscrito</option><option title="Validado" value="V">Validado</option><option title="Inscrito" value="I">Inscrito</option></select>
                <input type="hidden" id="hddpostulante" name="hddpostulante" value=""><input type="hidden" id="hddstadito" name="hddstadito" value=""><button class="btn btn-primary" type="button" onclick="if($('#cboestado').val()!='' &amp;&amp; $('#cboestado').val()!='_none_'){ if(confirm('¿Está seguro de guardar los datos?')){   xajax__admInscripcionInterfazActualizaEstadoincripcion(xajax.getFormValues('frmpostulante'));}else{ $('#cboestado').val($('#hddstadito').val());}}else{alert('Seleccione el Estado de Incripción'); $('#cboestado').focus();}">
                    <i class="icon-white icon-ok"></i>Guardar
                </button>
            </div>
        </div>
    </div>
</form>
-->
    <header class="dark col-lg-12 fa-hover">
        <div class="panel-heading">
            <h3 class="panel-title"> <i class="fa fa-mortar-board"></i>
                Carrera Profesiona / Programa
            </h3>
        </div>
    </header>
    <div class="row-fluid" id="dvdetallepostulante" style="background:none">
        <div class="form-group col-lg-12">
        </div>
            <table id="tab_ctacteal" class="table table-bordered table-condensed table-hover table-striped dataTable no-footer" style="border-left:#ccc 1px solid;border-right:0px;width:100%;">
                <thead>
                    <tr>
                        <th style="width:20px;vertical-align:middle;text-align:center">Nro.</th>
                        <th style="width:200px;text-align:center;vertical-align:middle;">
                            Acciones
                        </th>
                        <th style="width:70px;text-align:center;vertical-align:middle">
                            Postulante
                        </th>
                        <th style="width:100px;text-align:center;vertical-align:middle">
                            Sede
                        </th>
                        <th style="width:50px;text-align:center;vertical-align:middle">
                            Semestre
                        </th>
                        <th style="width:20px;text-align:center;vertical-align:middle">
                            Fase
                        </th>
                        <th style="width:250px;text-align:center;vertical-align:middle">
                            Carrera Profesional
                        </th>
                        <th style="width:80px;text-align:center;vertical-align:middle">
                            Mod. Admisi&oacute;n
                        </th>
                        <th style="width:10px;text-align:center;vertical-align:middle">
                            Puntaje
                        </th>
                        <th style="width:10px;text-align:center;vertical-align:middle">
                            Puesto
                        </th>
                        <th style="width:100px;text-align:center;vertical-align:middle">
                            Estado de ingreso</th>
                    </tr>
                </thead>
                <tbody id="tab_ctactealBody">
                <?php if($numpostulante>0){
                    $i=0;
                    while($row=mysqli_fetch_array($rspostulante,MYSQLI_ASSOC)) {
                        ?>
                        <tr>
                            <td><?php echo ++$i;?></td>
                            <td>
                                <?php if($row['anulado']=='1'){?>
                                    <a class="icon_size2" style="text-decoration: none;color: #3C3F48;icon: none;cursor: default" href="javascript:void(0)">

                                        <i class="fa fa-file-text"></i>
                                    </a>
                                    <a class="icon_size2" style="text-decoration: none;color: #3C3F48;icon: none;cursor: default" href="javascript:void(0)">
                                        <i class="fa fa-vcard"></i>
                                    </a>
                                <?php }else { ?>
                                    <a class="icon_size2" data-height="450px" data-target="#dmVentana"
                                       data-title="Ficha Inscripcion" data-toggle="modal" style="text-decoration: none"
                                       href="javascript:void(0)" data-pdf="1"
                                       data-param="fichainscripcion.html?<?php echo base64_encode('persona') . '=' . base64_encode($row['persona']) . '&' . base64_encode('postulante') . '=' . base64_encode($row['postulante']) . '&' . base64_encode('sede') . '=' . base64_encode($row['sede']) . '&' . base64_encode('semestre') . '=' . base64_encode($row['semestre']) . '&' . base64_encode('fase') . '=' . base64_encode($row['fase']) . '&' . base64_encode('estructura') . '=' . base64_encode($row['estructura']) . '&' . base64_encode('modalidad') . '=' . base64_encode($row['modalidadadmision']) . '&' . base64_encode('pasa') . '=' . base64_encode(1) . '&' . base64_encode('print') . '=' . base64_encode(1) ?>">
                                        <i class="fa fa-file-text"></i>
                                    </a>
                                    <a class="icon_size2" href="javascript:void(0)" data-print="1" data-height="230px" data-target="#dmVentana" data-title="Constancia Ingreso" data-toggle="modal" style="text-decoration: none"
                                       data-param="carnetpostulante.html?<?php echo base64_encode('persona').'='.base64_encode($row['persona']).'&'.base64_encode('postulante').'='.base64_encode($row['postulante']).'&'.base64_encode('sede').'='.base64_encode($row['sede']).'&'.base64_encode('semestre').'='.base64_encode($row['semestre']).'&'.base64_encode('fase').'='.base64_encode($row['fase']).'&'.base64_encode('estructura').'='.base64_encode($row['estructura']).'&'.base64_encode('modalidad').'='.base64_encode($row['modalidadadmision']) . '&' . base64_encode('pasa') . '=' . base64_encode(1) . '&' . base64_encode('print') . '=' . base64_encode(1)?>">
                                        <i class="fa fa-vcard"></i>
                                    </a>
                                    <?php
                                }
                                if($row['estado']=='SI'){?>
                                <a class="icon_size2" href="javascript:void(0)" data-pdf="1"  data-height="430px" data-target="#dmVentana" data-title="Constancia Ingreso" data-toggle="modal" style="text-decoration: none"
                                   data-param="constanciaingreso.html?<?php echo base64_encode('persona').'='.base64_encode($row['persona']).'&'.base64_encode('postulante').'='.base64_encode($row['postulante']).'&'.base64_encode('sede').'='.base64_encode($row['sede']).'&'.base64_encode('semestre').'='.base64_encode($row['semestre']).'&'.base64_encode('fase').'='.base64_encode($row['fase']).'&'.base64_encode('estructura').'='.base64_encode($row['estructura']).'&'.base64_encode('modalidad').'='.base64_encode($row['modalidadadmision'])?>">
                                    <i class="fa fa-file-text-o"></i>
                                </a>
                            <?php }else{?>
                                    <a class="icon_size2" href="javascript:void(0)"  style="text-decoration: none;color: #3C3F48;icon: none;cursor: default">
                                        <i class="fa fa-file-text-o"></i>
                                    </a>
                                <?php }?>
                                <?php if($row['estado']!=''  or $row['anulado']=='1'){?>
                                    <a class="icon_size2" style="text-decoration: none;color: #3C3F48;icon: none;cursor: default" href="javascript:void(0)">
                                        <i class="fa fa-ban"></i>
                                    </a>
                                <?php }else{?>
                                    <a class="icon_size2" style="text-decoration: none" rel="nolink" data-mensaje="Esta seguro de anular la inscripcion?"
                                       href="postulanteeliminar.html?<?php echo base64_encode('tipo').'='.base64_encode('B').'&'.base64_encode('persona').'='.base64_encode($row['persona']).'&'.base64_encode('postulante').'='.base64_encode($row['postulante']).'&'.base64_encode('sede').'='.base64_encode($row['sede']).'&'.base64_encode('semestre').'='.base64_encode($row['semestre']).'&'.base64_encode('fase').'='.base64_encode($row['fase']).'&'.base64_encode('estructura').'='.base64_encode($row['estructura']).'&'.base64_encode('modalidad').'='.base64_encode($row['modalidadadmision'])?>">
                                        <i class="fa fa-ban"></i>
                                    </a>

                                <?php }?>
                                <?php if($row['estado']!='' or $row['anulado']=='1'){?>
                                    <a class="icon_size2" style="text-decoration: none;color: #3C3F48;icon: none;cursor: default" href="javascript:void(0)">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                <?php }else{?>
                                    <a class="icon_size2" style="text-decoration: none" rel="nolink" data-mensaje="Esta seguro de elimiar la inscripcion?"
                                       href="postulanteeliminar.html?<?php echo base64_encode('tipo').'='.base64_encode('D').'&'.base64_encode('persona').'='.base64_encode($row['persona']).'&'.base64_encode('postulante').'='.base64_encode($row['postulante']).'&'.base64_encode('sede').'='.base64_encode($row['sede']).'&'.base64_encode('semestre').'='.base64_encode($row['semestre']).'&'.base64_encode('fase').'='.base64_encode($row['fase']).'&'.base64_encode('estructura').'='.base64_encode($row['estructura']).'&'.base64_encode('modalidad').'='.base64_encode($row['modalidadadmision'])?>">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                <?php }?>
                                <a class="icon_size2" style="text-decoration: none;" href="javascript:void(0)" onclick="modificarPuntaje('<?php echo base64_encode($row['persona'])?>','<?php echo base64_encode($row['postulante'])?>','<?php echo base64_encode($row['semestre'])?>','<?php echo base64_encode($row['sede'])?>','<?php echo base64_encode($row['estructura'])?>','<?php echo base64_encode($row['fase'])?>','<?php echo base64_encode($row['modalidadadmision'])?>')">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a class="icon_size2" href="javascript:void(0)" data-pdf="1"  data-height="430px" data-target="#dmVentana" data-title="Declaración Jurada" data-toggle="modal" style="text-decoration: none"
                                   data-param="declaracionjurada.html?<?php echo base64_encode('persona').'='.base64_encode($row['persona']).'&'.base64_encode('postulante').'='.base64_encode($row['postulante']).'&'.base64_encode('sede').'='.base64_encode($row['sede']).'&'.base64_encode('semestre').'='.base64_encode($row['semestre']).'&'.base64_encode('fase').'='.base64_encode($row['fase']).'&'.base64_encode('estructura').'='.base64_encode($row['estructura']).'&'.base64_encode('modalidad').'='.base64_encode($row['modalidadadmision']).'&'.base64_encode('pasa').'='.base64_encode('SI')?>">
                                    <i class="fa fa-file-o"></i>
                                </a>
                            </td>
                            <td>
                                <?php echo $row['postulante']?>
                            </td>
                            <td>
                                <?php echo $row['nomsede']?>
                            </td>
                            <td>
                                <?php echo $row['semestre']?>
                            </td>
                            <td>
                                <?php echo $row['fase']?>
                            </td>
                            <td>
                                <?php echo $row['nomestructura']?>
                            </td>
                            <td>
                                <?php echo $row['nommodalidadadmision']?>
                            </td>
                            <td>
                                <?php echo $row['puntaje']?>
                            </td>
                            <td>
                                <?php echo $row['puesto']?>
                            </td>
                            <td>
                                <?php
                                if($row['anulado']=='1'){
                                    echo $row['nomanulado'];
                                }else {
                                    echo $row['nomestado'];
                                }
                                    ?>
                            </td>
                        </tr>
                        <?php
                    }
                    }else{?>
                    <tr id="noData">
                        <td colspan="15" style="border-right: 1px solid rgb(204, 204, 204); font-size: 12px;">
                            <div class="alert alert-info fade in center">
                                <strong>No se encontraron registros.</strong>
                            </div>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div><br>
        <table class="data-tbl-simple table table-bordered" align="center" style="width:30%">
            <thead>
            <tr><th colspan="14" style="text-align:center">Leyenda</th></tr>
            </thead>
            <tbody>
            <tr>
                <td style="width:1%"><i class="fa fa-trash icon_size2"></i></td><td>Eliminar Inscripcion </td>
                <td style="width:1%"><i class="fa fa-ban icon_size2"></i></td><td>Cancelar Inscripcion </td>
                <td style="width:1%"><i class="fa fa-vcard icon_size2"></i></td><td>Imprimir Carnet</td>
                <td style="width:1%"><i class="fa fa-file-text icon_size2"></i></span></td><td>Imprimir Ficha de Inscripci&oacute;n</td>
                <td style="width:1%"><i class="fa fa-file-text-o icon_size2"></i></td><td>Imprimir Constancia</td>
                <td style="width:1%"><i class="fa fa-edit icon_size2"></i></td><td>Editar Puntaje</td>
                <td style="width:1%"><i class="fa fa-file-o icon_size2"></i></td><td>Declaración Jurada</td>
            </tr>
            </tbody>
        </table>
    </div>
<script>

    $('#lstpromotor').ajaxChosen({
        dataType: 'json',
        type: 'POST',
        url:'../zet/searchpromotor.php'
    },{
        loadingImg: 'loading.gif'
    });

    $('a[data-toggle=modal]').click(function () {
        var  w=$(this).attr('data-width');
        var  h=$(this).attr('data-height');
        var  pdf=$(this).attr('data-pdf');
        var  print=$(this).attr('data-print');
        w = typeof w !== 'undefined' ?  w : '50%';
        h = typeof h !== 'undefined' ?  h : '100px';
        pdf = typeof pdf !== 'undefined' ?  pdf : 0;
        print = typeof print !== 'undefined' ?  print : 0;
        $('#dmVentana .modal-dialog').css('width',w);
        $('#dmVentana .modal-body').css('min-height',h);
        $('#dmVentana .modal-body').css('padding','5px');
        var title=$(this).attr('data-title');
        $('#dmVentana #modalheader').html('<h4 class="modal-title">'+title+'</h4>');
        $('#dmVentana .modal-body').html('');
        if(print==1) {
            $('#dmVentana .modal-footer').html('<button onclick="document.getElementById(\'frmreporte\').contentWindow.print()" class="btn btn-primary">Imprimir</button>');
        }
        $('<iframe>', {
            src: '../pdf/'+ $(this).attr('data-param').replace(".html", ".php"),
            id:  'frmreporte',
            width:'100%',
            height:h,
            frameborder: 0,
            scrolling: 'no'
        }).appendTo('#dmVentana .modal-body');
        if(pdf==1) {
            var options = {
                pdfOpenParams: {
                    pagemode: "thumbs",
                    navpanes: 0,
                    toolbar: 1,
                    statusbar: 0,
                    view: "FitV"
                }
            };
            var myPDF = PDFObject.embed('../pdf/' + $(this).attr('data-param').replace(".html", ".php"), "#dmVentana .modal-body", options);
            $('embed.pdfobject').css('height', h)
        }
    });

    function modificarPuntaje(persona,postulante,semestre,sede,estructura,fase,modalidad){
        var error=0;
        if(error==0) {
            bootbox.dialog({
                title: 'Asignacion Puntaje',
                message: '<div id="dvPuntaje"></div>',
                buttons: {
                    submit: {
                        label: 'Agregar',
                        className: 'btn-primary',
                        callback: function (result) {
                            $('#frmMantenimientoPuntaje').submit();
                            return false;
                        }
                    },
                    cancel: {
                        label: 'Cancelar',
                        className: 'btn-default'
                    },

                }
            });
            $('#dvPuntaje').load("../zet/asignarpuntaje.php?persona=" + persona+'&postulante='+postulante+'&sede='+sede+'&estructura='+estructura+'&fase='+fase+'&modalidad='+modalidad+'&semestre='+semestre);
        }
    }
</script>