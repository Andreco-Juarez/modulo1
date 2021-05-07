<?php
    //si entra aqui desde la direccion lo dirije a fom
    if(!isset($_POST["cerrar"]))
    {
        header("location: ./form.php");
    }
    //si no cierra la sesion
    elseif($_POST["cerrar"] == "1")
    {
        session_start();
        session_unset();
        session_destroy();
        echo "<h1>SESION CERRADA</h1>";
    }

?>