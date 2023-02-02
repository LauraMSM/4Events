<?php
/**
 * @file frontPage.php
 * Este archivo es para editar la información del usuario en la base de datos.
 * Primero se incluye la conexión a la base de datos con la función getDB().
 * Luego, si se ha recibido la variable 'edit' en el método POST, se actualiza la información del usuario en la base de datos.
 * Finalmente, se incluyen los componentes head, menu, header y footer en la página.
 */

    require "../db/getDb.php";
    $conection = getDB();

    if ( isset($_POST['edit']) ) {
    /**
     * Actualiza la información del usuario en la base de datos.
     */
        $sql = "UPDATE users
                SET userName = :userName, name = :name, surname = :surname, email = :email, phone = :phone;
                WHERE ID = :id";

        $stmt = $conection->prepare($sql);
        $stmt->bindValue(":id", unserialize($_COOKIE['userData'])['ID'], PDO::PARAM_INT);
        $stmt->bindValue(":userName",$_POST['userName'], PDO::PARAM_STR);
        $stmt->bindValue(":name", $_POST['name'], PDO::PARAM_STR);
        $stmt->bindValue(":surname", $_POST['surname'], PDO::PARAM_STR);
        $stmt->bindValue(":email", $_POST['email'], PDO::PARAM_STR);
        $stmt->bindValue(":phone", $_POST['phone'], PDO::PARAM_STR);
        $stmt->execute();

        /**
         * Obtiene la información actualizada del usuario desde la base de datos y la guarda en una cookie.
         */
        $sql = "SELECT * FROM users;";
        $stmt = $conection->prepare($sql);
        $stmt->execute();
        $resp = $stmt->fetch(PDO::FETCH_ASSOC);

        setcookie('userData', serialize($resp));
    };

    require_once "components/head.php";
    require_once "components/menu.php";
?>

    <header class="main-header">
        <nav class="main-header__nav">
            <a href="login" class="main-header__nav__a">LogIn</a>
            <a href="signup" class="main-header__nav__a main-header__nav__a--white">SignUp</a>
        </nav>
        <h1 class="main-header__h1">4 EVENTS</h1>
        <h2 class="main-header__h2">Hundreds of experiences</h2>
        <ul class="social">
            <li class="social__item"><i class="fa-brands fa-facebook"></i></li>
            <li class="social__item"><i class="fa-brands fa-twitter"></i></li>
            <li class="social__item"><i class="fa-brands fa-instagram"></i></li>
            <li class="social__item"><i class="fa-brands fa-tiktok"></i></li>
            <li class="social__item"><i class="fa-brands fa-twitch"></i></li>
        </ul>
    </header>

<?php
    require_once "components/footer.php";
?>