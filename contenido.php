<?php
        if(isset($_SERVER['PATH_INFO'])) {

            echo '
                <div id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: block;">
                  <div class="modal-dialog" style="width: 100%;top: -40px;">
                    <div class="modal-content">
                      <div class="modal-body" style="min-height:600px ">
            ';
          $array=explode('.', $_SERVER['PATH_INFO']);
         require (GL_DIR_FS_APP . 'zet/' . 'admi_cabecera.php');
            #echo '<br>';
			#echo $array[0];
          include_once(GL_DIR_FS_APP . 'zet' . $array[0].'.php');

            echo '
                      </div>
                    </div>
                  </div>
                </div
            ';
        }else{
          
        }?>