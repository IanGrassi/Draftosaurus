<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../RECURSOS/CSS/style_REGISTRO.css">
    <title>Login</title>  
    <style>
        body {
            background-image: url('../RECURSOS/IMAGENES/fondoInicio.png');
            background-size: cover;
            background-repeat: no-repeat; 
            background-attachment: fixed; 
            background-position: center;
        }
    </style>
</head>  

<body>


    <form class="Registro" id="loginForm" method="POST">
        <h1>Login</h1>
        <input class="controls" type="text" name="nombre" id="nombre" placeholder="Nombre" autocomplete="off" required>
        <br>
        <input class="controls" type="password" name="password" id="password" placeholder="Contraseña" required>
        <br><br>
        <input class="botonsRegistro" type="submit" value="Login para jugar">
        <br><br>
        <input class="botonsInicio" type="button" value="Regresar al inicio" onclick="window.location.href='../index.php'">
    </form>
    
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('../BACK/procesar_login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
    
<?php if (!empty($error)): ?>
    <div style="color: red; font-weight: bold;">
        <?php echo $error; ?>
    </div>
<?php endif; ?>

</body>
</html>
