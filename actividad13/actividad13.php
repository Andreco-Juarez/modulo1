<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Batalla naval</h1>
    <?php
        /*Hecho por:Vazquez Castillo Mariela Eunice
        Y Juarez Salgado Eduardo Andreco*/

        $casillasAcertadas = [];

        //Transforma los valores X=n Y=n en un valor XY con fomato letra(numero)
        function concatenarXY($barco)
        {
            $posiProcess[0]=chr($barco[0]+64).$barco[1];
            $posiProcess[1]=chr($barco[2]+64).$barco[3];
            return $posiProcess;
        }

        //checa si alguna casilla coincide entre lso intervalos de dos coordenadas de la froma A B
        function checkCasillas($posicionA, $posicionB, $valor)
        {
            //variable global para guardar en ese arreglo las casillas con un barco
            global $casillasAcertadas;
            $parametro1 = ord(substr($posicionA,0,1))-64;
            $parametro2 = ord(substr($posicionB,0,1))-64;
            $numEjeX = ord(substr($valor,0,1))-64;
            $parametro1Y = substr($posicionA,1);
            $parametro2Y = substr($posicionB,1);
            $numEjeY = substr($valor,1);
            $mediador = $parametro1;
            //parametro1 tiene que ser siempre mas grande que parametro2 en ambos casos del eje
            if($parametro2<$parametro1)
            {
                $parametro1 = $parametro2;
                $parametro2 = $mediador;
            }
            $mediador2 = $parametro1Y;
            if($parametro2Y<$parametro1Y)
            {
                $parametro1Y = $parametro2Y;
                $parametro2Y = $mediador2;
            }
            //estructura que recorre los intervalos y compara los valores
            for($i=$parametro1; $i<=$parametro2; $i++)
            {
                if($numEjeX == $i)
                {
                    for($k=$parametro1Y; $k<=$parametro2Y; $k++)
                    {
                        if($numEjeY == $k)
                        {
                            array_push($casillasAcertadas, $valor);
                        }
                    }
                }
            }
        }
        //recibe todos los valores de los formularios
        $contErrores = 0;
        $turnos = $_POST["turnos"];
        $numBarcos = $_POST["numBarcos"];
        $spawnBarco = $_POST["spawnBarco"];
            
        //recupera todas las casillas jugadas
        for($i=0; $i<$turnos; $i++)
        {
            $casillas[$i] = $_POST["casilla".$i];
        }
        if($numBarcos >= 1)
        {
            for($i=0; $i<5; $i++)
            {
                $barco1[$i] = $_POST["barco1".$i];
            }
        }
        if($numBarcos >= 2)
        {
            for($i=0; $i<5; $i++)
            {
                $barco2[$i] = $_POST["barco2".$i];
            }
        }
        if($numBarcos >= 3)
        {
            for($i=0; $i<5; $i++)
            {
                $barco3[$i] = $_POST["barco3".$i];
            }
        }
        $dificultad = $_POST["dificultad"];
        $casillas[$turnos] = strtoupper($_POST["posicionX"]).$_POST["posicionY"];
        $turnos++;

        //compara los valores del arreglo que lleva las casillas jugadas
        foreach($casillas as $value)
        {
            if($numBarcos == 1)
            {
                $barco1process=concatenarXY($barco1);
                checkCasillas($barco1process[0],$barco1process[1],$value);
            }
            if($numBarcos == 2)
            {
                $barco1process=concatenarXY($barco1);
                checkCasillas($barco1process[0],$barco1process[1],$value);
                $barco2process=concatenarXY($barco2);
                checkCasillas($barco2process[0],$barco2process[1],$value);
            }
            if($numBarcos == 3)
            {
                $barco1process=concatenarXY($barco1);
                checkCasillas($barco1process[0],$barco1process[1],$value);
                $barco2process=concatenarXY($barco2);
                checkCasillas($barco2process[0],$barco2process[1],$value);
                $barco3process=concatenarXY($barco3);
                checkCasillas($barco3process[0],$barco3process[1],$value);
            }
        }

        //establece paramateros segun el nivel de dificultad
        if($dificultad == "F")
        {
            $vida = 10;
            $longitud = 8;
            $numBarcos = 1;
            $casShip = 3;
        }
        if($dificultad == "N")
        {
            $vida = 8;
            $longitud = 10;
            $numBarcos = 2;
            $casShip = 7;
        }
        if($dificultad == "D")
        {
            $vida = 9;
            $longitud = 13;
            $numBarcos = 3;
            $casShip = 10;
        }

        //genera los barcos
        if($spawnBarco == 0)
        {
            //hace diferente numero de barcos dependiendo la dificultad
            for($i=0; $i<$numBarcos; $i++)
            {
                //genero un valor X e Y que van a ser el primer extremo de los barcos
                $posicionA_ejeX=rand(1, $longitud);
                $posicionA_ejeY=rand(1, $longitud);
                $eje = 0;
                //genero una dirreccion del siguiente extremo e itero hasta que de un valor valido
                while($eje == 0)
                {
                    $eje = rand(1,4);
                    if(($posicionA_ejeY == 1 || $posicionA_ejeY == 2) && ($eje == 1))
                    {
                        $eje = 0;
                    }
                    if(($posicionA_ejeX == 1 || $posicionA_ejeX == 2) && ($eje == 4))
                    {
                        $eje = 0;
                    }
                    if(($posicionA_ejeY == $longitud || $posicionA_ejeY == $longitud-1) && ($eje == 2))
                    {
                        $eje = 0;
                    }
                    if(($posicionA_ejeX == $longitud || $posicionA_ejeX == $longitud-1) && ($eje == 3))
                    {
                        $eje = 0;
                    }
                }
                //le doy valores al segundo extremo dependiendo el eje
                if($eje == 1)
                {
                    $posicionB_ejeX = $posicionA_ejeX;
                    $posicionB_ejeY = $posicionA_ejeY - 2;
                }
                if($eje == 2)
                {
                    $posicionB_ejeX = $posicionA_ejeX + 2;
                    $posicionB_ejeY = $posicionA_ejeY;
                }
                if($eje == 3)
                {
                    $posicionB_ejeX = $posicionA_ejeX;
                    $posicionB_ejeY = $posicionA_ejeY + 2;
                }
                if($eje == 4)
                {
                    $posicionB_ejeX = $posicionA_ejeX -2;
                    $posicionB_ejeY = $posicionA_ejeY;
                }
                //almaceno sus valores en un arreglo
                if($i == 0)
                {
                    $barco1= [$posicionA_ejeX,
                                $posicionA_ejeY,
                                $posicionB_ejeX,
                                $posicionB_ejeY,
                                $eje]; 
                }
                //si hay mas de un barco entra aqui
                if($i == 1)
                {
                    //depende de la dificultad al barco2 le doy tamaño de 4 o de 3
                    if($dificultad == "N")
                    {
                        if($eje == 1)
                        {
                            $posicionB_ejeY -= 1;
                        }
                        if($eje == 2)
                        {
                            $posicionB_ejeX += 1;
                        }
                        if($eje == 3)
                        {
                            $posicionB_ejeY += 1;
                        }
                        if($eje == 4)
                        {
                            $posicionB_ejeX -= 1;
                        }
                        $barco2= [$posicionA_ejeX,
                                $posicionA_ejeY,
                                $posicionB_ejeX,
                                $posicionB_ejeY,
                                $eje];
                    }
                    else
                    {
                        $barco2= [$posicionA_ejeX,
                                $posicionA_ejeY,
                                $posicionB_ejeX,
                                $posicionB_ejeY,
                                $eje];
                    }
                }
                //entra si hay un tercer barco
                if($i == 2)
                {
                    if($eje == 1)
                    {
                        $posicionB_ejeY -= 1;
                    }
                    if($eje == 2)
                    {
                        $posicionB_ejeX += 1;
                    }
                    if($eje == 3)
                    {
                        $posicionB_ejeY += 1;
                    }
                    if($eje == 4)
                    {
                        $posicionB_ejeX -= 1;
                    }
                    $barco3= [$posicionA_ejeX,
                                $posicionA_ejeY,
                                $posicionB_ejeX,
                                $posicionB_ejeY,
                                $eje]; 
                }
            }
        }
        //las fallas con las casillas jugadas - casillas Acertadas
        $contadorFallas = count($casillas)-count($casillasAcertadas)-1;
        //declaro el estado de la pagina si gana, pierde o sigue jugando
        if($casShip == count($casillasAcertadas))
        {
            echo "<h1>Ganaste</h1>";
        }
        elseif($vida == $contadorFallas)
        {
            echo "<h1>Perdiste :(</h1>";
        }
        else
        {
            //Crea las imagenes de vida
            echo "<h2>Vidas:";
            for($i=0; $i<$vida-$contadorFallas; $i++)
            {
                echo "<img src='./imagenes_actividad13/corazones.png' width='30' height='20'>";
            }
            echo "</h2>";
            echo "<br>";

            //Lleva la cuenta y despliega las casillas jugadas
            echo "Historial de disparos:";
            echo "<br>";
            foreach($casillas as $valor)
            {
                if($valor != "00")
                {
                    echo $valor;
                    echo " ";
                }
            }
            //tablero
            echo "<table border='1'>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th></th>";
                        //depligas las letras en el encabezado
                        for($i=0; $i<$longitud; $i++)
                        {
                            printf("<th>%c</th>", 65+$i);
                        }
                    echo "</tr>";
                echo "</thead>";
                //lleva el control de las lineas
                for($i=0; $i<$longitud; $i++)
                {
                    echo "<tr>";
                        printf("<td>%d</td>", $i+1);
                        //despliega las imagenes en la tabla
                        for($k=0; $k<$longitud; $k++)
                        {
                            //pone las casillas del turno 1
                            if($turnos == 1)
                            {
                                echo "<td><img src='./imagenes_actividad13/agua.jpg' width='30' height='30'></td>";
                            }
                            //cambia las casillas si acerto
                            foreach($casillasAcertadas as $value)
                            {
                                if($value == chr($k+65).($i+1))
                                {
                                    echo "<td><img src='./imagenes_actividad13/fuego.jpeg' width='30' height='30'></td>";
                                    $k++;
                                }
                            }
                            //despliega casillas normales
                            if($turnos != 1)
                            {
                                echo "<td><img src='./imagenes_actividad13/agua.jpg' width='30' height='30'></td>";
                            }
                        }
                    echo "</tr>";
                }
            echo "</table>";
            echo "<br>";

            //formulario de envio de casilla
            echo "<form method='POST' action='./actividad13.php' target='_SELF'>";
                echo"<label>Posición X(letra):";
                    echo "<input type='text' name='posicionX'></input>";
                echo "</label>";
                echo"<label>Posición Y(numero):";
                    echo "<input type='number' name='posicionY' max='$longitud'></input>";
                echo "</label>";
                echo "<input type='hidden' name='dificultad' value='$dificultad'></input>";
                echo "<input type='hidden' name='turnos' value='$turnos'></input>";
                echo "<input type='hidden' name='numBarcos' value='$numBarcos'></input>";
                echo "<input type='hidden' name='spawnBarco' value='1'></input>";
                //manda todas las casillas jugadas
                for($i=0; $i<$turnos; $i++)
                {
                    echo "<input type='hidden' name='casilla$i' value='$casillas[$i]'></input>";
                }
                if($numBarcos >= 1)
                {
                    for($k=0;$k<5; $k++)
                    {
                        echo "<input type='hidden' name='barco1$k' value='$barco1[$k]'></input>";
                    }
                }
                if($numBarcos >= 2)
                {
                    for($k=0;$k<5; $k++)
                    {
                        echo "<input type='hidden' name='barco2$k' value='$barco2[$k]'></input>";
                    }
                }
                else
                {
                    echo "<input type='hidden' name='barco2' value=0></input>";
                }
                if($numBarcos >= 3)
                {
                    for($k=0;$k<5; $k++)
                    {
                        echo "<input type='hidden' name='barco3$k' value='$barco3[$k]'></input>";
                    }
                }
                else
                {
                    echo "<input type='hidden' name='barco3' value='0'></input>";
                }
                echo "<button type='submit'>Jugar</button>";
            echo "</form>";
        }
    ?>
</body>
</html>