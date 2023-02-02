<?php
/**
 * @file showallevents
 * Archivo que permite la creación de un evento y su registro en la base de datos y visualizar todos los eventos creados por cualquier usuario.
 */
    /**
     * Incluye el archivo de getDB para obtener una conexión a la base de datos.
     */
    require_once "../db/getDb.php";

    /**
     * Obtiene una conexión a la base de datos.
     */
    $conection = getDB();
    /**
     * Verifica si se ha enviado un formulario.
     */
    if ( isset($_POST['submit']) ) {
        /**
         * Crea una sentencia SQL para insertar un nuevo evento en la tabla de eventos.
         */
        $sql = "INSERT INTO events ( name, description, eventDate )
                VALUES ( :name, :description, :eventDate );";
        /**
        * Prepara la sentencia SQL.
        */
        $stmt = $conection->prepare($sql);
        /**
         * Vincula los valores del formulario a la sentencia SQL.
         */
        $stmt->bindValue(":name", $_POST['name'], PDO::PARAM_STR);
        $stmt->bindValue(":description", $_POST['description'], PDO::PARAM_STR);
        $stmt->bindValue(":eventDate", $_POST['eventDate'], PDO::PARAM_STR);
        $stmt->execute();
        /**
         * Crea una sentencia SQL para obtener el ID del último evento insertado.
         * La prepara.
         * La ejecuta.
         * Obtiene el resultado de la consulta
         */
        $idEvent = "SELECT MAX(ID) as ID FROM events;";
        $stmt = $conection->prepare($idEvent);
        $stmt->execute();
        $idResp = $stmt->fetch(PDO::FETCH_ASSOC);
        /**
         * Crea una sentencia SQL para insertar un nuevo participante en la tabla de participantes.
         * Prepara la sentencia SQL.
         * Ejecuta la sentencia SQL.
         */
        $sql = "INSERT INTO participants ( IDUser, IDEvent )
                VALUES ( :iduser, :idevent )";
        $stmt = $conection->prepare($sql);
        $stmt->bindValue(":iduser", intval(unserialize($_COOKIE['userData'])['ID']), PDO::PARAM_INT);
        $stmt->bindValue(":idevent", $idResp['ID'], PDO::PARAM_INT);
        $stmt->execute();
    };

    /**
     * Primero verifica si el usuario ha iniciado sesión, para ello verifica si existe la cookie
     * 'userData'. Si existe, se procede a mostrar la página de eventos con una consulta a la base de datos
     * que trae todos los eventos. Si no existe, se redirige al usuario a la página de inicio de sesión.
     */
    // Verifica si existe la cookie 'userData'
    if ( isset($_COOKIE['userData']) ) {
        // Prepara la consulta a la tabla de eventos
        $sel = "SELECT * FROM events";
        $stmt = $conection->prepare($sel);
        $stmt->execute();
        // Almacena todos los eventos en un arreglo
        $resp = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Trae los componentes head.php y menu.php
        require_once "components/head.php";
        require_once "components/menu.php";
?>

    <section class="section section--events">
        <h2 class="section__h2">EXPLORAR EVENTOS</h2>
        <div class="events">
        <?php foreach ( $resp as $k ): ?>
            <div class="event">
                <h3><?= $k['name']?></h3>
                <p><?= $k['eventDate']?></p>
                <p><?= $k['description']?></p>
            </div>
        <?php endforeach; ?>
        </div>
    </section>

<?php
    // Trae el componente footer.php
    require_once "components/footer.php";
    } else {
        // Si no existe la cookie, redirige al usuario a la página de inicio de sesión
        Header('Location: login');
        exit();
    };
?>