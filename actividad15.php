<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        //checa el estado de la pagina
        if(!isset($_FILES["pintura"]))
        {
            echo "<h1>Tu galeria de arte no tiene ninguna imagen</h1>";
        }
        else
        {
            //recibe todos los valores
            $pintura = $_FILES["pintura"];
            $nombre = $_POST["nombreObra"];
            if($_POST["autor"] != "")
                $autor = $_POST["autor"];
            else
                $autor = "SIN AUTOR";
            if($_POST["fecha"] != "")
                $fecha = $_POST["fecha"];
            else
                $fecha = "SIN AÑO";
            $nombrearch=explode(".",$_FILES["pintura"]["name"]);
            $ruta = "./statics/".$nombre."$".$autor."$&".$fecha."&.".$nombrearch[1];
            //cambia el nombre
            rename($_FILES["pintura"]["tmp_name"], $ruta);
            echo "<h1>Galeria de arte</h1>";
            $rutaCarpeta = "./statics";
            $carpeta = opendir($rutaCarpeta);
            $imagenes = [];
            $fin = true;
            //corre mientras haya elementos en la carpeta
            while($fin)
            {
                $archivo = readdir($carpeta);
                //corre mientras haya archivos
                if($archivo !== false)
                {
                    $ext = pathinfo($archivo, PATHINFO_EXTENSION);
                    //se salta los . ..
                    if($archivo != "." && $archivo != "..")
                    {
                        //checa extensiones jpg png jpeg
                        if($ext == "jpg" || $ext == "png" || $ext == "jpeg")
                        {
                            array_push($imagenes, $archivo);
                        }
                    }
                }
                else
                {
                    $fin = false;
                }
            }
            $i=0;
            echo "<table border = 1>";
                echo "<tbody>";
                    //por cada imagen despliega una casilla
                    foreach($imagenes as $value)
                    {
                        //checa cuando debe de cerrar o abrir una linea de de la tabla
                        if($i%2==0)
                        {
                            echo "<tr>";
                        }
                        echo "<td><img src='./statics/$value'>";
                            $nombre=explode("$",$value);
                            $año=explode("&", $nombre[2]);
                            //lista con los datos
                            echo "<ul>";
                                echo "<li>$nombre[0]</li>";
                                echo "<li>$nombre[1]</li>";
                                echo "<li>$año[1]</li>";
                            echo "</ul>";
                        echo "</td>";
                        if($i%2==1)
                        {
                            echo "</tr>";
                        }
                        $i++;
                    }
                echo "</tbody>";
            echo "</table>";
        }
        echo "<form method='POST' action='./actividad15.html'>";
            echo "<button type='submit'>Subir Obra</button>";
        echo "</form>";
    ?>
</body>
</html>