<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {$nombre = trim($_POST["nombre"]);

    if (!empty($nombre)) {
 
        header("Location: /FRONT/version.html");
        exit();
        
    } else {
        
        header("Location: ../FRONT/Registro.html"); 
        exit();
    }
} else {
    
    header("Location: ../FRONT/Registro.html");
    exit();
}

?>