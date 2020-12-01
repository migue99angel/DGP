<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";

  $variablesParaTwig = [];

  echo $twig->render('asignarEjercicio.html', $variablesParaTwig);

  ?>
