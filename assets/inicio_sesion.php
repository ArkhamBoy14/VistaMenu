<?php
$db = new PDO('mysql:host=localhost;dbname=vistausuario', 'root', '');


session_start();
 
if (isset($_POST['submit'])) {
 
    $username = $_POST['usuario'];
    $password = ($_POST['contrasena']);
 
    $query = $db->prepare("SELECT * FROM usuarios WHERE Usuario_Correo=:usuario");
    $query->bindParam("usuario", $username, PDO::PARAM_STR);
    $query->execute();
 
    $result = $query->fetch(PDO::FETCH_ASSOC);
 
    if (!$result) {
        echo '<p class="error">Username password combination is wrong!</p>';
        header("Location: ../index.php");

    } else {
        if ($password == $result['Usuario_Contrasena']) {
            $_SESSION['user_id'] = $result['ID'];
            header("Location: ../menu_objetos.php");
;
        } else {
            // echo '<p class="error">Username password combination is wrong!</p>';
            header("Location: ../index.php");
        }
    }
}
 

?>