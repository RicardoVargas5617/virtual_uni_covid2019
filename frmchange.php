<?php 
#include_once 'config.php';
#include_once "sessiones.php";
include_once "../config.php";
?>
<!---Inicion Modal Cambio Clave--->
<!--Cambio modal-->
<div id="changeModal" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onclick="$('.modal-backdrop').remove();$('#changeModal').remove();$('body').removeClass('modal-open')" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h1 class="text-center">Cambiar Contrase&ntilde;a</h1>
            </div>
            <div class="modal-body">
                <form class="form center-block" method="post"  action="admi_cambiarclave.php" onsubmit="grabar(this.id);return false" id="frmclave" name="frmclave" autocomplete="off">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-5 control-label"><strong>Contraseña Actual</strong></label>
                        <div class="col-sm-7">
                            <input type="password" autocomplete="off" data-requerido="true" data-requerido-texto="Contraseña Actual" autocorrect="off" id="txtclaveactual" name="txtclaveactual" class="form-control input-lg"  placeholder="Contraseña Actual">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-5 control-label"><strong>Contraseña Nueva</strong></label>
                        <div class="col-sm-7">
                            <input type="password" autocomplete="off" data-requerido="true" minlength="5" autocorrect="off" data-requerido-texto="Contraseña Nueva" id="txtclavenueva" name="txtclavenueva" class="form-control input-lg"  placeholder="Contraseña Nueva">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-5 control-label"><strong>Confirmar Contraseña Nueva</strong></label>
                        <div class="col-sm-7">
                            <input type="password" autocomplete="off"  data-requerido="true" minlength="5" data-covalor="txtclavenueva" id="txtcoclavenueva" data-requerido-texto="Confirmar Contraseña"  name="txtcoclavenueva" class="form-control input-lg"  placeholder="Confirmar Contraseña Nueva">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block">Cambiar Contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!---Inicion Modal Cambio Clave--->