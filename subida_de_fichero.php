
<?php

function tamanioTotal (){
    $tamanioFichero=0;
    for ($i=0; $i < count($_FILES['archivos']['name']); $i++) 
    { 
       
        $tamanioFichero  +=   $_FILES['archivos']['size'][$i];      
    }

    return $tamanioFichero;
}
$codigosErrorSubida= [ 
    UPLOAD_ERR_OK         => 'Subida correcta',  // Valor 0
    UPLOAD_ERR_INI_SIZE   => 'El tamaño del archivo excede el admitido por el servidor',  // directiva upload_max_filesize en php.ini
    UPLOAD_ERR_FORM_SIZE  => 'El tamaño del archivo excede el admitido por el cliente',  // directiva MAX_FILE_SIZE en el formulario HTML
    UPLOAD_ERR_PARTIAL    => 'El archivo no se pudo subir completamente',
    UPLOAD_ERR_NO_FILE    => 'No se seleccionó ningún archivo para ser subido',
    UPLOAD_ERR_NO_TMP_DIR => 'No existe un directorio temporal donde subir el archivo',
    UPLOAD_ERR_CANT_WRITE => 'No se pudo guardar el archivo en disco',  // permisos
    UPLOAD_ERR_EXTENSION  => 'Una extensión PHP evito la subida del archivo',  // extensión PHP

]; 
$mensaje = '';

    if (count($_POST) == 0 ){
    $mensaje= "  Error: se supera el tamaño máximo de un petición POST ";

     }else if ((! isset($_FILES['archivos']['name']))) {
        $mensaje .= 'ERROR: No se indicó el archivo y/o no se indicó el directorio';
    } else 
        {
        
            
            $directorioSubida = "C:\Users\alfon\Desktop\imgusers"; 
            
           if (tamanioTotal()<=300000) {
           
                if ( is_dir($directorioSubida) && is_writable ($directorioSubida)) 
                { 
                    for ($i=0; $i < count($_FILES['archivos']['name']); $i++) 
                    { 
                        $nombreFichero   =   $_FILES['archivos']['name'][$i];
                        $tipoFichero     =   $_FILES['archivos']['type'][$i];
                        $tamanioFichero  =   $_FILES['archivos']['size'][$i];
                        $temporalFichero =   $_FILES['archivos']['tmp_name'][$i];
                        $errorFichero    =   $_FILES['archivos']['error'][$i];

                        if($tipoFichero == "image/png" or $tipoFichero == "image/jpeg"){
                            if($tamanioFichero<=200000){
                                if(!file_exists($directorioSubida.'/'.$nombreFichero)){
                                    if (move_uploaded_file($temporalFichero,  $directorioSubida .'/'. $nombreFichero) == true)
                                    {
                                        echo 'Archivo guardado correctamente: ' . $directorioSubida .'/'. $nombreFichero . ' <br/>';
                                    }else
                                    {
                                        echo  'Error al guardar el archivo '.' <br/>';
                                    }
                                }else
                                {
                                    echo "Error el fichero ya existe ".' <br/>';
                                }
                            }else
                            {
                                echo "Error el tamaño del archivo es demasio grande ".' <br/>';
                            }
                        }else
                        {
                            echo "Error el tipo de fichero no es válido o es demasiado grande ".' <br/>';
                        }          
                    
                        
                    }
                } 
                else 
                {
                        echo'ERROR: No es un directorio correcto o no se tiene permiso de escritura <br />';
                }
            }else{
                echo'ERROR el tipo de archivo es demasido grande <br />';
            }
        }
   
    
echo"<pre> <hr>";
var_dump($_FILES);
echo"</pre>";
?>