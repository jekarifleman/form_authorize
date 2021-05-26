<?php

/*
 * dbQuery - создание запросов в mysql
 *
 * @param object $db Объект mysqli после подключения к бд.
 * @param string $queryString Строка запроса, по которой будет произведен запрос в mysql
 *
 * @return array $result Данные, полученные после запроса в mysql
 */
function dbQuery($db, $queryString) {
    $dbQueryResult = mysqli_query($db, $queryString);
    $result = mysqli_fetch_all($dbQueryResult, MYSQLI_ASSOC);

    return $result;
}

/*
 * dbGetUserIdAndPasswordByLogin - получение из бд mysql данных пользователя, а именно user_id и хэш пароля по логину пользователя
 *
 * @param object $db Объект mysqli после подключения к бд.
 * @param string $login Логин пользователя, который проходит аутентификацию на сайте.
 *
 * @return array $userParams Данные, полученные после запроса в mysql, в данном случае id и хэш пароля
 */
function dbGetUserIdAndPasswordByLogin($db, $login) {
    $login = mysqli_real_escape_string($db, $login);
    $queryString = 'SELECT `id`, `password_hash` FROM `users` WHERE `login`="' . $login . '"  LIMIT 1';
    $userParams = dbQuery($db, $queryString);
    $userParams = $userParams[0] ?? [];

    return $userParams;
}

/*
 * dbGetUserParamsById - получение из бд mysql всех данных пользователя, которые нужны для описания профиля на странице
 * 
 * Происходит 2 запроса, затем полученные данные объединяются в 1 массив
 *
 * @param object $db Объект mysqli после подключения к бд.
 * @param string $userId Id пользователя, который проходит аутентификацию на сайте.
 *
 * @return array $userParams Данные, полученные после запроса в mysql, в данном случае, данные пользователя
 */
function dbGetUserParamsById($db, $userId) {
    $userId = mysqli_real_escape_string($db, $userId);
    $queryString = 'SELECT * FROM `users` WHERE `id`="' . $userId . '"  LIMIT 1';
    $userParams = dbQuery($db, $queryString);
    $userParams = $userParams[0] ?? [];

    return $userParams;
}

/*
 * dbGetUserGroupsByUserId - получение из бд mysql группы пользователя
 * 
 * Этот запрос делаем чтобы узнать в каких группах на сайте состоит авторизованный пользователь
 *
 * @param object $db Объект mysqli после подключения к бд.
 * @param string $userId Id пользователя, который прошел аутентификацию на сайте.
 *
 * @return array $userParams Данные, полученные после запроса в mysql, в данном случае группы пользователя
 */
function dbGetUserGroupsByUserId($db, $userId) {
    $userId = mysqli_real_escape_string($db, $userId);
    $queryString = 'SELECT `groups`.`name` as `group_name`
                    FROM `groups`
                    INNER JOIN `group_user`
                    ON `groups`.`id`=`group_user`.`group_id`
                    WHERE `group_user`.`user_id`=' . $userId . ' LIMIT 1';
    $result = dbQuery($db, $queryString);
    $groups = [];

    foreach ($result as $group) {
        $groups[] = $group['group_name'];
    }

    return $groups;
}
