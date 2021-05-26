<?php

/*
 * arraySort - Сортировка массива
 * 
 * В функцию передаются массив и параметры, от которых зависит как будет сортироваться массив
 *
 * @param array $array Массив, который нужно отсортировать
 * @param string $orderByKey Ключ массива, по которому будет сортировка
 * @param int/const $orderDirection Порядок сортировки, может быть либо SORT_ASC - по возрастанию, либо SORT_DESC - по убыванию
 *
 * @return array $array Отсортированный массив
 */
function arraySort($array, $orderByKey, $orderDirection = SORT_ASC)
{
    if ($orderDirection != SORT_ASC && $orderDirection != SORT_DESC) {
        $orderDirection = SORT_ASC;
    }

    usort($array, function($a, $b) use ($orderByKey, $orderDirection) {
        return $orderDirection == SORT_ASC ? $a[$orderByKey] <=> $b[$orderByKey] : $b[$orderByKey] <=> $a[$orderByKey];
    });

    return $array;
}

/*
 * getMenu - Вывод пунктов меню на странице
 * 
 * В функцию передается массив меню, который сортируется исходя из других переданных параметров и выводится на страницу
 *
 * @menu array $array Массив с пунктами меню
 * @param string $cssClass Css-класс меню
 * @param string $orderByKey Ключ массива, по которому будет сортировка
 * @param int/const $orderDirection Порядок сортировки, может быть либо SORT_ASC - по возрастанию, либо SORT_DESC - по убыванию
 *
 * @return ничего не возвращает
 */
function getMenu($menu, $cssClass, $orderByKey, $orderDirection = SORT_ASC)
{
    $sortedMenu = arraySort($menu, $orderByKey, $orderDirection);
    require $_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php";
}

/*
 * cropString - Обрезание строки
 * 
 * В функцию передается строка, которая будет обрезана до указанной длины, и если она обрезана, то в конце добавляется троеточие
 *
 * @param string $str Строка, которую нужно обрезать
 * @param ште $length Длина строки, после которой строка обрезается
 *
 * @return string $str Обрезанная строка
 */
function cropString($str, $length = 12)
{
    return mb_strlen($str) > $length ? mb_substr($str, 0, $length) . '...' : $str;
}

/*
 * isCurrentUrl - проверка текущего url
 * 
 * В функцию передается строка, для проверки, является ли она текущим url, независимо от get-параметров
 *
 * @param string $url Url страницы
 *
 * @return boolean true/false
 */
function isCurrentUrl($url) {
    return $url == parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
}


/*
 * getTitle - Получение названия раздела страницы
 * 
 * В функцию передается массив меню для перебора его значений, если url элемента является текущей страницей, то возвращается название текущей страницы
 *
 * @param array $menu Массив меню
 *
 * @return string $item['title'] Название текущего раздела
 */
function getTitle($menu)
{
    foreach ($menu as $item) {
    	if (isCurrentUrl($item['url'])) {
    		return $item['title'] ;
    	}
    }
}
