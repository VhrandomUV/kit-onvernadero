<?php
    include('conect.php');
    $eventos_query = 'SELECT * FROM eventos ORDER by hora DESC LIMIT 8';
    $humedad_query = 'SELECT * FROM humedad';
    $luminosidad_query = 'SELECT * FROM luminosidad';
    $toldo_query = 'SELECT * FROM toldo';

    $n_eventos_query = 'SELECT COUNT(*) as total FROM eventos';
    $n_eventos = mysqli_query($conex, $n_eventos_query);
    
    
    $eventos= mysqli_query($conex, $eventos_query);
    $humedad = mysqli_query($conex, $humedad_query);
    $luminosidad = mysqli_query($conex, $luminosidad_query);
    $toldo = mysqli_query($conex, $toldo_query);
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/3271cbf67b.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script src="mysql.js"></script>
    <title>Kit Invernadero</title>
</head>

<body>

    <div class="head">

        <div class="logo">
            <a href="index.html">Invernadero Inteligente</a>
        </div>


        <div class="lbl-menu">
            <label for="radio4">Mediciones de Luminosidad</label>
            <label for="radio2">Eventos Destacados</label>
            <label for="radio3">Niveles de Humedad</label>
            <label for="radio1" style="padding-top: 8px; "><img src="imagenes/image.png" alt="Inicio"></label>
        </div>

    </div>


    <header class="content header">
        <h2 class="title"></h2>
    </header>

    <div class="content ">
        <input type="radio" name="radio" id="radio1" checked>
        <div class="tab1">

            <h2 style="color: white; font-size: 45px;">Invernadero Inteligente</h2>
            <p style="text-align: left;">Un invernadero inteligente es un sistema avanzado que utiliza tecnología para mejorar el crecimiento 
                y la salud de las plantas en un entorno controlado. Este tipo de invernadero está equipado con sensores que miden la humedad,
                el nivel de luz en el ambiente y eventos como detectar animales cerca, etc. Todo para optimizar las condiciones de cultivo.
                <br>
                Medidor de Luminosidad. <br>
                el sensor de nivel de luz mide la cantidad de luz disponible en el invernadero, lo que permite al 
                sistema controlar la iluminación artificial y ajustar la exposición de las plantas a la luz natural. 
                Esto es especialmente útil en regiones donde la luz del sol es limitada o donde las condiciones 
                climáticas cambian con frecuencia. Este nos mostrara la hora y la fecha exacta en la cual se abre y cierra el toldo.
                <br>
                Medidor de Humedad. <br>
                el sensor de humedad monitorea el nivel de humedad en el suelo y en el aire, lo que permite al sistema determinar cuándo 
                es necesario regar las plantas o ajustar la humedad del aire. Esto se hace mediante la activación de un sistema de riego 
                automatizado o un sistema de ventilación controlado. 
                <br>
                Sensor de Eventos. <br>
                El sensor de eventos es mas que nada un sensor de movimiento el cual nos podra detectar si pasan animales cerca los cuales
                podrian arruinar los cultivos o comerselos como zorros y otros animales. Este al activarse colocaria unas vallas para evitar
                el paso de animales y que puedan estropear los cultivos 
                </p>


            <p>Niveles de Humedad: <br>a la fecha se han realizado 5 mediciones <br>la medición de humedad más alta
                registrada es: 67% <br>la medición de humedad más baja registrada es: 49%<br>la medición de humedad
                promedio es: 52%
            </p>
        </div>

        <input type="radio" name="radio" id="radio2">
        <div class="tab2">
        <?php
        while ($row = mysqli_fetch_assoc($n_eventos)){?>
        
            <h2>Eventos Destacados</h2>
            <p>Se han detectado <?php echo $row['total'] ?> eventos de proximidad 
            <?php }?>

            <table width="100%;">

                <tr> 
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Distancia</th>
                </tr>
                
                <?php
                while ($row = mysqli_fetch_assoc($eventos)){?>

                <tr>
                    <td><?php echo $row['fecha'] ?></td>
                    <td><?php echo $row['hora'] ?></td>
                    <td><?php echo $row['medicion']?>cm</td>
                </tr>
                <?php }?>
                <!-- <tr>
                    <td>23/03/18</td>
                    <td>22:23:24</td>
                    <td>3.7 mts</td>
                </tr>
                <tr>
                    <td>23/03/19</td>
                    <td>12:54:53</td>
                    <td>0.2 mts</td>
                </tr>
                <tr>
                    <td>23/03/20</td>
                    <td>16:57:25</td>
                    <td>6.1 mts</td>
                </tr>
                <tr>
                    <td>23/03/21</td>
                    <td>17:25:53</td>
                    <td>5.9 mts</td>
                </tr> -->

            </table>

        </div>

        <input type="radio" name="radio" id="radio3">
        <div class="tab3">
            <h2>Niveles de Humedad</h2>
            <p id="elementos">
                <script>
                        
                        setInterval(update, 1000)
                </script>
            </p>
            <p>A la fecha se han realizado 5 mediciones <br>la medición de humedad más alta
                registrada es: 67% <br>la medición de humedad más baja registrada es: 49%<br>la medición de humedad
                promedio es: 52%
            </p>
        </div>

        <input type="radio" name="radio" id="radio4">
        <div class="tab4">
            <h2>Mediciones de Luminosidad</h2>
            <p id='hora'> <script>  setInterval(hora,1000)  </script></p>
            <table width="100%;">
                <tr>
                    <th>Fecha</th>
                    <th>Hora de Apertura Toldo</th>
                    <th>Estado del Toldo</th>
                </tr>
                <tr>
                    <td>23/03/17</td>
                    <td>07:19:12</td>
                    <td>20:45:00</td>
                </tr>
                <tr>
                    <td>23/03/18</td>
                    <td>05:09:24</td>
                    <td>19:57:03</td>
                </tr>
                <tr>
                    <td>23/03/19</td>
                    <td>05:04:53</td>
                    <td>19:34:56</td>
                </tr>
                <tr>
                    <td>23/03/20</td>
                    <td>06:23:25</td>
                    <td>18:32:32</td>
                </tr>
                <tr>
                    <td>23/03/21</td>
                    <td>06:12:53</td>
                    <td>20:12:22</td>
                </tr>
            </table>
        </div>

        </section>
</body>

</html>