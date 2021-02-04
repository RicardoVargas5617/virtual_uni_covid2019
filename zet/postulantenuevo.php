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
$paisnac='9589';
$departamentonac='06';
$provincianac='08';
$distritonac='01';
foreach ($_REQUEST as $k=>$v)
{
    $$k=$v;
}
$cnpersona=conectar();
$vsql="CALL spweb_maeConsultarPersona('','$persona')";
$rspersona=mysqli_query($cnpersona,$vsql) or die(mysqli_error($cnpersona));
$rowpersona=mysqli_fetch_array($rspersona,MYSQLI_ASSOC);
if($rspersona->num_rows>0) {
    foreach ($rowpersona as $key => $valor) {
        $$key = $valor;
    }
}
$cndepartamento=conectar();
$vsql="call sp_maeUbigeo('".$pais."','1')";
$rsdepartamento=mysqli_query($cndepartamento,$vsql) or die(mysqli_error($cndepartamento));
$cnprovincia=conectar();
$vsql="call sp_maeUbigeo('".$pais.$departamento."','2')";
$rsprovincia=mysqli_query($cnprovincia,$vsql) or die(mysqli_error($cnprovincia));
$cndistrito=conectar();
$vsql="call sp_maeUbigeo('".$pais.$departamento.$provincia."','3')";
$rsdistrito=mysqli_query($cndistrito,$vsql) or die(mysqli_error($cndistrito));

$cndepartamentonac=conectar();
$vsql="call sp_maeUbigeo('".$paisnac."','1')";
$rsdepartamentonac=mysqli_query($cndepartamentonac,$vsql) or die(mysqli_error($cndepartamentonac));
$cnprovincianac=conectar();
$vsql="call sp_maeUbigeo('".$paisnac.$departamentonac."','2')";
$rsprovincianac=mysqli_query($cnprovincianac,$vsql) or die(mysqli_error($cnprovincianac));
$cndistritonac=conectar();
$vsql="call sp_maeUbigeo('".$paisnac.$departamentonac.$provincianac."','3')";
$rsdistritonac=mysqli_query($cndistritonac,$vsql) or die(mysqli_error($cndistritonac));



$cntipodocumento=conectar();
$vsql="CALL sp_maeConsultarTipoDocumentos('1','')";
$rstipodocumento=mysqli_query($cntipodocumento,$vsql) or die(mysqli_error($cntipodocumento));
$cnniveleducativo=conectar();
$vsql="CALL sp_maeConsultarNivelEducativo('1','')";
$rsniveleducativo=mysqli_query($cnniveleducativo,$vsql) or die(mysqli_error($cnniveleducativo));
$cnpais=conectar();
$vsql="CALL sp_maeConsultarPais('1','')";
$rspais=mysqli_query($cnpais,$vsql) or die(mysqli_error($cnpais));
$cntipovia=conectar();
$vsql="CALL spweb_maeConsultarTipoVia('1','')";
$rstipovia=mysqli_query($cntipovia,$vsql) or die(mysqli_error($cntipovia));
$cntipozona=conectar();
$vsql="CALL spweb_maeConsultarTipoZona('1','')";
$rstipozona=mysqli_query($cntipozona,$vsql) or die(mysqli_error($cntipozona));
$cnestadocivil=conectar();
$vsql="CALL sp_maeConsultarEstadoCivil('1','')";
$rsestadocivil=mysqli_query($cnestadocivil,$vsql) or die(mysqli_error($cnestadocivil));


?>
<form class="form-horizontal porlets-content" id="frmpostulante" data-enlace="postulantecolegio.html?d=<?php echo $d ?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Datos Estudio')?>" name="frmpostulante" action="postulantepersona.html?title=Inscripcion,Datos Colegio" method="post"  onsubmit="grabar(this.id);return false;">
    <input type="hidden" id="hidpersona" name="hidpersona" value="<?php echo $persona?>" data-objeto="persona">
    <input type="hidden" id="hidtipogrado" name="hidtipogrado" value="">
    <input type="hidden" value="">
    <fieldset style="padding: 15px">
        <div class="row-fluid" style="background: #f9f9f9;">

            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">  Apellido Paterno:</label>
                <div class="controls  col-lg-8">
                    <input type="text" id="txtapellidopaterno" data-requerido="true" data-requerido-texto="Apellido Paterno" class="form-control col-lg-5" name="txtapellidopaterno" value="<?php echo $apellidopaterno?>">
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4" for="typehead">  Apellido Materno:</label>
                <div class="controls  col-lg-8">
                    <input type="text" id="txtapellidomaterno" data-requerido="true" data-requerido-texto="Apellido Materno" class="form-control col-lg-5" name="txtapellidomaterno" value="<?php echo $apellidomaterno?>">
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">  Primer Nombre:</label>
                <div class="controls  col-lg-8">
                    <input type="text" id="txtprimernombre" data-requerido="true" data-requerido-texto="Primer Nombre" class="form-control col-lg-5" name="txtprimernombre" value="<?php echo $primernombre?>">
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">Segundo Nombre:</label>
                <div class="controls  col-lg-8">
                    <input type="text" id="txtsegundonombre" class="form-control col-lg-5" name="txtsegundonombre" value="<?php echo $segundonombre?>">
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">Sexo:</label>
                <div class="controls  col-lg-8">
                    <input type="radio" id="rdbvaron" <?php echo $varon=='1'?'checked':''?> name="rdbvaron" value="1">Masculino
                    <input type="radio" id="rdbvaron" <?php echo $varon=='0'?'checked':''?> name="rdbvaron" value="0">Femenino
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">Fecha Nacimiento:</label>
                <div class="controls  col-lg-8">
                    <input type="text" id="txtfechanacimiento" class="form-control col-lg-8" name="txtfechanacimiento" value="<?php echo $fechanacimiento?>"><span class="add-on margin-fix datepick-trigger"><i class="icon-th"></i></span>
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">  Tipo Documento:</label>
                <div class="controls  col-lg-8">
                    <select name="lsttipodocumento" id="lsttipodocumento" data-requerido="true" data-requerido-texto="Tipo Documento" class="form-control col-lg-5">
                        <?php while($row=mysqli_fetch_array($rstipodocumento,MYSQLI_ASSOC)){?>
                    <option title="<?php echo $row['descripcion']?>" value="<?php echo $row['tipodocumento']?>"><?php echo $row['descripcion']?></option>
                        <?php }?>
                    </select>
            </div>
        </div>
        <div class="form-group col-lg-6" style="height: 35px;">
            <label class="control-label col-lg-4">  N&uacute;mero Documento:</label>
                <div class="controls  col-lg-8">
                    <input type="text" data-requerido="true" data-requerido-texto="Numero Documento" id="txtnumerodocumento" name="txtnumerodocumento" class="form-control col-lg-5" value="<?php echo $numerodocumento?>">
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">Nivel Educativo:</label>
                <div class="controls  col-lg-8">
                    <select name="lstniveleducativo" id="lstniveleducativo" class="form-control col-lg-5">
                        <?php while($row=mysqli_fetch_array($rsniveleducativo,MYSQLI_ASSOC)){?>
                        <option title="<?php echo $row['descripcion']?>" value="<?php echo $row['niveleducativo']?>"><?php echo $row['descripcion']?></option>
                        <?php }?>
                    </select>
                </div>
            </div>



           <!--- <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">Ubigeo:</label>
                <div class="controls  col-lg-8">
                    <input id="txtubigeo" class="form-control easyui-combotree" value="" name="txtubigeo" style="width: 250px">
                </div>
            </div>-->
            <!--
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">Pa&iacute;s:</label>
                <div class="controls  col-lg-8">
                    <select name="lstpais" id="lstpais" class="form-control col-lg-5" onchange="dataselectjason('lstdepartamento',{proc:'<?php echo base64_encode('sp_maeUbigeo')?>',listproc:this.value+',1',listcam:'<?php echo base64_encode('codigo,descripcion')?>'});$('#lstdepartamento').change();$('#lstprovincia').change();" data-requerido="true" data-requerido-texto="Pais">
                            <option value="">SELECCIONAR...</option>
                        <?php
                        while($row=mysqli_fetch_array($rspais,MYSQLI_ASSOC)){?>
                            <option title="<?php echo $row['descripcion']?>"  <?php echo $row['pais']==$pais?'selected':''?> value="<?php echo $row['pais']?>"><?php echo $row['descripcion']?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

               <div class="form-group col-lg-6">
                   <label class="control-label col-lg-4">Departamento:</label>
                   <div class="controls  col-lg-8" id="dvdepartamento">
                       <select name="lstdepartamento" id="lstdepartamento" class="form-control col-lg-5" onchange="dataselectjason('lstprovincia',{proc:'<?php echo base64_encode('sp_maeUbigeo')?>',listproc:$('#lstpais').val()+this.value+',2',listcam:'<?php echo base64_encode('codigo,descripcion')?>'});dataselectjason('lstprovincia');dataselectjason('lstdistrito');" data-requerido="true" data-requerido-texto="Departamento">
                           <option value="">SELECCIONAR...</option>
                           <?php
                           while($row=mysqli_fetch_array($rsdepartamento,MYSQLI_ASSOC)){?>
                               <option title="<?php echo $row['descripcion']?>"  <?php echo $row['departamento']==$departamento?'selected':''?> value="<?php echo $row['departamento']?>"><?php echo $row['descripcion']?></option>
                           <?php }?>
                       </select>
                   </div>
               </div>
               <div class="form-group col-lg-6">
                   <label class="control-label col-lg-4">Provincia:</label>
                   <div class="controls  col-lg-8" id="dvprovincia">
                       <select name="lstprovincia" id="lstprovincia" class="form-control col-lg-5" onchange="dataselectjason('lstdistrito',{proc:'<?php echo base64_encode('sp_maeUbigeo')?>',listproc:$('#lstpais').val()+this.value+',3',listcam:'<?php echo base64_encode('codigo,descripcion')?>'});" data-requerido="true" data-requerido-texto="Provincia">
                           <option value="">SELECCIONAR...</option>
                           <?php
                           while($row=mysqli_fetch_array($rsprovincia,MYSQLI_ASSOC)){?>
                               <option title="<?php echo $row['descripcion']?>"  <?php echo $row['provincia']==$provincia?'selected':''?> value="<?php echo $row['provincia']?>"><?php echo $row['descripcion']?></option>
                           <?php }?>
                       </select>
                   </div>
               </div>
               <div class="form-group col-lg-6">
                   <label class="control-label col-lg-4">Distrito:</label>
                   <div class="controls  col-lg-8" id="dvdistrito">
                       <select name="lstdistrito" id="lstdistrito" data-requerido="true" data-requerido-texto="Distrito" class="form-control col-lg-5">
                           <option value="">SELECCIONAR...</option>
                           <?php
                           while($row=mysqli_fetch_array($rsdistrito,MYSQLI_ASSOC)){?>
                               <option title="<?php echo $row['descripcion']?>"  <?php echo $row['distrito']==$distrito?'selected':''?> value="<?php echo $row['departamento'].$row['provincia'].$row['distrito']?>"><?php echo $row['descripcion']?></option>
                           <?php }?>
                       </select>
                   </div>
               </div>-->

            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">Tipo V&iacute;a:</label>
                <div class="controls  col-lg-8">
                    <select name="lsttipovia" id="lsttipovia" class="form-control col-lg-5">
                        <?php while($row=mysqli_fetch_array($rstipovia,MYSQLI_ASSOC)){?>
                        <option title="<?php echo $row['descripcion']?>" value="<?php echo $row['tipovia']?>"><?php echo $row['descripcion']?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">Celular:</label>
                <div class="controls  col-lg-8">
                    <input type="text" id="txtcelular" data-trigger="hover" data-toggle="popover" data-content="Ingresar Numero " data-original-title="Celular" class="form-control col-lg-5 mask
" data-inputmask="'mask':'999 999 999'"  name="txtcelular" value="<?php echo $celular?>">
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">Tel&eacute;fono Fijo:</label>
                <div class="controls  col-lg-8">
                    <input type="text" id="txttelefonofijo" data-inputmask="'mask':'(999) 999 999'" class="form-control mask col-lg-5 popovers" name="txttelefonofijo"  data-trigger="hover" data-toggle="popover" data-content="Anteponer el codigo de la ciudad" data-original-title="Telefono Fijo" value="<?php echo ($telefono!='')?substr('000'.$telefono,-9):''?>">
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">Pa&iacute;s Nacimiento:</label>
                <div class="controls  col-lg-8">
                    <select name="lstpaisnacimiento" id="lstpaisnacimiento" class="form-control col-lg-5" onchange="dataselectjason('lstdepartamentonacimiento',{proc:'<?php echo base64_encode('sp_maeUbigeo')?>',listproc:this.value+',1',listcam:'<?php echo base64_encode('codigo,descripcion')?>'});$('#lstdepartamentonacimiento').change();$('#lstprovincianacimiento').change();" data-requerido="true" data-requerido-texto="Pais Nacimiento">
                        <option value="">SELECCIONAR...</option>
                        <?php
                        mysqli_data_seek($rspais,0);
                        while($row=mysqli_fetch_array($rspais,MYSQLI_ASSOC)){?>
                            <option title="<?php echo $row['pais']?>" <?php echo $row['pais']==$paisnac?'selected':''?> value="<?php echo $row['pais']?>"><?php echo $row['descripcion']?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <div class="form-group col-lg-6">
                 <label class="control-label col-lg-4">Dep. Nacimiento:</label>
                 <div class="controls  col-lg-8" id="dvdepartamentonacimiento">
                     <select name="lstdepartamentonacimiento" id="lstdepartamentonacimiento" class="form-control col-lg-5" onchange="dataselectjason('lstprovincianacimiento',{proc:'<?php echo base64_encode('sp_maeUbigeo')?>',listproc:$('#lstpaisnacimiento').val()+this.value+',2',listcam:'<?php echo base64_encode('codigo,descripcion')?>'});$('#lstprovincianacimiento').change()" data-requerido="true" data-requerido-texto="Departamento Nacimiento">
                         <option value="">SELECCIONAR...</option>
                         <?php
                         while($row=mysqli_fetch_array($rsdepartamentonac,MYSQLI_ASSOC)){?>
                             <option title="<?php echo $row['descripcion']?>"  <?php echo $row['departamento']==$departamentonac?'selected':''?> value="<?php echo $row['departamento']?>"><?php echo $row['descripcion']?></option>
                         <?php }?>
                     </select>
                 </div>
             </div>
             <div class="form-group col-lg-6">
                 <label class="control-label col-lg-4">Prov. Nacimiento:</label>
                 <div class="controls  col-lg-8" id="dvprovincianacimiento">
                     <select name="lstprovincianacimiento" id="lstprovincianacimiento" class="form-control col-lg-5" onchange="dataselectjason('lstdistritonacimiento',{proc:'<?php echo base64_encode('sp_maeUbigeo')?>',listproc:$('#lstpaisnacimiento').val()+this.value+',3',listcam:'<?php echo base64_encode('codigo,descripcion')?>'});"  data-requerido="true" data-requerido-texto="Provincia Nacimiento">
                         <option value="">SELECCIONAR...</option>
                         <?php
                         while($row=mysqli_fetch_array($rsprovincianac,MYSQLI_ASSOC)){?>
                             <option title="<?php echo $row['descripcion']?>"  <?php echo $row['provincia']==$provincianac?'selected':''?> value="<?php echo $row['departamento'].$row['provincia']?>"><?php echo $row['descripcion']?></option>
                         <?php }?>
                     </select>
                 </div>
             </div>
             <div class="form-group col-lg-6">
                 <label class="control-label col-lg-4">Dis. Nacimiento:</label>
                 <div class="controls  col-lg-8" id="dvdistritonacimiento">
                     <select name="lstdistritonacimiento" id="lstdistritonacimiento" class="form-control col-lg-5" data-requerido="true" data-requerido-texto="Distrito Nacimiento">
                         <option value="">SELECCIONAR...</option>
                         <?php
                         while($row=mysqli_fetch_array($rsdistritonac,MYSQLI_ASSOC)){?>
                             <option title="<?php echo $row['descripcion']?>"  <?php echo $row['distrito']==$distritonac?'selected':''?> value="<?php echo $row['departamento'].$row['provincia'].$row['distrito']?>"><?php echo $row['descripcion']?></option>
                         <?php }?>
                     </select>
                 </div>
             </div>

            <!--<div class="form-group col-lg-6">
                <label class="control-label col-lg-4">Ubigeo Nac.:</label>
                <div class="controls  col-lg-8">
                    <input id="txtubigeo" class="form-control easyui-combotree" value="" name="txtubigeo" style="width: 250px">
                </div>
            </div>
-->

            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">Estado Civil:</label>
                <div class="controls  col-lg-8">
                    <select name="lstestadocivil" id="lstestadocivil" class="form-control col-lg-5">
                        <?php while($row=mysqli_fetch_array($rsestadocivil,MYSQLI_ASSOC)){?>
                            <option title="<?php echo $row['descripcion']?>" value="<?php echo $row['estadocivil']?>"><?php echo $row['descripcion']?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">Tipo Zona:</label>
                <div class="controls  col-lg-8">
                    <select name="lsttipozona" id="lsttipozona" class="form-control col-lg-5">
                        <?php while($row=mysqli_fetch_array($rstipozona,MYSQLI_ASSOC)){?>
                            <option title="<?php echo $row['descripcion']?>" value="<?php echo $row['tipozona']?>"><?php echo $row['descripcion']?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">Direcci&oacute;n:</label>
                <div class="controls  col-lg-8">
                    <input type="text" id="txtdireccion" name="txtdireccion" class="form-control col-lg-5" value="<?php echo $direccion?>">
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="control-label col-lg-4">  E-Mail:</label>
                <div class="controls  col-lg-8">
                    <input type="text" id="txtemail" name="txtemail" data-email="true" data-requerido="true" data-requerido-texto="Correo Electronico" class="form-control col-lg-5" value="<?php echo $email?>">
                </div>
            </div>

        </div>
        <div class="form-actions no-margin-bottom col-lg-12">
            <button type="submit" class="btn btn-primary"><i class="icon-white icon-ok"></i> Guardar</button>
        </div>
    </fieldset>
</form>