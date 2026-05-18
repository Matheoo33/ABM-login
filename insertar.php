<?php

if (isset($_POST['btn_alta'])) {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "huertadb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // DATOS DEL FORMULARIO
    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // INSERTAR DATOS
    $sql = "INSERT INTO login (id, usuario, contraseña)
            VALUES ('$id', '$usuario', '$contrasena')";

    if ($conn->query($sql)) {

        echo "
        <script>
            alert('💖 Usuario registrado correctamente');
            window.location='mostrar.php';
        </script>";

    } else {

        echo "Error al insertar: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Alta de Usuario 🌸</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', sans-serif;
        }

        body{
            background:linear-gradient(135deg,#ffd6e7,#ffeaf4);
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            flex-direction:column;
            padding:30px;
        }

        h2{
            color:#d63384;
            margin-bottom:25px;
            font-size:35px;
            text-align:center;
        }

        /* ==========================
           FORMULARIO
        ========================== */

        form{
            background:white;
            width:100%;
            max-width:420px;
            padding:35px;
            border-radius:25px;
            box-shadow:0 10px 25px rgba(0,0,0,0.1);
            border:3px solid #ffb3d1;
        }

        label{
            display:block;
            margin-bottom:8px;
            color:#c2185b;
            font-weight:bold;
            font-size:15px;
        }

        input{
            width:100%;
            padding:13px;
            margin-bottom:18px;
            border:2px solid #ffc2d9;
            border-radius:12px;
            outline:none;
            transition:0.3s;
            font-size:15px;
        }

        input:focus{
            border-color:#ff69b4;
            box-shadow:0 0 10px rgba(255,105,180,0.3);
        }

        /* ==========================
           BOTÓN
        ========================== */

        input[type="submit"]{
            background:#ff69b4;
            color:white;
            border:none;
            cursor:pointer;
            font-size:16px;
            font-weight:bold;
            transition:0.3s;
        }

        input[type="submit"]:hover{
            background:#ff4fa3;
            transform:scale(1.03);
        }

        /* ==========================
           VOLVER
        ========================== */

        .volver{
            margin-top:20px;
            text-decoration:none;
            background:#ff85c1;
            color:white;
            padding:12px 20px;
            border-radius:12px;
            transition:0.3s;
            font-weight:bold;
        }

        .volver:hover{
            background:#ff5ca8;
        }

    </style>

</head>

<body>

    <h2>🌸 Alta de Nuevo Usuario 🌸</h2>

    <form action="" method="POST">

        <label>ID</label>

        <input
            type="number"
            name="id"
            placeholder="Ingrese el ID"
            required
        >

        <label>Usuario</label>

        <input
            type="text"
            name="usuario"
            placeholder="Ingrese el usuario"
            required
        >

        <label>Contraseña</label>

        <input
            type="text"
            name="contrasena"
            placeholder="Ingrese la contraseña"
            required
        >

        <input
            type="submit"
            name="btn_alta"
            value="💖 Registrar Usuario"
        >

    </form>

   <button class="volver" onclick="history.back()">
    ← Volver Atrás
</button>
</body>

</html>