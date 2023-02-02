<?php
/**
 * @file editprofile.php
 * Archivo de edición de perfil.
 *
 * Si el usuario ha iniciado sesión, se cargarán los componentes de head.php y menu.php,
 * y se mostrará un formulario para editar los datos del perfil.
 * Si no ha iniciado sesión, no se cargarán estos componentes.
 *
 */
    /**
     * Verificación de la cookie 'userData' para saber si el usuario ha iniciado sesión.
     */
    if ( isset( $_COOKIE['userData'] ) ) {
        /**
         * Inclusión del archivo head.php
         */
        require_once "components/head.php";
        /**
         * Inclusión del archivo menu.php
         */
        require_once "components/menu.php";
    /**
    * Sección que contiene el formulario para editar perfil.
    * Incluye los siguientes campos: nombre de usuario, nombre, apellidos, e-mail y teléfono.
    */
?>
    <section class="section">
        <h2 class="section__h2">EDITAR PERFIL</h2>
        <form action="../public/" method="post">
            <input type="text" name="userName" placeholder="NOMBRE DE USUARIO">
            <input type="text" name="name" placeholder="NOMBRE">
            <input type="text" name="surname" placeholder="APELLIDOS">
            <input type="text" name="email" placeholder="E-MAIL">
            <input type="text" name="phone" placeholder="TELÉFONO">
            <button type="submit" name="edit">GUARDAR CAMBIOS</button>
        </form>
    </section>

<?php
    /**
     * Cierre del if que verifica la cookie 'userData'.
     */
    };

    /**
     * Inclusión del archivo footer.php.
     */
    require_once "components/footer.php";
?>

