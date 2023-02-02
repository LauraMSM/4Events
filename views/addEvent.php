<?php
/**
 * @file addEvent.php
 *
 * @brief Este archivo contiene el formulario para crear un nuevo evento.
 * Si el usuario no ha iniciado sesión, se redirigirá a la página de inicio de sesión.
 */

/**
 * Verifica si el usuario ha iniciado sesión
 */
if ( isset($_COOKIE['userData']) ) {
    /**
     * Incluye el archivo head.php
     */
    require_once "components/head.php";

    /**
     * Incluye el archivo menu.php
     */
    require_once "components/menu.php";
?>

    <!-- Sección para crear un nuevo evento -->
    <section class="section">
        <h2 class="section__h2 section__h2--addevent">¿CUÁL SERÁ TU PRÓXIMO EVENTO?</h2>

        <!-- Formulario para crear un nuevo evento -->
        <form action="showallevents" method="post">
            <input type="text" name="name" placeholder="¿Cómo se va a llamar?">
            <input type="text" name="description" placeholder="Al resto le gustará saber de qué va">
            <input type="date" name="eventDate">
            <button type="submit" name="submit">Crear!</button>
        </form>
    </section>

<?php
    /**
     * Incluye el archivo footer.php
     */
    require_once "components/footer.php";
} else {
    /**
     * Redirige a la página de inicio de sesión
     */
    Header('Location: login');
    exit();
};
?>
