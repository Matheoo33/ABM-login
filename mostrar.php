<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "huertadb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// ==========================================
// ELIMINAR REGISTRO
// ==========================================
if (isset($_GET['eliminar'])) {

    $id_eliminar = $_GET['eliminar'];

    $sql_baja = "DELETE FROM login WHERE id = $id_eliminar";

    if ($conn->query($sql_baja)) {
        echo "<script>
                alert('Registro eliminado correctamente');
                window.location='mostrar.php';
              </script>";
    } else {
        echo "Error al eliminar: " . $conn->error;
    }
}

// ==========================================
// MODIFICAR REGISTRO
// ==========================================
if (isset($_POST['btn_modificar'])) {

    $id_update = $_POST['id'];
    $usuario_update = $_POST['usuario'];
    $password_update = $_POST['password'];

    $sql_update = "UPDATE login 
                   SET usuario='$usuario_update',
                       password='$password_update'
                   WHERE id=$id_update";

    if ($conn->query($sql_update)) {

        echo "<script>
                alert('Registro actualizado correctamente');
                window.location='mostrar.php';
              </script>";

    } else {
        echo "Error al actualizar: " . $conn->error;
    }
}

// ==========================================
// CARGAR DATOS PARA EDITAR
// ==========================================
$row_edit = null;

if (isset($_GET['editar'])) {

    $id_editar = $_GET['editar'];

    $sql_buscar = "SELECT * FROM login WHERE id = $id_editar";

    $res_buscar = $conn->query($sql_buscar);

    if ($res_buscar->num_rows > 0) {
        $row_edit = $res_buscar->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel Rosita 🌸</title>

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
            padding:40px;
            color:#444;
        }

        h2{
            text-align:center;
            margin-bottom:30px;
            color:#d63384;
            font-size:35px;
        }

        /* ==========================
           FORMULARIO
        ========================== */

        .form-edit{
            background:white;
            max-width:450px;
            margin:0 auto 30px auto;
            padding:30px;
            border-radius:20px;
            box-shadow:0 10px 25px rgba(0,0,0,0.1);
            border:3px solid #ffb3d1;
        }

        .form-edit h3{
            text-align:center;
            color:#d63384;
            margin-bottom:20px;
        }

        label{
            display:block;
            margin-bottom:8px;
            font-weight:bold;
            color:#c2185b;
        }

        input[type="text"]{
            width:100%;
            padding:12px;
            border:2px solid #ffc2d9;
            border-radius:12px;
            margin-bottom:18px;
            outline:none;
            transition:0.3s;
        }

        input[type="text"]:focus{
            border-color:#ff69b4;
            box-shadow:0 0 8px rgba(255,105,180,0.4);
        }

        input[type="submit"]{
            width:100%;
            padding:12px;
            background:#ff69b4;
            color:white;
            border:none;
            border-radius:12px;
            font-size:16px;
            cursor:pointer;
            transition:0.3s;
        }

        input[type="submit"]:hover{
            background:#ff4fa3;
        }

        .cancelar{
            display:block;
            text-align:center;
            margin-top:15px;
            color:#d63384;
            text-decoration:none;
            font-weight:bold;
        }

        /* ==========================
           TABLA
        ========================== */

        table{
            width:100%;
            border-collapse:collapse;
            background:white;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 10px 25px rgba(0,0,0,0.1);
        }

        th{
            background:#ff69b4;
            color:white;
            padding:15px;
            font-size:17px;
        }

        td{
            padding:15px;
            text-align:center;
            border-bottom:1px solid #ffd6e7;
        }

        tr:hover{
            background:#fff0f6;
            transition:0.3s;
        }

        /* ==========================
           BOTONES
        ========================== */

        .btn{
            padding:10px 15px;
            border-radius:12px;
            text-decoration:none;
            color:white;
            font-size:14px;
            transition:0.3s;
            margin:3px;
            display:inline-block;
        }

        .btn-edit{
            background:#ff85c1;
        }

        .btn-edit:hover{
            background:#ff5ca8;
        }

        .btn-delete{
            background:#ff4d6d;
        }

        .btn-delete:hover{
            background:#e63956;
        }

        .volver{
            display:inline-block;
            margin-top:25px;
            background:#ff85c1;
            color:white;
            padding:12px 20px;
            border-radius:12px;
            text-decoration:none;
            transition:0.3s;
        }

        .volver:hover{
            background:#ff5ca8;
        }

    </style>
</head>

<body>

    <!-- FORMULARIO EDITAR -->
    <?php if ($row_edit): ?>

        <div class="form-edit">

            <h3>
                Modificar Registro ID:
                <?php echo $row_edit['id']; ?>
            </h3>

            <form action="" method="POST">

                <input
                    type="hidden"
                    name="id"
                    value="<?php echo $row_edit['id']; ?>"
                >

                <label>Usuario</label>

                <input
                    type="text"
                    name="usuario"
                    value="<?php echo $row_edit['usuario']; ?>"
                    required
                >

                <label>password</label>

                <input
                    type="text"
                    name="password"
                    value="<?php echo $row_edit['contraseña']; ?>"
                    required
                >

                <input
                    type="submit"
                    name="btn_modificar"
                    value="Guardar Cambios 💖"
                >

                <a class="cancelar" href="mostrar.php">
                    Cancelar
                </a>

            </form>

        </div>

    <?php endif; ?>

    <h2>🌸 Usuarios Registrados 🌸</h2>

    <table>

        <thead>

            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>password</th>
                <th>Acciones</th>
            </tr>

        </thead>

        <tbody>

            <?php

            $sql = "SELECT id, usuario, password FROM login";

            $resultado = $conn->query($sql);

            if ($resultado->num_rows > 0) {

                while($fila = $resultado->fetch_assoc()) {

                    echo "<tr>";

                    echo "<td>" . $fila['id'] . "</td>";

                    echo "<td>" . $fila['usuario'] . "</td>";

                    echo "<td>" . $fila['password'] . "</td>";

                    echo "<td>

                        <a class='btn btn-edit'
                           href='?editar=" . $fila['id'] . "'>
                           ✏️ Modificar
                        </a>

                        <a class='btn btn-delete'
                           href='?eliminar=" . $fila['id'] . "'
                           onclick='return confirm(\"¿Seguro que deseas eliminar este registro?\")'>
                           🗑️ Eliminar
                        </a>

                    </td>";

                    echo "</tr>";
                }

            } else {

                echo "
                <tr>
                    <td colspan='4'>
                        No hay registros 💔
                    </td>
                </tr>";
            }

            $conn->close();

            ?>

        </tbody>

    </table>

  <button class="volver" onclick="history.back()">
    ← Volver Atrás
</button>

</body>

</html>