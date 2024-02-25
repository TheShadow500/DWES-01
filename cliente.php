<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DWES - Tarea Online - CLIENTE</title>
    <link rel="stylesheet" href="style.css">
    <?php
        // Creamos un array y lo rellenamos con la informacion del archivo CSV que utilizaremos mas adelante
        $lista = [];
        $archivocsv = 'datos.csv';
        $archivo = fopen($archivocsv, 'r');

        if(!file_exists('datos.csv')){
            echo '<script>alert("No hay inmuebles para mostrar");</script>';
        }

        if($archivo !== false){
            while(($fila = fgetcsv($archivo)) !== FALSE){
                $lista[] = $fila;
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
            <div class="seccion-titulo">CLIENTE</div>
            <!-- FIN TÍTULO SECCIÓN -->
            <!-- SUBTITULO SECCIÓN -->
            <div class="seccion-subtitulo">INMUEBLES DISPONIBLES</div>
            <!-- FIN SUBTITULO SECCIÓN -->
            <!-- LISTA DE INMUEBLES -->
            <?php foreach($lista as $fila){ ?>
            <div class="listado">
                <div class="listado-linea">
                    <div class="listado-texto-titulo">
                        Localidad:
                    </div>
                    <div class="listado-texto">
                        <?= $fila[0]; ?>
                    </div>
                </div>
                <div class="listado-linea">
                    <div class="listado-texto-titulo">
                        Provincia:
                    </div>
                    <div class="listado-texto">
                        <?= $fila[1]; ?>
                    </div>
                </div>
                <div class="listado-linea">
                    <div class="listado-texto-titulo">
                        Dirección:
                    </div>
                    <div class="listado-texto">
                        <?= $fila[2]; ?>
                    </div>
                </div>
                <div class="listado-linea">
                    <div class="listado-texto-titulo">
                        Tipo Inmueble:
                    </div>
                    <div class="listado-texto">
                        <?= $fila[3]; ?>
                    </div>
                </div>
                <div class="listado-linea">
                    <div class="listado-texto-titulo">
                        Tamaño m<sup>2</sup>:
                    </div>
                    <div class="listado-texto">
                        <?= $fila[4]; ?>m<sup>2</sup>
                    </div>
                </div>
                <div class="listado-linea">
                    <div class="listado-texto-titulo">
                        Dormitorios:
                    </div>
                    <div class="listado-texto">
                        <?= $fila[5]; ?>
                    </div>
                </div>
                <div class="listado-linea">
                    <div class="listado-texto-titulo">
                        Baños:
                    </div>
                    <div class="listado-texto">
                        <?= $fila[6]; ?>
                    </div>
                </div>
                <div class="listado-linea">
                    <div class="listado-texto-titulo">
                        Precio:
                    </div>
                    <div class="listado-texto">
                        <?= $fila[7]; ?>€
                    </div>
                </div>
                <div class="listado-imagen">
                    <img src=<?= $fila[8]; ?>>
                </div>
            </div>
            <?php } ?>
            <!-- FIN LISTA DE INMUEBLES -->
        </div>
        <button onclick="location.href='index.html'" type="submit" class="botones">VOLVER</button>
        <div class="footer">©2023 Inmobiliaria Amores. Daniel Amores Corzo<br>DWES - Desarrollo en Entorno Servidor</div>
    </div>
</body>
</html>