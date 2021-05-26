<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/include/db_authentificate.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/db_queries.php';

session_start();

if (isset($_POST['logout']) && $_POST['logout'] == 'logout') {
    session_destroy();

    header('location: /?login=true');
}

if (!isset($_SESSION['is_authorized'])) {
    $_SESSION['is_authorized'] = false;
}

$isFirstAuthorize = false;

require_once $_SERVER['DOCUMENT_ROOT'] . '/include/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/main_menu.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/db_authentificate.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/db_queries.php';

if (!$_SESSION['is_authorized'] && !isCurrentUrl('/')) {
    header('location: /?login=true');
}

if ($_SESSION['is_authorized'] && isset($_COOKIE['login'])){
        setcookie('login', $_COOKIE['login'], time() + 60 * 60 * 24 * 30, '/');
}

if (isset($_POST['login']) && isset($_POST['password'])  && isCurrentUrl('/') && !$_SESSION['is_authorized']) {
    $db = dbAuthentificate();

    $userParams = dbGetUserIdAndPasswordByLogin($db, $_POST['login']);

    $userId = $userParams['id'] ?? '';
    $passwordHash = $userParams['password_hash'] ?? '';

    if (password_verify($_POST['password'], $passwordHash)) {
        $_SESSION['is_authorized'] = true;
        $_SESSION['user_id'] = $userId;

        $isFirstAuthorize = true;

        setcookie('login', $_POST['login'], time() + 60 * 60 * 24 * 30, '/');
    }

    mysqli_close($db);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="/styles.css" rel="stylesheet">
    <?php if (isCurrentUrl('/route/profile/')) { ?>
        <title> style="text-align: center;">Профиль</title>
    <?php } else { ?>
        <title><?=getTitle($menu)?></title>
    <?php } ?>
</head>

<body>

    <div class="header">
    	<div class="logo"><img src="/i/logo.png" width="68" height="23" alt="Project"></div>
        <div class="clearfix">
            <?php if ($_SESSION['is_authorized']) { ?>
                <form action="/?login=true" method="post">
                    <input type="hidden" name="logout" value="logout">
                    <input type="submit" value="Выйти">
                </form>
                <ul class="main-menu" style="clear: none;float: right;">
                    <li><a href="/route/profile/" style="font-size: 12px;">Профиль</a></li>
                </ul>
            <?php } ?>
        </div>
    </div>

    <?php getMenu($menu, 'main-menu', 'sort', SORT_ASC)?>
    <div class="clearfix">
        <?php if (isCurrentUrl('/route/profile/')) { ?>
            <h1 style="text-align: center;">Профиль
        <?php } else { ?>
            <h1><?=getTitle($menu)?></h1>
        <?php } ?>
    </div>
