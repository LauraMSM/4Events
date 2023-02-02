<?php
/**
 * @file userprofile.php
 * Archivo que maneja la eliminación y la autenticación de usuarios.
 * 
 */
    require "../db/getDb.php";
    /**
     * Conexión a la base de datos.
     * @var PDO $conection
     */
    $conection = getDB();
    
    /**
     * Verifica si se ha enviado una solicitud de eliminación de evento.
     * En caso afirmativo, se eliminan los datos del evento y sus participantes.
     */
    if ( isset($_POST['remove']) ) {
        $sql = "DELETE FROM participants
                WHERE IDEvent = :id;
                
                DELETE FROM events
                WHERE ID = :id;";

        $stmt = $conection->prepare($sql);
        $stmt->bindValue(":idEvents", intval($_POST['remove']), PDO::PARAM_INT);
        $stmt->bindValue(":id", intval($_POST['remove']), PDO::PARAM_INT);
        $stmt->execute();
        $resp = $stmt->fetch(PDO::FETCH_ASSOC);
    };
    
    /**
     * Verifica si se ha enviado una solicitud de inicio de sesión.
     * En caso afirmativo, verifica la autenticidad del usuario y establece la cookie correspondiente.
     */
    if ( isset($_POST['submit']) ) {
        $sql = "SELECT * FROM users
                WHERE userName = :userName;";

        $stmt = $conection->prepare($sql);
        $stmt->bindValue(":userName", $_POST['userName'], PDO::PARAM_STR);
        $stmt->execute();
        $resp = $stmt->fetch(PDO::FETCH_ASSOC);

        if ( $resp['password'] === $_POST['password'] ) {
            setcookie('userData', serialize($resp));
        };
    };

    /**
     * Verifica si el usuario ha iniciado sesión y muestra la página correspondiente.
     */
    if ( isset($_COOKIE['userData']) ) {
        require "components/head.php";
        require "components/menu.php";
        
        /**
         * Sección de perfil del usuario autenticado.
         */
?>
    <section class="section section--profile">
        <h2>Hola, <span><?= unserialize($_COOKIE['userData'])['userName']?></span>!</h2>
        <h3><?= unserialize($_COOKIE['userData'])['name'] . " " . unserialize($_COOKIE['userData'])['surname']?></h3>
        <p><i class="fa-solid fa-phone"></i> <?= unserialize($_COOKIE['userData'])['phone']?></p>
        <p><i class="fa-solid fa-envelope"></i>  <?= unserialize($_COOKIE['userData'])['email']?></p>

        <a href="editprofile"><i class="fa-solid fa-user-pen"></i></a>

        <a href="addevent">Crear un evento nuevo <i class="fa-solid fa-plus"></i></a>

        <?php
        /**
        * Consulta los eventos relacionados al usuario autenticado.
        */
        $sel = "SELECT events.* FROM events
                INNER JOIN participants
                ON participants.IDEvent = events.ID
                WHERE participants.IDUser = :id";
        $stmt = $conection->prepare($sel);
        $stmt->bindValue(":id", unserialize($_COOKIE['userData'])['ID'], PDO::PARAM_INT);
        $stmt->execute();
        $resp = $stmt->fetchAll(PDO::FETCH_ASSOC);

        /**
         * Despliega los eventos relacionados al usuario autenticado.
         */
        echo '<div class="events">';
        foreach ( $resp as $k ) {
            echo <<<HTML
                <div class="event">
                    <h3>{$k['name']}</h3>
                    <p>{$k['eventDate']}</p>
                    <p>{$k['description']}</p>
                    <form action="../public/profile" method="post" class="remove">
                        <button type="submit" name="remove" value="{$k['ID']}">X</button>
                    </form>
                </div>
            HTML;
            echo '</div>';
        };  
        ?>
    </section>

<?php
    /**
     * Verifica si existe una cookie de usuario autenticado, en caso contrario redirige al usuario a la página de inicio de sesión.
     */
    } else {
        Header('Location: login');
        exit();
    };
    /**
     * Incluye el archivo encargado de desplegar el pie de página.
     */
    require_once "components/footer.php";
?>