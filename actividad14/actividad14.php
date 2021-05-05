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
        //recibo la opcion que se uso
        $opcion = $_POST["opcion"];
        //decido cual desplegar
        if($opcion == "R")
        {
            //recibo toda la info de los checkbox
            $pais=$_POST["pais"];
            $hora = $_POST["hora"];
            $minHora=explode(":",$hora);
            $segundos = mktime($minHora[0],$minHora[1],0);
            //creo la tabla
            echo "<table border=1>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th colspan='2'>Reloj Munidal</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                    echo "<tr>";
                        echo "<td>Ciudad de Mexico</td>";
                        echo "<td>$hora</td>";
                    echo "</tr>";
                    //para cada checkbox despliego una linea de la tabla
                    foreach($pais as $value)
                    {
                        echo "<tr>";
                        //checo las opciones de la checkbox
                        if($value == "NY")
                        {
                            echo "<td>Nueva York</td>";
                            date_default_timezone_set("America/New_York");
                            $usoHorario = localtime($segundos,true);
                            echo "<td>".$usoHorario['tm_hour'].":".$usoHorario['tm_min']."</td>";
                        }
                        if($value == "M")
                        {
                            echo "<td>Madrid</td>";
                            date_default_timezone_set("Europe/Madrid");
                            $usoHorario = localtime($segundos,true);
                            echo "<td>".$usoHorario['tm_hour'].":".$usoHorario['tm_min']."</td>";
                        }
                        if($value == "R")
                        {
                            echo "<td>Roma</td>";
                            date_default_timezone_set("Europe/Rome");
                            $usoHorario = localtime($segundos,true);
                            echo "<td>".$usoHorario['tm_hour'].":".$usoHorario['tm_min']."</td>";
                        }
                        if($value == "B")
                        {
                            echo "<td>Bejin</td>";
                            date_default_timezone_set("Asia/Shanghai");
                            $usoHorario = localtime($segundos,true);
                            echo "<td>".$usoHorario['tm_hour'].":".$usoHorario['tm_min']."</td>";
                        }
                        if($value == "SP")
                        {
                            echo "<td>Sao Paulo</td>";
                            date_default_timezone_set("America/Sao_Paulo");
                            $usoHorario = localtime($segundos,true);
                            echo "<td>".$usoHorario['tm_hour'].":".$usoHorario['tm_min']."</td>";
                        }
                        if($value == "P")
                        {
                            echo "<td>Paris</td>";
                            date_default_timezone_set("Europe/Paris");
                            $usoHorario = localtime($segundos,true);
                            echo "<td>".$usoHorario['tm_hour'].":".$usoHorario['tm_min']."</td>";
                        }
                        if($value == "A")
                        {
                            echo "<td>Atenas</td>";
                            date_default_timezone_set("Europe/Athens");
                            $usoHorario = localtime($segundos,true);
                            echo "<td>".$usoHorario['tm_hour'].":".$usoHorario['tm_min']."</td>";
                        }
                        if($value == "T")
                        {
                            echo "<td>Tokio</td>";
                            date_default_timezone_set("Asia/Tokyo");
                            $usoHorario = localtime($segundos,true);
                            echo "<td>".$usoHorario['tm_hour'].":".$usoHorario['tm_min']."</td>";
                        }
                        echo "</tr>";
                    }
                echo "</tbody>";
            echo "</table>";
        }
        //entro en la opcion de cumpleaños
        elseif($opcion == "N")
        {
            //recibo todos los valores
            $fecha = $_POST["cumpleaños"];
            $formato = $_POST["formato"];
            $arrayFecha=explode("-",$fecha);
            //declaro las arreglos de informacion
            $segundosCumpleaños = mktime(0,0,0,$arrayFecha[1],$arrayFecha[2],$arrayFecha[0]);
            $segundosHoy = time();
            $datosFechaCumpleaños=getdate($segundosCumpleaños);
            $datosFechaActual=getdate();
            //creo una tabla
            echo "<table border=1>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>Cumpleaños:</th>";
                        echo "<th>$fecha</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                //para cada checkbox despliego una linea
                foreach($formato as $value)
                {
                    echo "<tr>";
                    //decido la accion de los checkbox
                    if($value == "Dias")
                    {
                        echo "<td>Dias</td>";
                        //compara si ya paso el cumpleaños o no
                        if($datosFechaActual["yday"]<$datosFechaCumpleaños["yday"])
                        {
                            $dayForBirth=$datosFechaCumpleaños["yday"]-$datosFechaActual["yday"];
                        }
                        else
                        {
                            $dayForBirth=$datosFechaCumpleaños["yday"]-$datosFechaActual["yday"];
                            $dayForBirth += 365;
                        }
                        echo "<td>$dayForBirth Dias</td>";
                    }
                    if($value == "Horas")
                    {
                        //lo mismo solo que multiplica los dias para dar horas
                        echo "<td>Horas</td>";
                        if($datosFechaActual["yday"]<$datosFechaCumpleaños["yday"])
                        {
                            $dayForBirth=$datosFechaCumpleaños["yday"]-$datosFechaActual["yday"];
                            $hrsForBirth=$dayForBirth*24;
                        }
                        else
                        {
                            $dayForBirth=$datosFechaCumpleaños["yday"]-$datosFechaActual["yday"];
                            $dayForBirth += 365;
                            $hrsForBirth=$dayForBirth*24;
                        }
                        echo "<td>$hrsForBirth hrs</td>";
                    }
                    if($value == "Minutos")
                    {
                        //lo mismo pero multiplica las horas para dar los minutos
                        echo "<td>Minutos</td>";
                        if($datosFechaActual["yday"]<$datosFechaCumpleaños["yday"])
                        {
                            $dayForBirth=$datosFechaCumpleaños["yday"]-$datosFechaActual["yday"];
                            $hrsForBirth=$dayForBirth*24;
                            $minForBirth=$hrsForBirth*60;
                        }
                        else
                        {
                            $dayForBirth=$datosFechaCumpleaños["yday"]-$datosFechaActual["yday"];
                            $dayForBirth += 365;
                            $hrsForBirth=$dayForBirth*24;
                            $minForBirth=$hrsForBirth*60;
                        }
                        echo "<td>$minForBirth mins</td>";
                    }
                    if($value == "weekend")
                    {
                        echo "<td>¿Es fin de semana?</td>";
                        //checa si el dia es sabado o domingo
                        if($datosFechaCumpleaños["weekday"] == "Saturday" || $datosFechaCumpleaños["weekday"] == "Sunday")
                        {
                            echo "<td>Si</td>";
                        }
                        else
                        {
                            echo "<td>No</td>";
                        }
                    }
                    echo "</tr>";
                }
                echo "</tbody>";
            echo "</table>";
        }
    ?>
</body>
</html>