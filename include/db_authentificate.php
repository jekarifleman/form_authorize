<?php

/*
 * dbAuthentificate - Подключение к БД
 * 
 * Данные подключения зашиты в передаваемых параметрах
 *
 * @param данные для подключения к mysql
 *
 * @return object $connect Объект mysqli, либо скрипт завершается с ошибкой.
 */
function dbAuthentificate($dbHost = 'localhost', $dbLogin = 'test', $dbPassword = 'test', $dbName = 'sumacakove_qschool_test') {

    static $connect;

    if ($connect === null) {
    	$connect = mysqli_connect($dbHost, $dbLogin, $dbPassword, $dbName);
    }

    if (!$connect) {
        die('Ошибка соединения с БД: ' . mysqli_connect_error());
    }

    return $connect;
}
