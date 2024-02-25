<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DWES - Tarea Online - ADMIN</title>
    <link rel="stylesheet" href="style.css">
    <?php
        // Comprobamos si se ha enviado el formulario
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            // Comprobamos que se haya enviado un archivo (luego comprobaremos que sea una imagen)
            if(isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK){
                // Asignamos un nombre unico interno para el archivo
                $archivo_info = pathinfo($_FILES['foto']['name']);
                $nombre_archivo = uniqid('foto_') . '.' . $archivo_info['extension'];
                $target_dir = 'fotos/';
                $target_file = $target_dir . $nombre_archivo;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
                // Comprobamos que sea una imagen, que el archivo no exista, que cumpla el tamaño maximo y el tipo de archivo
                $uploadOk = 0;
                if(isset($_POST['submit'])){
                    $check = getimagesize($_FILES['foto']['tmp_name']);
                    if(!$check){
                        echo '<script>alert("El archivo no es una imagen");</script>';
                    }    
                    else if(file_exists($target_file)){
                        echo '<script>alert("El archivo ya existe");</script>';
                    }
                    else if($_FILES['foto']['size'] > 2000000){
                        echo '<script>alert("El archivo es demasiado grande (Max. 2Mb)");</script>';
                    }
                    else if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif'){
                        echo '<script>alert("Solo se aceptan archivos JPG, JPEG, PNG y GIF");</script>';
                    }
                    else{
                        $uploadOk = 1;
                    }

                    // En caso de que algo haya fallado lo mostramos por pantalla y en caso contrario almacenamos en el CSV la informacion
                    if($uploadOk == 0){
                        echo '<script>alert("El archivo no ha podido ser subido");</script>';
                    }
                    else{
                        // En el caso de haber podido mover bien la imagen, tomamos los datos y los pasamos a un array
                        if(move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)){
                            $datos[0] = $_POST['localidad'];
                            $datos[1] = $_POST['provincia'];
                            $datos[2] = $_POST['direccion'];
                            $datos[3] = $_POST['tipoinmueble'];
                            $datos[4] = $_POST['metros'];
                            $datos[5] = $_POST['dormitorios'];
                            $datos[6] = $_POST['wc'];
                            $datos[7] = $_POST['precio'];
                            $datos[8] = $target_file;

                            // Una vez pasados los datos al array, creamos (en caso de no existir) o abrimos el archivo CSV e insertamos la línea procedente del array
                            $archivocsv = 'datos.csv';
                            $archivo = fopen($archivocsv, 'a+');
                            fputcsv($archivo, $datos);
                            fclose($archivo);

                            // Informamos al usuario que se ha almacenado con éxito y redirigimos a la página de inicio para evitar reenvios de formularios con F5
                            echo '<script>alert("Almacenado con éxito");</script>';
                            echo '<script>window.location.href = "index.html";</script>';
                            exit();
                        }
                        else{
                            echo '<script>alert("Ha habido un error subiendo el archivo");</script>';
                        }
                    }
                }
            }
            else{
                echo '<script>';
                echo 'alert("No se ha seleccionado ninguna imagen");';
                echo '</script>';
            }
        }
    ?>
</head>
<body>
    <div class="container">
        <!-- LOGOTIPO -->
        <div class="logotipo"><img src="./logo.png"></div>
        <!-- FIN LOGOTIPO -->
        <!-- MAIN -->
        <div class="main">
            <!-- TÍTULO SECCIÓN -->
            <div class="seccion-titulo">ADMINISTRADOR</div>
            <!-- FIN TÍTULO SECCIÓN -->
            <!-- SUBTITULO SECCIÓN -->
            <div class="seccion-subtitulo">DATOS DEL INMUEBLE</div>
            <!-- FIN SUBTITULO SECCIÓN -->
            <!-- FORMULARIO DE PETICION AL USUARIO -->
            <div class="formulario">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                    <div class="formulario-linea">
                        <div class="campo">
                            <label for="localidad">Localidad</label>
                        </div>
                        <div class="campo-texto">
                            <input type="text" id="localidad" name="localidad">
                        </div>
                    </div>
                    <div class="formulario-linea">
                        <div class="campo">
                            <label for="provincia">Provincia</label>
                        </div>
                        <div class="campo-texto">
                            <select name="provincia" id="provincia">
                                <option value="A Coruña">A Coruña</option>
                                <option value="Álava">Álava</option>
                                <option value="Albacete">Albacete</option>
                                <option value="Alicante">Alicante</option>
                                <option value="Almería">Almería</option>
                                <option value="Asturias">Asturias</option>
                                <option value="Ávila">Ávila</option>
                                <option value="Badajoz">Badajoz</option>
                                <option value="Baleares">Baleares</option>
                                <option value="Barcelona">Barcelona</option>
                                <option value="Bizkaia">Bizkaia</option>
                                <option value="Burgos">Burgos</option>
                                <option value="Cáceres">Cáceres</option>
                                <option value="Cádiz">Cádiz</option>
                                <option value="Cantabria">Cantabria</option>
                                <option value="Castellón">Castellón</option>
                                <option value="Ciudad Real">Ciudad Real</option>
                                <option value="Córdoba">Córdoba</option>
                                <option value="Cuenca">Cuenca</option>
                                <option value="Gipuzkoa">Gipuzkoa</option>
                                <option value="Girona">Girona</option>
                                <option value="Granada">Granada</option>
                                <option value="Guadalajara">Guadalajara</option>
                                <option value="Huelva">Huelva</option>
                                <option value="Huesca">Huesca</option>
                                <option value="Jaén">Jaén</option>
                                <option value="La Rioja">La Rioja</option>
                                <option value="Las Palmas">Las Palmas</option>
                                <option value="León">León</option>
                                <option value="Lleida">Lleida</option>
                                <option value="Lugo">Lugo</option>
                                <option value="Madrid">Madrid</option>
                                <option value="Málaga">Málaga</option>
                                <option value="Murcia">Murcia</option>
                                <option value="Navarra">Navarra</option>
                                <option value="Ourense">Ourense</option>
                                <option value="Palencia">Palencia</option>
                                <option value="Pontevedra">Pontevedra</option>
                                <option value="Salamanca">Salamanca</option>
                                <option value="Santa Cruz de Tenerife">Santa Cruz de Tenerife</option>
                                <option value="Segovia">Segovia</option>
                                <option value="Sevilla">Sevilla</option>
                                <option value="Soria">Soria</option>
                                <option value="Tarragona">Tarragona</option>
                                <option value="Teruel">Teruel</option>
                                <option value="Toledo">Toledo</option>
                                <option value="Valencia">Valencia</option>
                                <option value="Valladolid">Valladolid</option>
                                <option value="Zamora">Zamora</option>
                                <option value="Zaragoza">Zaragoza</option>
                            </select>
                        </div>
                    </div>
                    <div class="formulario-linea">
                        <div class="campo">
                            <label for="direccion">Dirección</label>
                        </div>
                        <div class="campo-texto">
                            <input type="text" id="direccion" name="direccion">
                        </div>
                    </div>
                    <div class="formulario-linea">
                        <div class="campo">
                            <label for="tipoinmueble">Tipo Inmueble</label>
                        </div>
                        <div class="campo-texto">
                            <select name="tipoinmueble" id="tipoinmueble">
                                <option value="Adosado">Adosado</option>
                                <option value="Apartamento">Apartamento</option>
                                <option value="Ático">Ático</option>
                                <option value="Casa">Casa</option>
                                <option value="Dúplex">Dúplex</option>
                                <option value="Estudio">Estudio</option>
                                <option value="Piso">Piso</option>
                            </select>
                        </div>
                    </div>
                    <div class="formulario-linea">
                        <div class="campo">
                            <label for="metros">Tamaño m<sup>2</sup></label>
                        </div>
                        <div class="campo-texto">
                            <input type="number" id="metros" name="metros" inputmode="numeric" pattern="[0-9]+">
                        </div>
                    </div>
                    <div class="formulario-linea">
                        <div class="campo">
                            <Label for="dormitorios">Dormitorios</label>
                        </div>
                        <div class="campo-texto">
                            <input type="number" id="dormitorios" name="dormitorios" inputmode="numeric" pattern="[0-9]+">
                        </div>
                    </div>
                    <div class="formulario-linea">
                        <div class="campo">
                            <label for="wc">Baños</label>
                        </div>
                        <div class="campo-texto">
                            <input type="number" id="wc" name="wc" inputmode="numeric" pattern="[0-9]+">
                        </div>
                    </div>
                    <div class="formulario-linea">
                        <div class="campo">
                            <label for="precio">Precio</label>
                        </div>
                        <div class="campo-texto">
                            <input type="number" id="precio" name="precio" inputmode="numeric" pattern="[0-9]+">
                        </div>
                    </div>
                    <div class="formulario-linea">
                        <div class="campo">
                            <label>Imagen:</label>
                        </div>
                        <div class="campo-texto-file">
                            <label for="foto" class="custom-input-file">Examinar</label>
                            <input type="file" id="foto" name="foto">
                        </div>
                    </div>
                    <div class="formulario-linea">
                        <div class="campo-texto campoboton">
                            <input type="submit" value="ENVIAR" name="submit">
                        </div>
                    </div>
                </form>
            </div>
            <!-- FIN DE FORMULARIO -->
        </div>
        <button onclick="location.href='index.html'" type="submit" class="botones">VOLVER</button>
        <div class="footer">©2023 Inmobiliaria Amores. Daniel Amores Corzo<br>DWES - Desarrollo en Entorno Servidor</div>
    </div>
</body>
</html>