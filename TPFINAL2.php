<?php
     include_once("WORDIXFINAL.php");    
   
/**
 * Este modulo almacena la coleccion de palabras para jugar al WORDIX
 * @return array
 */
function cargarColeccionPalabras(){
    // ARRAY $coleccionPalabras
    $coleccionPalabras = [
    "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
    "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
    "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
    "BRAZO", "PERRO","CINCO", "JARRA","TAPON"
    ];
    return $coleccionPalabras;
}

/**
 * Este modulo almacena una coleccion de partidas de WORDIX
 * @return array
 */
function cargarPartidas(){
    // ARRAY $coleccionPartidas
    $coleccionPartidas[0] = ["palabraWordix"=> "QUESO" , "jugador" => "rodrigo", "intentos"=> 4, "puntaje" => 12];
    $coleccionPartidas[1] = ["palabraWordix"=> "MUJER" , "jugador" => "martin", "intentos"=> 3, "puntaje" => 13];
    $coleccionPartidas[2] = ["palabraWordix"=> "VERDE" , "jugador" => "brisa", "intentos"=> 1, "puntaje" => 16];
    $coleccionPartidas[3] = ["palabraWordix"=> "BRAZO" , "jugador" => "juan", "intentos"=> 1, "puntaje" => 16];
    $coleccionPartidas[4] = ["palabraWordix"=> "QUESO" , "jugador" => "lucas", "intentos"=> 2, "puntaje" => 14];
    $coleccionPartidas[5] = ["palabraWordix"=> "GOTAS" , "jugador" => "rodrigo", "intentos"=> 3, "puntaje" => 14];
    $coleccionPartidas[6] = ["palabraWordix"=> "MELON" , "jugador" => "rodrigo", "intentos"=> 4, "puntaje" => 12];
    $coleccionPartidas[7] = ["palabraWordix"=> "JARRA" , "jugador" => "martin", "intentos"=> 4, "puntaje" => 13];
    $coleccionPartidas[8] = ["palabraWordix"=> "CASAS" , "jugador" => "juan", "intentos"=> 5, "puntaje" => 12];
    $coleccionPartidas[9] = ["palabraWordix"=> "RASGO" , "jugador" => "brisa", "intentos"=> 2, "puntaje" => 15];
    $coleccionPartidas[10] = ["palabraWordix"=> "NAVES" , "jugador" => "carlos", "intentos"=> 0, "puntaje" => 0];
    return $coleccionPartidas;
}

/**
 * Este modulo muestra el menu de opciones
 * @return int
 */
function seleccionarOpcion(){
    // INT $opcion
    echo "\n";
    echo "***************\n";
    echo "1. Jugar al WORDIX con una palabra elegida. \n";
    echo "2. Jugar al WORDIX con una palabra aleatoria.\n";
    echo "3. Mostrar una partida. \n";
    echo "4. Mostrar la primera partida guardada. \n";
    echo "5. Mostrar resumen de jugador.\n";
    echo "6. Mostrar listado de partidas ordenadas por jugador y por palabra. \n";
    echo "7. Agregar una palabra de 5 letras a WORDIX. \n";
    echo "***************\n";
    echo "8. Salir.\n";
    $opcion=trim(fgets(STDIN));
    while ($opcion<=0 || $opcion>=9){
        echo "Por favor, ingrese un numero dentro del rango del menu (1-8): ";
        $opcion= trim(fgets(STDIN));
    }
    return $opcion;
}

/**
 * Este modulo le pide al usuario que ingrese una palabra de 5 letra
 * @return string
 */
function ingresarPalabra(){
    // STRING $palabra
    echo "Ingrese una palabra de 5 letras: ";
    $palabra=trim(fgets(STDIN));
    return $palabra;
}


/** 
 * Este modulo analiza si la palabra seleccionada ya fue utilizada por el usuario ingresado
 * @param array $palabra
 * @param string $nombre
 * @param array $partida
 * @return bool
 */
function analizarPalabraUsuario($palabra, $nombre, $partida){
    // INT $i
    // BOOL $logic
    $i = 0;
    $logic = false;
    while ($logic==false && $i < count($partida)){
        if ($partida[$i]["jugador"] == $nombre){
            if ($partida[$i]["palabraWordix"] == $palabra){
                $logic = true; // Se encontró la palabra
                }
            }
            $i++;
        }     
    return $logic;
}

/**
 * Modulo que dado un número de partida, muestre en pantalla los datos de la partida
 * @param array $partida
 */
function mostrarPartida($partida,$numPartida){
    // ARRAY $cargarPartida
    // INT $numPartida

        echo "**********************************\n";
        echo "Partida de WORDIX N°".$numPartida.": \n";
        echo "Palabra: ".($partida[($numPartida)-1]["palabraWordix"])."\n";
        echo "Jugador: ".($partida[($numPartida)-1]["jugador"])."\n";
        echo "Puntaje: ".($partida[($numPartida)-1]["puntaje"])."\n";
        echo "Intento: ".($partida[($numPartida)-1]["intentos"])."\n";      
}

/**
 * Modulo que encuentra la primer partida ganada por el jugador
 * @param array $partidas
 * @param string $nombre
 * @return int
 */
function primerPartidaGanadora($partidas,$nombre){
    // INT $i
    // BOOL $logic
    $i = 0;
    $valor = false;
    $indice=-1;
    while ($i < (count($partidas)) && $valor==false){
        if ($partidas[$i]["jugador"] == $nombre && $partidas[$i]["puntaje"] > 0){
            $valor = true;
            $indice=$i;
        }
        
        $i++;
        
    }
    return $indice;
}

/**
 * Este modulo muestra la primer partida ganada en WORDIX
 * @param int $primerPartida
 * @param array $partidas
 * @param string $nombre
 */
function mostrarPrimerPartida($primerPartida,$partidas,$nombre){
if ($primerPartida != -1) {
    echo "****************\n";
    echo "Partida WORDIX N°" . ($primerPartida+1) . ":\n";
    echo "Palabra: " . $partidas[$primerPartida]["palabraWordix"] . "\n";
    echo "Jugador: " . $partidas[$primerPartida]["jugador"] . "\n";
    echo "Puntaje: " . $partidas[$primerPartida]["puntaje"] . "\n";
    echo "Intento: " . $partidas[$primerPartida]["intentos"] . "\n";
    echo "****************\n";
    } else {
    echo "El jugador/a ".$nombre." no gano ninguna partida. \n";
    }
}


/**
 * Modulo que muestra el resumen de las partidas de los jugadores
 * @param array $partidas
 * @param string $nombre
 * @return array
 */
function resumenJugador($partidas,$nombre){
    // ARRAY $resum
    // INT $i
   $resum=[
        "contador"=>0,
        "puntaje"=>0,
        "victorias"=>0,
        "porcentaje"=>0,
        "intento1"=>0,
        "intento2"=>0,
        "intento3"=>0,
        "intento4"=>0,
        "intento5"=>0,
        "intento6"=>0,
    ];
    for ($i=0; $i<count($partidas); $i++){

        if ($partidas[$i]["jugador"]==$nombre){

            $resum["contador"]=$resum["contador"]+1;
            $resum["puntaje"]=$resum["puntaje"]+$partidas[$i]["puntaje"];

            if ($partidas[$i]["puntaje"]>0){
                $resum["victorias"]=$resum["victorias"]+1;
                if ($partidas[$i]["intentos"]==1){
                    $resum["intento1"]=$resum["intento1"]+1;
                }
                if ($partidas[$i]["intentos"]==2){
                        $resum["intento2"]=$resum["intento2"]+1;
                }
                if ($partidas[$i]["intentos"]==3){
                        $resum["intento3"]=$resum["intento3"]+1;
                }
                if ($partidas[$i]["intentos"]==4){
                        $resum["intento4"]=$resum["intento4"]+1;
                }
                if ($partidas[$i]["intentos"]==5){
                    $resum["intento5"]=$resum["intento5"]+1;
                }
                if ($partidas[$i]["intentos"]==6){
                    $resum["intento6"]=$resum["intento6"]+1;
                }
            }
        }
    }
    
    if ($resum["contador"]>0){
        $resum["porcentaje"]=(($resum["victorias"]*100)/$resum["contador"]);
    }
    else{
        $resum["porcentaje"]==0;
    }
    return $resum;         
} 
    
  


/**
 * Modulo que muestra el resumen de la partida
 * @param string $nombre
 * @param array $resumenJug
 */
function mostrarResumen($nombre,$resumenJug){
    // INT $i
    echo "************************\n";
    echo "Jugador: ".$nombre."\n";
    echo "Partidas: ".$resumenJug["contador"]."\n";
    echo "Puntaje Total: ".$resumenJug["puntaje"]."\n";
    echo "Victorias: ".$resumenJug["victorias"]."\n";
    echo "Porcentaje Victorias: ".$resumenJug["porcentaje"]."\n";
    echo "Adivinados: \n";
    for ($i=0;($i<6);$i++){
        echo "          Intento ".($i+1).": ".$resumenJug["intento".$i+1]."\n";
    }
    echo "************************\n";
    ;
}

/**
 * Modulo que solicita el nombre del usuario
 * @return string
 */
function solicitarJugador(){
    // string $nombreDeUsuario
    echo "Ingrese su nombre: ";
    $nombreDeUsuario = trim(fgets(STDIN));
    $nombreDeUsuario= strtolower($nombreDeUsuario);
    while (ctype_alpha(substr($nombreDeUsuario, 0, 1))==false){
        echo "El nombre de usuario debe comenzar con una letra. Inténtelo de nuevo: \n";
        $nombreDeUsuario=trim(fgets(STDIN));
    }
    $nombreDeUsuario= strtolower($nombreDeUsuario);
    return $nombreDeUsuario;
}

/**
 * Modulo que solicita un numero para seleccionar la palabra dentro del arreglo
 * @param int $min
 * @param int $max
 * @return int
 */
function solicitarNumero($min,$max){
    // INT $numeroDePalabra
             echo "Ingrese numero de palabra (un numero entre el ".$min." y el ".($max)."):";
             $numeroDePalabra = trim(fgets(STDIN));
             while (($numeroDePalabra<$min) || ($numeroDePalabra>($max))){
                echo "Ingrese por favor un numero entre el ".$min." y el ".($max).": ";
                $numeroDePalabra= trim(fgets(STDIN));
             }
             return $numeroDePalabra;
}

/**
 * Modulo que retorna un numero aleatorio dentro de un rango de valores
 * @param array $cargarPalabra
 * @param string $nombre
 * @param array $partidas
 * @return int
 */
function numeroAleatorio($cargarPalabras,$nombre,$partidas){
    // int $min, $max, $numeroDePalabra
        $min =1;
        $max=count($cargarPalabras);
        do {
            $numeroDePalabra = random_int($min, $max);
        } while ((analizarPalabraUsuario($cargarPalabras[$numeroDePalabra], $nombre, $partidas))==true);
        return $numeroDePalabra;
}

/**
 * Modulo que ordena los nombres de la coleccion de partidas en orden alfabetico
 * @param array $a
 * @param array $b
 * @return int
 */
function ordenarPorJugador($a, $b){
    // INT $valor
    $valor=0;
    if ($a["jugador"]>$b["jugador"]){
        $valor= 1;
    }
    if ($a["jugador"]<$b["jugador"]){
        $valor= -1;
    }
    else{
        return $valor;
    }
}

/**
 * Modulo que ordena las palabras de la coleccion de partidas en orden alfabetico
 * @param array $a
 * @param array $b
 * @return int
 */
function ordenarPorPalabra($a, $b){
    // INT $valor
    //$valor=0;
    if ($a["jugador"]==$b["jugador"]){
        if ($a["palabraWordix"]>$b["palabraWordix"]){
            $valor= 1;
        }
        else {
            $valor= -1;
        }
    } elseif ($a["jugador"]<$b["jugador"]){
        $valor=-1;
    }
    else {
        $valor=1;
    }


    return $valor;
}

//ALGORITMO PRINCIPAL () RETORNA 0
// INT $indice, $opcionA, $numeroPalabra, $primerPartida, $cantPalabras
// ARRAY $cargarPartidas, $cargarColeccionPalabras, $resumen, $ordenPartidas
// STRING $nombreDeUsuario, $palabraElegida, $palabraAgregada

$indice=(count(cargarPartidas()))-1;
$cargarPartidas=cargarPartidas();
$cargarColeccionPalabras = cargarColeccionPalabras();
do{ 
   $opcionA=seleccionarOpcion();
   
    switch ($opcionA) {
        case 1: 
            // JUGAR PREGUNTADO NOMBRE Y EL NUMERO SERA ELEGIDA POR EL USUARIO
            $indice=$indice+1;
            $nombreDeUsuario = solicitarJugador();
            echo "Hola ".$nombreDeUsuario."\n";
            $numeroPalabra=solicitarNumero(1,count($cargarColeccionPalabras));
            // Verificar si el jugador ya jugó la palabra asociada al número.
            while ((analizarPalabraUsuario($cargarColeccionPalabras[$numeroPalabra], $nombreDeUsuario, $cargarPartidas))==true) {
                echo "Esta palabra ya fue utilizada por ti. Por favor, elige otro número de palabra: ";
                $numeroPalabra = trim(fgets(STDIN));
            }
            $palabraElegida = $cargarColeccionPalabras[($numeroPalabra)-1];
            $cargarPartidas[$indice] = jugarWordix($palabraElegida, $nombreDeUsuario);
            echo "**************************\n";
            break;   
        case 2: 
            //JUGAR PREGUNTANDO NOMBRE Y EL NUMERO SERA DE FORMA ALEATORIA 
            $indice=$indice+1;
            $nombreDeUsuario=solicitarJugador();
            $numeroPalabra= numeroAleatorio($cargarColeccionPalabras,$nombreDeUsuario,$cargarPartidas);
            $palabraElegida=$cargarColeccionPalabras[($numeroPalabra)-1];
            $cargarPartidas[$indice]=jugarWordix($palabraElegida , $nombreDeUsuario);
            break;
        case 3: 
            // MUESTRA UNA PARTIDA JUGADA 
            $numeroDePartida= solicitarNumero(1,count($cargarPartidas));
            mostrarPartida($cargarPartidas, $numeroDePartida);
            break;
        case 4:
            // MUESTRA LA PRIMER PARTIDA GANADA DE UN JUGADOR
            $nombreDeUsuario = solicitarJugador();
            $primerPartida = primerPartidaGanadora($cargarPartidas,$nombreDeUsuario);
            mostrarPrimerPartida(($primerPartida),$cargarPartidas,$nombreDeUsuario);
          break;
        case 5: 
            // MUESTRA LAS ESTADISTICAS DE UN JUGADOR
            $nombreDeUsuario= solicitarJugador();
            $resumen=resumenJugador($cargarPartidas,$nombreDeUsuario);
            mostrarResumen($nombreDeUsuario,$resumen);
            break;
        case 6:
            // MUESTRA LAS PARTIDAS JUGADAS ORDENADAS POR NOMBRE Y JUGADOR
            uasort($cargarPartidas, 'ordenarPorJugador');
            uasort($cargarPartidas, 'ordenarPorPalabra');
            print_r($cargarPartidas);
            break;
        case 7:
            // LE PERMITE AGREGAR UNA PALABRA DE 5 LETRAS AL JUGADOR
            $cantPalabras= count($cargarColeccionPalabras);
            $palabraAgregada=leerPalabra5Letras();
            $cargarColeccionPalabras[$cantPalabras]=$palabraAgregada;
        }
    } while ($opcionA<8);
?>