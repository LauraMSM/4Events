<?php
/**
 * @file login.php
 * Inicio de sesión de los usuarios y añade usuarios a la tabla users si viene de signup
 */

    /**
     * Si existe un $_POST, se conecta a la base de datos
     * Se crea un array con los valores del formulario
     * Se hace la consulta
     * Se bindean los valores
     * Se ejecuta la consulta
     */
    if ( isset( $_POST['submit'] ) ) {
        require_once "../db/getDb.php";

        $conection = getDB();
        $user = [
            $_POST['userName'],
            $_POST['password'],
            $_POST['name'],
            $_POST['surname'],
            $_POST['email'],
            $_POST['phone'],
        ];
        $sql = "INSERT INTO users ( userName, password, name, surname, email, phone ) VALUES ( :userName, :password, :name, :surname, :email, :phone );";
    
        $stmt = $conection->prepare($sql);
        $stmt->bindValue(":userName", $user[0], PDO::PARAM_STR);
        $stmt->bindValue(":password", $user[1], PDO::PARAM_STR);
        $stmt->bindValue(":name", $user[2], PDO::PARAM_STR);
        $stmt->bindValue(":surname", $user[3], PDO::PARAM_STR);
        $stmt->bindValue(":email", $user[4], PDO::PARAM_STR);
        $stmt->bindValue(":phone", $user[5], PDO::PARAM_STR);
        $stmt->execute();
    };

    /**
     * Si existe la cookie se redirige al perfil
     */
    if ( isset( $_COOKIE['userData'] ) ) {
        Header( "Location: profile" );
        exit();
    };

    /**
     * Si no, se importan los components head y menu
     */
    require_once "components/head.php";
    require_once "components/menu.php";
?>

    <section class="section section--eventos">
        <h2 class="section__h2">INICIAR SESIÓN</h2>

        <form action="profile" method="post">
            <input type="text" name="userName" placeholder="NOMBRE DE USUARIO">
            <input type="text" name="password" placeholder="CONTRASEÑA">
            <button type="submit" name="submit">ACEPTAR</button>
        </form>

        <a class="signin-link" href="../public/signup">Aún no tengo cuenta</a>
    </section>

<?php
    /**
     * Se trae el componente footer
     */
    require_once "components/footer.php";
?>