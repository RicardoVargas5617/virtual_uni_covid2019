<?php
require_once ('config.php');
require_once (GL_DIR_FS_APP. 'class/administracion/mae_etiquetas.class.php');

$etiqueta = new mae_etiquetas();

$dataetiqueta = $etiqueta ->listarEtiquetas();

foreach ($dataetiqueta as $valor) {
    $constante  = $valor['constante'];
    $descripcion = $valor['descripcion'];
    define($constante, $descripcion);
}