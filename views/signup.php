<?php
    require_once "components/head.php";
    require_once "components/menu.php";
?>

    <section class="section">
        <h2 class="section__h2">CREAR CUENTA</h2>

        <form action="login" method="post">
            <input type="text" name="userName" placeholder="NOMBRE DE USUARIO">
            <input type="text" name="password" placeholder="CONTRASEÑA">
            <input type="text" name="name" placeholder="NOMBRE">
            <input type="text" name="surname" placeholder="APELLIDOS">
            <input type="text" name="email" placeholder="E-MAIL">
            <input type="text" name="phone" placeholder="TELÉFONO">
            <button type="submit" name="submit">ACEPTAR</button>
        </form>
    </section>

<?php
    require_once "components/footer.php";
?>