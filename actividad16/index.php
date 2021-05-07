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
        session_start();
        //si se entra sin sesion manda al fom
        if(!isset($_POST["nombre"]) && !isset($_SESSION["nombre"]))
        {
            header("location: ./form.php");
        }
        else
        {
            //si mandan los datos los almacena en variables de sesion
            if(!isset($_SESSION["nombre"]))
            {
                $nombre = $_POST["nombre"]." ".$_POST["apellidos"];
                $grupo = $_POST["grupo"];
                $fecha = $_POST["fecha"];
                $correo = $_POST["correo"];
                $_SESSION["nombre"]=$nombre;
                $_SESSION["grupo"]=$grupo;
                $_SESSION["fecha"]=$fecha;
                $_SESSION["correo"]=$correo;
                echo "<h1>Por favor recargar pagina</h1>";
            }
            //despliega la informacion de cuenta
            else
            {
                echo "<table border='1'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th colspan='2'>Información de inicio de sesión</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                        echo "<tr>";
                            echo "<td>Nombre Completo:</td>";
                            echo "<td>$_SESSION[nombre]</td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td>Grupo:</td>";
                            echo "<td>$_SESSION[grupo]</td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td>Fecha de nacimiento:</td>";
                            echo "<td>$_SESSION[fecha]</td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td>Correo electronico:</td>";
                            echo "<td>$_SESSION[correo]</td>";
                        echo "</tr>";
                    echo "</tbody>";
                echo "</table>";
                echo "<form method='POST' action='./cerrar.php'>";
                    echo "<input type='hidden' name='cerrar' value='1'>";
                    echo "<button type='submit'>Cerrar sesión</button>";
                echo "</fom>";
            }
        }
    ?>
</body>
</html>