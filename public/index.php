<?php

/**
 * @author Laura Sarmiento Melián
 * email laurasarmientomelian@gmail.com
 * 
 * Este script redirige la solicitud a la página correspondiente en base a la URL.
 *
 * @param string $route redirige a la ruta especificada
 * @param string $resource primera parte de la ruta
 * @param string $id la segunda par5te de la ruta
 */
$route = $_GET['route'] ?? '';
$route = explode('/', $route);

$resource = $route[0] === '' ? '/' : $route[0];
$id = $route[1] ?? null;

/**
 * Basándose en $resource, el script carga el correspondiente archivo PHP.
 * Si no encuentra uno válido, por defecto carga la página 404.
 */
switch ( $resource ) {
    case "/":
        require_once('../views/frontPage.php');
        break;
    
    case "showallevents":
        require_once("../views/showAllEvents.php");
        break;

    case "signup":
        require_once("../views/signup.php");
        break;

    case "login":
        require_once("../views/login.php");
        break;

    case "profile":
        require_once("../views/userProfile.php");
        break;

    case "addevent":
        require_once("../views/addEvent.php");
        break;

    case "editprofile":
        require_once("../views/editprofile.php");
        break;

    default:
        require_once("../views/404.php");
        break;

};
