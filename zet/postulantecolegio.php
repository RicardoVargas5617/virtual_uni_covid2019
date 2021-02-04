<?php
$persona='';
$nombrecompleto='';
$apellidopaterno='';
$apellidomaterno='';
$primernombre='';
$segundonombre='';
$numerodocumento='';
$fechanacimiento='';
$varon='1';
$tipodocumento='';
$estadocivil='';
$niveleducativo='';
$pais='9589';
$departamento='06';
$provincia='08';
$distrito='01';
$telefono='';
$celular='';
$tipozona='';
$tipovia='';
$direccion='';
$email='';
$paisestudio='9589';
$departamentoestudio='06';
$provinciaestudio='08';
$distritoestudio='01';
$tipo='B';
$tipocolegio='';
$anioegreso=date('Y');
foreach ($_REQUEST as $k=>$v)
{
    $$k=$v;
}
$cnpersona=conectar();
$vsql="SELECT *
FROM adm_postulante WHERE persona='$persona'";
$rspersona=mysqli_query($cnpersona,$vsql) or die(mysqli_error($cnpersona));
$rowpersona=mysqli_fetch_array($rspersona,MYSQLI_ASSOC);
$centrotrabajo='';
$trabaja =0;
$direcciontrabajo='';
$cargo='';
$telefonotrabajo='';
if(count($rowpersona)>0) {
    foreach ($rowpersona as $key => $valor) {
        $$key = $valor;
    }
}
$cninstituto=conectar();
$vsql="call sp_acaConsultarInstitucion('6','')";
$rsinstituto=mysqli_query($cninstituto,$vsql) or die(mysqli_error($cninstituto));
$cnniveleducativo=conectar();
$vsql="call sp_maeConsultarNivelEducativo('1','')";
$rsniveleducativo=mysqli_query($cnniveleducativo,$vsql);
/*
$cnprofesion=conectar();
$vsql="call sp_maeConsultarProfesion()";
$rsprofesion=mysqli_query($cnprofesion,$vsql);

$cngrado=conectar();
$vsql="call sp_maeConsultarGrado()";
$rsgrado=mysqli_query($cngrado,$vsql);*/
$cntipocolegio=conectar();
$vsql=" SELECT tipocolegio,descripcion FROM adm_tipocolegio";
$rstipocolegio=mysqli_query($cntipocolegio,$vsql);
?>
<form class="form-horizontal  porlets-content" id="frmpostulante"  action="postulantecolegiograbar.html?title=Inscripcion,Datos Postulante" method="post" data-enlace="postulante.html?d=<?php echo $d ?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Inscripci&oacute;n')?>" name="frmpostulante" onsubmit="grabar(this.id);return false;">
    <input type="hidden" id="hidpersona" name="hidpersona" value="<?php echo $persona?>">
    <input type="hidden" id="hidtipogrado" name="hidtipogrado" value="<?php echo $tipo?>">
    <fieldset style="padding: 15px">
        <header class="dark col-lg-12 fa-hover">
            <div class="panel-heading">
                <h3 class="panel-title"> <i class="fa fa-graduation-cap"></i>
                    DATOS ESTUDIOS B&Aacute;SICOS
                </h3>
            </div>
        </header>
        <div class="row-fluid" style="padding: 15px">
            <div class="form-group col-lg-12">
            </div>
            <div class="form-group col-lg-12">
                <label class="control-label col-lg-2">Institucion:</label>
                <div class="controls col-lg-8">
                    <select name="lstinstitucion" id="lstinstitucion" class="chosen-select col-lg-6"  data-requerido="true" data-requerido-texto="Institucion Estudio">
                        <option value="">SELECCIONAR...</option>
                        <?php
                        $nomubigeo='';
                        $i=0;
                        while($row=mysqli_fetch_array($rsinstituto,MYSQLI_ASSOC)){

                            if($nomubigeo!=$row['nomubigeo']){
                                if($nomubigeo!='' and $i>0){
                                    echo '</optgroup>';
                                }
                                echo '<optgroup label="'.$row['nomubigeo'].'">';
                            }
                            ++$i;
                            $nomubigeo=$row['nomubigeo'];
                            echo '<option value="'.$row['institucion'].'" '.($row['institucion']==$colegio?' selected ':'').'>'.$row['descripcion'].'</option>';
                        }
                        ?>
                        </optgroup>
                    </select>
                </div>
            </div>

                <div class="form-group col-lg-6">
                    <label class="control-label col-lg-4">A&ntilde;o Egreso:</label>
                    <div class="controls">
                        <div class="input-append col-lg-8">
                            <select name="lstegreso" id="lstegreso" class="span12">
                                <option value="_none_">SELECCIONAR...</option>
                                <?php for($y=date(Y);$y>=1960;$y--){?>
                                <option value="<?php echo $y?>" <?php echo $y==$anioegreso?' selected ':''?>><?php echo $y?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>

            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">Tipo Colegio:</label>
                <div class="controls">
                    <div class="input-append col-lg-8">
                        <select name="lsttipocolegio" id="lsttipocolegio" class="span12">
                            <option value="_none_">SELECCIONAR...</option>
                            <?php while($row=mysqli_fetch_array($rstipocolegio,MYSQLI_ASSOC)){?>
                                <option value="<?php echo $row['tipocolegio']?>" <?php echo $row['tipocolegio']==$tipocolegio?' selected ':''?>><?php echo $row['descripcion']?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <header class="dark col-lg-12 fa-hover">
            <div class="panel-heading">
                <h3 class="panel-title"> <i class="fa fa-graduation-cap"></i>
                    DATOS ESTUDIOS SUPERIOR/UNIVERSITARIO
                </h3>
            </div>
        </header>
        <div class="row-fluid" style="padding: 15px">
            <div class="form-group col-lg-12">
            </div>

            <div class="form-group col-lg-7">
                <label class="control-label col-lg-2">Institucion:</label>
                <div class="controls col-lg-8">
                    <select name="lstinstitucionsuperior" id="lstinstitucionsuperior" class="chosen-select col-lg-6">
                        <option value="">SELECCIONAR...</option>
                        <?php
                        $nomubigeo='';
                        $i=0;
                        mysqli_data_seek($rsinstituto,0);
                        while($row=mysqli_fetch_array($rsinstituto,MYSQLI_ASSOC)){

                            if($nomubigeo!=$row['nomubigeo']){
                                if($nomubigeo!='' and $i>0){
                                    echo '</optgroup>';
                                }
                                echo '<optgroup label="'.$row['nomubigeo'].'">';
                            }
                            ++$i;
                            $nomubigeo=$row['nomubigeo'];
                            echo '<option value="'.$row['institucion'].'" '.($row['institucion']==$universidad?' selected':'').'>'.$row['descripcion'].'</option>';
                        }
                        ?>
                        </optgroup>
                    </select>
                </div>
            </div>
                <div class="form-group col-lg-5">
                    <label class="control-label col-lg-4">Semestre Egreso:</label>
                    <div class="controls">
                            <select name="lstegresosuperior" id="lstegresosuperior" class="col-lg-8">
                                <option value="">SELECCIONAR...</option>
                                <?php for($y=date(Y);$y>=1960;$y--){
                                    for($i=0;$i<=2;$i++) {
                                        ?>
                                        <option value="<?php echo $y.(substr('00'.$i,-2));?>" <?php echo $y.(substr('00'.$i,-2))==$periodoegreso?' selected ':''?>><?php echo $y.(substr('00'.$i,-2));?></option>
                                        <?php
                                    }
                                    }?>
                            </select>
                    </div>
                </div>
        </div>

        <header class="dark col-lg-12 fa-hover">
            <div class="panel-heading">
                <h3 class="panel-title"> <i class="fa fa-building"></i>
                    DATOS LABORALES
                </h3>
            </div>
        </header>
        <div class="row-fluid" style="padding: 15px">
            <div class="form-group col-lg-12">
            </div>

            <div class="form-group col-lg-3">
                <label class="control-label col-lg-5">Trabaja:</label>
                <div class="controls col-lg-7">
                    <input type="checkbox" name="chbtrabaja" id="chbtrabaja" <?php echo $trabaja==1?' checked':''?> value="1">
                </div>
            </div>
            <!--<div class="form-group col-lg-8">
                <label class="control-label col-lg-2">Profesion:</label>
                <div class="controls col-lg-10">
                    <select name="lstprofesion" id="lstprofesion" style="width: 80%" class="chosen-select col-lg-12">
                        <option value="">SELECCIONAR...</option>
                        <?php
                        while($row=mysqli_fetch_array($rsprofesion,MYSQLI_ASSOC)){
                            ?>
                            <option value="<?php echo $row['profesion']?>" <?php echo $row['profesion']==$profesion?' selected':''?>><?php echo $row['nombre']?></option>
                        <?php    }
                        ?>
                    </select>
                </div>
            </div>-->
            <!--<div class="form-group col-lg-4">
                <label class="control-label col-lg-4">
                    Grado:
                </label>
                <div class="controls">
                    <select name="lstgrado" id="lstgrado" class="col-lg-8">
                        <option value="">SELECCIONAR...</option>
                        <?php
                        while($row=mysqli_fetch_array($rsgrado,MYSQLI_ASSOC)){
                            ?>
                            <option value="<?php echo $row['grado']?>" <?php echo $row['grado']==$grado?' selected':''?>><?php echo $row['descripcion']?></option>
                        <?php    }
                        ?>
                    </select>
                </div>
            </div>-->
            <div class="form-group col-lg-8" style="height: 35px">
                <label class="control-label col-lg-4">Centro Trabajo:</label>
                <div class="controls">
                    <input type="text" name="txtcentrotrabajo" class="col-lg-8" value="<?php echo $centrotrabajo?>">
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">Cargo Trabajo:</label>
                <div class="controls">
                    <input type="text" name="txtcargotrabajo" class="col-lg-8" value="<?php echo $cargo?>">
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">Direccion Trabajo:</label>
                <div class="controls">
                    <input type="text" name="txtdirecciontrabajo" class="col-lg-8" value="<?php echo $direcciontrabajo?>">
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">Telefono Trabajo:</label>
                <div class="controls">
                    <input type="text" name="txttelefonotrabajo" class="col-lg-8" value="<?php echo $telefonotrabajo?>">
                </div>
            </div>
        </div>


        <div class="form-actions no-margin-bottom col-lg-12">
            <button type="submit" class="btn btn-primary"><i class="icon-white icon-ok"></i> Guardar Informaci&oacute;n</button>
            <!--<button class="btn" type="button">Cancelar</button>-->

        </div>
    </fieldset>
</form>
