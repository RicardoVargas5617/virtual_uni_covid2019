<?php

/**
 * Permite ajustar por redondeo un monto determinado
 * El ajuste se basa en la recomendacion de la SBS PERU y el redondeo debe favorecer siempre al cliente:
 * 
 * Ej.
 * 
 * 10.52 => 10.50
 * 10.58 => 10.55
 * 10.59 => 10.55
 * 10.55 => 10.55
 * 
 * 
 * @param type $monto
 */
function ajusteRedondeo($monto) {

    $monto = round($monto, 2);

    if ((float) $monto > 0) {

        $sep = explode('.', $monto);
        if (count($sep) == 2) {
            $digitoCentena = 0;

            $decena = substr($sep[1], 0, 1);
            $centena = substr($sep[1], 1, 1);
            if ((float) $centena >= 5) {
                $digitoCentena = 5;
            }

            return array((float) ($sep[0] . '.' . $decena . $digitoCentena), (float) ('-0.0' . ((float) $centena - (float) $digitoCentena)));
        } else {
            return array($monto, 0.00);
        }
    } else {
        return array(0.00, 0.00);
    }
}

function roundSBS($importe) {
    $sImporte = $importe;
    $sSep = explode(".", $importe);

    if (count($sSep) == 2 && strlen($sSep[1]) == 2) {
        if ((int) substr($sImporte, -1) >= 1 && (int) substr($sImporte, -1) <= 4) {
            $sImporte = substr($sImporte, 0, strlen($sImporte) - 1) + '0';
        } else if ((int) substr($sImporte, -1) >= 6 && (int) substr($sImporte, -1) <= 9) {
            $sImporte = substr($sImporte, 0, strlen($sImporte) - 1) + '5';
        }
    }

    return $sImporte;
}

function ymd($fecha) {
    $xfs = $fecha;
    if (strlen($fecha) >= 10)
        $xfs = substr($fecha, 6, 4) . "-" . substr($fecha, 3, 2) . "-" . substr($fecha, 0, 2);

    return $xfs;
}

function dmy($fecha) {
    $xfs1 = $fecha;
    if (strlen($fecha) >= 10)
        $xfs1 = substr($fecha, 8, 2) . "-" . substr($fecha, 5, 2) . "-" . substr($fecha, 0, 4);

    return $xfs1;
}

function addSepDate($fechaDDMMYYYY, $formatoSalida) {
    if ($formatoSalida == 'ymd') {
        return substr($fechaDDMMYYYY, 4, 4) . '-' . substr($fechaDDMMYYYY, 2, 2) . '-' . substr($fechaDDMMYYYY, 0, 2);
    } else {
        return substr($fechaDDMMYYYY, 0, 2) . '-' . substr($fechaDDMMYYYY, 2, 2) . '-' . substr($fechaDDMMYYYY, 4, 4);
    }
}

function addSepDateAMD($fechaYYYYMMDD) {
    # 20130222
    return substr($fechaYYYYMMDD, 0, 4) . '-' . substr($fechaYYYYMMDD, 4, 2) . '-' . substr($fechaYYYYMMDD, 6, 2);
}

function stripSeparatorDate($fecha) {
    return str_replace('/', '', str_replace('-', '', $fecha));
}

/**
 * Permite eliminar el separador de miles de un importe dado
 * 
 * @param type $importe
 * @return type
 */
function stripSeparatorMiles($importe) {
    return (float) str_replace(',', '', $importe);

    //return ((int) preg_replace('/[^\d]/', '', $importe));
}

/**
 * Permite quitar el punto decimal de un importe; es utilizado normalmente para
 * los importes en la elaboracion de archivos para el banco.
 * 
 * @param type $importe
 * @return string
 */
function stripImporte($importe) {
    $importe = (float) $importe;

    $arr = explode('.', (string) trim($importe));
    if ($arr == 2) {
        $importe = $arr[0] . $arr[1];
    }

    return $importe;
}

function isWindow() {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        return true;
    } else {
        return false;
    }
}

function ln() {
    return (isWindow() ? "\r\n" : "\r\n");
}

function zipFile($fileNameZip, $files) {
    $zip = new ZipArchive();

    if ($zip->open($fileNameZip, ZIPARCHIVE::CREATE) === true) {
        if (is_array($files)) {
            foreach ($files as $file) {
                $zip->addFile($file, basename($file));
            }
        } else {
            $zip->addFile($files, basename($files));
        }
        $zip->close();
        return true;
    } else {
        return false;
    }
}

function addDate($givendate, $day = 0, $mth = 0, $yr = 0) {
    $cd = strtotime($givendate);
    $newdate = date('Y-m-d h:i:s', mktime(date('h', $cd), date('i', $cd), date('s', $cd), date('m', $cd) + $mth, date('d', $cd) + $day, date('Y', $cd) + $yr));
    return $newdate;
}

function sumaFechas($fecha, $ndias) {
    if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/", $fecha))
        list($dia, $mes, $anio) = explode("/", $fecha);
    if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/", $fecha))
        list($dia, $mes, $anio) = explode("-", $fecha);
    $nueva = mktime(0, 0, 0, $mes, $dia, $anio) + $ndias * 24 * 60 * 60;
    $nuevafecha = date("d/m/Y", $nueva);
    return ($nuevafecha);
}

/**
 * 
 * @param type $fechaDMA
 * @param type $parametro:  d=dia, m=mes, a=anio
 * @return type
 */
function getDateParam($fechaDMA, $parametro) {
    $value = 0;
    if (strlen($fechaDMA) == 10) {
        $fechaDMA = str_replace('/', '-', $fechaDMA);
        $aValues = explode("-", $fechaDMA);

        $value = '';
        if ($parametro == 'd') {
            $value = $aValues[0];
        } else if ($parametro == 'm') {
            $value = $aValues[1];
        } else if ($parametro == 'a') {
            $value = $aValues[2];
        }
    }
    return $value;
}

function getDateMesLetra($mes) {
    $mesl = '';
    switch ((int) $mes) {
        case 1:
            $mesl = 'Enero';
            break;
        case 2:
            $mesl = 'Febrero';
            break;
        case 3:
            $mesl = 'Marzo';
            break;
        case 4:
            $mesl = 'Abril';
            break;
        case 5:
            $mesl = 'Mayo';
            break;
        case 6:
            $mesl = 'Junio';
            break;
        case 7:
            $mesl = 'Julio';
            break;
        case 8:
            $mesl = 'Agosto';
            break;
        case 9:
            $mesl = 'Setiembre';
            break;
        case 10:
            $mesl = 'Octubre';
            break;
        case 11:
            $mesl = 'Noviembre';
            break;
        case 12:
            $mesl = 'Diciembre';
            break;
    }

    return $mesl;
}

function validateEmail($email) {
    return (!filter_var($email, FILTER_VALIDATE_EMAIL) ? false : true );
}

function accessDenied() {
    echo '<center><br/><br/><div style="padding:5px 5px 5px 5px;
                    font-size:12px;
                    font-family:Arial;
                    border:2px solid #FF0000;    
                    color:#FF0000;
                    text-align:left;
                    max-width: 350px;
                    background:#FFFF99;
                    line-height:18px;"><span style="font-weight:bold;font-size:14px;">Acceso Denegado</span><br/><br/>
                    Al parecer su sesi&oacute;n a caducado, por favor ingrese nuevamente al sistema e inicie sesi&oacute;n.
    </div></center>';
}

function ___singleArray($dataFields) {
    $dataFields2 = $dataFields;
    if (is_array($dataFields[0]) || is_array($dataFields[1])) {
        $i = 0;
        foreach ($dataFields as $item) {
            if (is_array($item)) {
                foreach ($item as $a) {
                    $dataFields2[$i++] = trim($a);
                }
            } else {
                $dataFields2[$i++] = $item;
            }
        }
    }
    $i = 0;

    return $dataFields2;
}

function ___phpToJS($data, $dataFieldsSingle, $dataFields, $regMax, $flag = 0, $charSep = '-') {
    $result = '';
    if (is_array($data)) {
        if ($flag == 0) {
            $data2 = array();
            $i = 0;
            foreach ($data as $item) {
                $item2 = array();

                # value ------------------------------------------
                if (is_array($dataFields[0])) {
                    $s = '';
                    foreach ($dataFields[0] as $o) {
                        foreach ($item as $key => $value) {
                            if ($o == $key) {
                                if ($s != '' && (string) trim($value) != '')
                                    $s.= $charSep;

                                $s.= trim($value);
                            }
                        }
                    }
                    $item2['id'] = $s;
                } elseif (!is_array($dataFields[0])) {
                    foreach ($item as $key => $value) {
                        if ($dataFields[0] == $key) {
                            $item2['id'] = trim($value);
                            break;
                        }
                    }
                }

                #text ------------------------------------------
                $s = '';
                if (is_array($dataFields[1])) {
                    $s = '';
                    foreach ($dataFields[1] as $o) {
                        foreach ($item as $key => $value) {
                            if ($o == $key) {
                                if ($s != '' && (string) $value != '')
                                    $s.= $charSep;
                                $s.= trim($value);
                            }
                        }
                    }
                    $item2['dsc'] = trim($s);
                }
                elseif (!is_array($dataFields[1])) {
                    foreach ($item as $key => $value) {
                        if ($dataFields[1] == $key) {
                            $item2['dsc'] = trim($value);
                            break;
                        }
                    }
                }

                $data2[$i++] = $item2;
            }
            $data = $data2;
        }

        # -----------------------------------------
        # convertir el array en array para javascript
        foreach ($data as $value) {
            if ($result != '')
                $result .= ', ';

            $result .= ___phpToJS($value, $dataFieldsSingle, $dataFields, $regMax, 1);
        }
        $result = '[' . $result . ']';
    }
    else {

        $result = var_export($data, true);
    }

    return $result;
}

/**
 * 
 * @param type $data         : Array con los datos.
 * @param type $dataFields   : Array con los campos que se consideran para mostrar en la lista 
 *                             y los campos que se devolver�n cuando se selecciona un elemento.                                    
 * @param type $objectResult : Id del caja de texto donde se almacenara el valor seleccionado.
 * @param type $regMax       : Numero maximo de filas que se mostrar�n, si es 0 (cero) se muestra todo. Por defecto es 20.
 * @param type $charSep      : Caracter de separacion de columnas. Valido solo cuando se desea devolver mas de una columna.
 * 
 * @return string            : Cadena con el codigo script resultante que se ejecutar� con la funcion addScript() de xajax.
 * 
 *                   Ejemplos:
 *  
 *                             searchResult($data, array('alumno', 'nombres'), 'txtAlumno');
 *                             searchResult($data, array('persona', array('ruc', 'razonsocial')), 'txtPersona');
 *                             searchResult($data, array('persona', array('ruc', 'razonsocial')), 'txtPersona', 50);
 * 
 */
function searchResult($data, $dataFields, $objectResult = 'txtSearchSelected', $regMax = 20, $charSep = '-') {
    $objectResult = (trim($objectResult) == '' ? 'txtSearchSelected' : $objectResult);

    $objectResultLayer = $objectResult . 'Layer';
    $objectResultId = $objectResult . 'Id';

    $html = 'getElemento("' . $objectResultLayer . '").innerHTML = \'Campos a mostrar incorrectos.\';getElemento("' . $objectResultLayer . '").style.display= \'block\';getElemento(\'' . $objectResult . '\').value=\'\';if(document.getElementById(\'' . $objectResultId . '\')){getElemento(\'' . $objectResultId . '\').value=\'\';}';


    if (is_array($dataFields) && count($dataFields) == 2) {
        $dataFieldsSingle = ___singleArray($dataFields);
        $result = ___phpToJS($data, $dataFieldsSingle, $dataFields, $regMax, 0, $charSep);

        if ($result != '' && count($data) > 0) {
            $html = 'var arrxxyy = ' . $result . ';';

            $html .= ' htmlxxyy = \'<table width="100%" style="width:100%"  id="tblsearch">\';
            for(x=0;x<arrxxyy.length;x++){';

            $html .='    o= "                                                                                          ';
            $html .='        getElemento(\'' . $objectResult . '\').value=\'" + arrxxyy[x][0] + "\';                    ';
            $html .='        getElemento(\'' . $objectResultLayer . '\').style.display= \'none\';                       ';
            $html .='        getElemento(\'' . $objectResult . 'Criterio\').value=\'" + arrxxyy[x][1].replace("\'","|") + "\';            ';
            $html .='        getElemento(\'' . $objectResultLayer . '\').innerHTML =\'\';                               ';
            $html .='        if(getElemento(\'' . $objectResultId . '\')){                                              ';
            $html .='            var __idp = getElemento(\'' . $objectResultId . '__\').value;                          ';
            $html .='            var arr__=\'" + arrxxyy[x][0] + "\'.split(\'' . $charSep . '\');                       ';
            $html .='            var xitem=\'\';                                                                        ';
            $html .='            if(arr__.length) {                                                                     ';
            $html .='                xid= arr__[__idp]                                                                  ';
            $html .='            } else {                                                                               ';
            $html .='                xid=\'" + arrxxyy[x][0] + "\'                                                      ';
            $html .='           }                                                                                       ';
            $html .='            getElemento(\'' . $objectResultId . '\').value=xid                                     ';
            $html .='        };                                                                                         ';
            $html .='        setTimeout(function(){                                                                     ';
            $html .='           replaceAutocom(\'' . $objectResult . 'Criterio\');                           ';
            $html .='        },200);";                                                                                  ';
            $html .='    a = \'<a href="#" >\' + arrxxyy[x][1] + \'</a>\';
                htmlxxyy +=\'<tr  > <td onclick="\' + o + \';"  >\' + a + \'</td></tr>\';
            }
            htmlxxyy +=\'</table>\';
            getElemento("' . $objectResultLayer . '").innerHTML = htmlxxyy;
            getElemento("' . $objectResultLayer . '").style.display= \'block\';';
        } else {
            $html = 'getElemento("' . $objectResultLayer . '").innerHTML = \'No se encontraron registros.\';getElemento("' . $objectResultLayer . '").style.display= \'block\';getElemento(\'' . $objectResult . '\').value=\'\';if(document.getElementById(\'' . $objectResultId . '\')){getElemento(\'' . $objectResultId . '\').value=\'\';}';
        }
    }

    return $html;
}

function searchBold($textobusqueda, $criterio) {
    $arraycriterio = explode(' ', $criterio);
    foreach ($arraycriterio as $key => $valor) {
        $arraycriterio[$key] = strtoupper($valor);
        $arraycriterio2[$key] = '<b>' . $valor . '</b>';
    }
    return strtoupper(str_replace($arraycriterio, $arraycriterio2, $textobusqueda));
}

function getToken($len = 32, $md5 = true) {
    mt_srand((double) microtime() * 1000000);
    $chars = array(
        'Q', '@', '8', 'y', '%', '^', '5', 'Z', '(', 'G', '_', 'O', '`',
        'S', '-', 'N', '<', 'D', '{', '}', '[', ']', 'h', ';', 'W', '.',
        '/', '|', ':', '1', 'E', 'L', '4', '&', '6', '7', '#', '9', 'a',
        'A', 'b', 'B', '~', 'C', 'd', '>', 'e', '2', 'f', 'P', 'g', ')',
        '?', 'H', 'i', 'X', 'U', 'J', 'k', 'r', 'l', '3', 't', 'M', 'n',
        '=', 'o', '+', 'p', 'F', 'q', '!', 'K', 'R', 's', 'c', 'm', 'T',
        'v', 'j', 'u', 'V', 'w', ',', 'x', 'I', '$', 'Y', 'z', '*'
    );
    $numChars = count($chars) - 1;
    $token = '';

    for ($i = 0; $i < $len; $i++)
        $token .= $chars[mt_rand(0, $numChars)];

    if ($md5) {
        $chunks = ceil(strlen($token) / 32);
        $md5token = '';
        for ($i = 1; $i <= $chunks; $i++)
            $md5token .= md5(substr($token, $i * 32 - 32, 32));
        $token = substr($md5token, 0, $len);
    }

    return $token;
}

function showEror($msg) {
    return '<div class="alert alert-error fade in center"><button class="close" type="button" data-dismiss="alert">x</button>' . $msg . '</div>';
}

function IsDateOk($dmy) {
    $d = getDateParam($dmy, 'd');
    $m = getDateParam($dmy, 'm');
    $y = getDateParam($dmy, 'a');

    return (checkdate((int) $m, (int) $d, (int) $y) ? true : false);
}

function trimTagHtml($str) {
    return strip_tags($str);
}

function replaceLn($html) {
    return preg_replace('#<br\s*/?>#i', "\n", $html);
}

function getIP() {
    $ip = null;
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER ['HTTP_VIA']))
        $ip = $_SERVER['HTTP_VIA'];
    else if (isset($_SERVER ['REMOTE_ADDR']))
        $ip = $_SERVER['REMOTE_ADDR'];
    return $ip;
}

function getBrowser() {
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version = "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif (preg_match('/Firefox/i', $u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif (preg_match('/Chrome/i', $u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif (preg_match('/Safari/i', $u_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif (preg_match('/Opera/i', $u_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    } elseif (preg_match('/Netscape/i', $u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
            $version = $matches['version'][0];
        } else {
            $version = $matches['version'][1];
        }
    } else {
        $version = $matches['version'][0];
    }

    // check if we have a number
    if ($version == null || $version == "") {
        $version = "?";
    }

    return array(
        'userAgent' => $u_agent,
        'name' => $bname,
        'version' => $version,
        'platform' => $platform,
        'pattern' => $pattern
    );
}

function validatePassword($xpwd) {
    $data = array("1", "");

    $noPass = array
        (
        "123456", "654321", "111111", "222222", "333333",
        "444444", "555555", "666666", "777777", "888888",
        "999999", "000000", "121212", "131313", "141414",
        "151515", "161616", "171717", "181818", "191919");

    if (in_array($xpwd, $noPass)) {
        $data = array("2", "La contraseña no es segura. Por favor ingrese otra contraseña.");
    } elseif (strlen($xpwd) < 6 || strlen($xpwd) > 20) {
        $data = array("3", "La contraseña debe tener una longitud entre 6 y 20 caracteres. Por favor corrija.");
    }
//  elseif (!preg_match('/([a-z]+[0-9]+)|([0-9]+[a-z]+)/i', $xpwd)) {
//        $data = array("4", "Para mayor seguridad, la contrase�a debe contener letras y numeros.");
//    }
    return $data;
}

function ayerDMY() {
    $dia = time() - (1 * 24 * 60 * 60); //Te resta un dia (2*24*60*60) te resta dos y //asi...

    $dia_ayer = date('d-m-Y', $dia); //Formatea dia
    return $dia_ayer;
}

function encodeAlumno($codigo) {
    // la clave debe ser numero o letras y tener una longitud de mas de
    // 4 caracteres, se construye de la sgte manera:
    //
    // del codigo, se seleccionan los sgtes caracteres:
    //    el ultimo + cuarto + primero + tercero + segundo caracter
    //
    // para cada uno de estos caracteres se obtiene el codigo ascii
    // Por ejemplo: D02602408L, los caracteres serian: L6D20 y convertido a ascii seria: 654685048
    //
    // Vea  http://www.asciitable.com/
    $strKey = "";
    try {
        $strKey = ord(substr(ord(substr($codigo, strlen($codigo) - 1, 1)), 0, 1)) .
                substr(ord(substr($codigo, strlen($codigo) - 1, 1)), 1, 1) .
                ord(substr($codigo, 3, 1)) . ord(substr($codigo, 0, 1)) .
                ord(substr($codigo, 2, 1)) . ord(substr($codigo, 1, 1));
    } catch (Exception $e) {
        
    }
    return $strKey;
}

function encode($param) {
    return base64_encode($param);
}

function decode($param) {
    return base64_decode($param);
}

function encrypt($string, $key = GL_KEY_ENCRYPT) {
    $hash = '';
    if (isset($string) && $string != '') {
        $key = sha1($key);
        $strLen = strlen($string);
        $keyLen = strlen($key);
        $j = 0;

        for ($i = 0; $i < $strLen; $i++) {
            $ordStr = ord(substr($string, $i, 1));
            if ($j == $keyLen) {
                $j = 0;
            }
            $ordKey = ord(substr($key, $j, 1));
            $j++;
            $hash .= strrev(base_convert(dechex($ordStr + $ordKey), 16, 36));
        }
    }
    return $hash;
}

function decrypt($string, $key = GL_KEY_ENCRYPT) {
    $hash = '';
    if (isset($string) && $string != '') {
        $key = sha1($key);
        $strLen = strlen($string);
        $keyLen = strlen($key);
        $j = 0;

        for ($i = 0; $i < $strLen; $i+=2) {
            $ordStr = hexdec(base_convert(strrev(substr($string, $i, 2)), 36, 16));
            if ($j == $keyLen) {
                $j = 0;
            }
            $ordKey = ord(substr($key, $j, 1));
            $j++;
            $hash .= chr($ordStr - $ordKey);
        }
    }
    return $hash;
}

/**
 * 
 * @param type $sData : La cadena
 * @param type $sKey  : La palabra secreta
 * @return type
 * 
 * Usar:  encrypt($variable, 'napal')
 * 
 */
//function encrypt($sData, $sKey = 'mysecretkey') {
//    $sResult = '';
//    for ($i = 0; $i < strlen($sData); $i++) {
//        $sChar = substr($sData, $i, 1);
//        $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
//        $sChar = chr(ord($sChar) + ord($sKeyChar));
//        $sResult .= $sChar;
//    }
//    return encode_base64($sResult);
//}

/**
 * 
 * @param type $sData : La cadena encriptada
 * @param type $sKey  : La palabra secreta
 * @return type
 * 
 * Usar:  decrypt($variable, 'napal')
 * 
 */
//
//function decrypt($sData, $sKey = 'mysecretkey') {
//    $sResult = '';
//    $sData = decode_base64($sData);
//    for ($i = 0; $i < strlen($sData); $i++) {
//        $sChar = substr($sData, $i, 1);
//        $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
//        $sChar = chr(ord($sChar) - ord($sKeyChar));
//        $sResult .= $sChar;
//    }
//    return $sResult;
//}

function encode_base64($sData) {
    $sBase64 = base64_encode($sData);
    return strtr($sBase64, '+/', '-_');
}

function decode_base64($sData) {
    $sBase64 = strtr($sData, '-_', '+/');
    return base64_decode($sBase64);
}

function SizeArchivo($bytes) {
    $tamanio = array(
        0 => "kB",
        1 => "MB",
        2 => "GB",
        3 => "TB",
        4 => "PB",
        5 => "EB");
    $i = -1;
    do {
        $bytes = $bytes / 1024;
        $i++;
    } while ($bytes > 99);
    return round($bytes, 1) . $tamanio[$i];
}

function Mayus($variablec) {
    $variable = strtr(strtoupper($variablec), "àèìòùáéíóúçñäëïöü", "ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ");
    return $variable;
}
function getRealIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];

    return $_SERVER['REMOTE_ADDR'];
}
?>