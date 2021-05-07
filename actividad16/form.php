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
        //si no tiene sesion te permite llenar el formulario
        if(!isset($_SESSION["nombre"]))
        {
            echo '<form method="POST" action="./index.php">';
                echo '<fieldset>';
                    echo '<legend>Inicio de sesion</legend>';
                    echo '<label>Nombre:';
                        echo '<input type="text" name="nombre" required>';
                    echo'</label>';
                    echo '<br><br>';
                    echo '<label>Apellidos:';
                        echo'<input type="text" name="apellidos" required>';
                    echo '</label>';
                    echo '<br><br>';
                    echo '<label>Grupo:';
                        echo '<input type="number" name="grupo" required>';
                    echo '</label>';
                    echo '<br><br>';
                    echo '<label>Fecha de nacimiento:';
                        echo '<input type="date" name="fecha" required>';
                    echo '</label>';
                    echo '<br><br>';
                    echo '<label>Correo electronico:';
                        echo '<input type="email" name="correo" required>';
                    echo '</label>';
                    echo '<br><br>';
                    echo '<label>Contraseña:';
                        echo '<input type="password" name="password" required>';
                    echo '</label>';
                    echo '<br><br>';
                    echo'<button type="submit">Enviar</button>';
                echo '</fieldset>';
                echo '</legend>';
            echo '</form>';
        }
        //si ya estas en sesion te regresa a index
        else
        {
            header("location: ./index.php");
        }
    ?>
</body>
</html>