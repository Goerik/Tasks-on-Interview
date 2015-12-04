<?php

/*
 * Реализированный алгоритм имеет сложность O(N^2) от длины проверяемой строки.
 * Алгоритм не является оптимальным, т.к. моя цель была написать простой для понимания и
 * сопровождения алгоритм.
 *
 * В случае необходимости его можно переписать, реализовав алгоритм Манакера, который
 * имеет сложность O(N)
 */



/***
 * Осуществляет действия, аналогичные strrev для unicode символов
 * @param $str Строка, которую необходимо "развернуть"
 * @return string  "Развернутая строка"
 */
function utf8_strrev($str){
    preg_match_all('/./us', $str, $ar);
    return join('', array_reverse($ar[0]));
}


/***
 * Проверяет, является ли переданная строка палиндромом
 * @param $str Строка для проверки
 * @return bool|int false - не является палиндромом, число - длина строки, если является палиндромом
 */
function isPalindrome ($str) {
    $temp = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
    $temp = preg_replace('/\s+/', '', $temp);
    $tempRev = utf8_strrev($temp);
    return  $tempRev == $temp ? mb_strlen($temp, "UTF-8") : false;
}


/***
 * Возвращает палиндром максимальной длинны или первый символ строки, если палиндром не найден
 * @param $str Строка для провреки
 * @return string
 */
function getPalindrome ($str) {
    if (isPalindrome($str)) {
        return $str;
    }

    $palLen = 1;
    $palText = mb_substr($str, 0, 1, "UTF-8");
    $stLen = mb_strlen($str, "UTF-8");

    for ($i = 0; $i < $stLen; $i++) {
        for ($j = $i + 1; $j <= $stLen - 1; $j++) {
            $part = trim(mb_substr($str, $i, $j - $i + 1, "UTF-8"));
            $partLen = isPalindrome($part);
            if ($partLen > $palLen) {
                $palLen = $partLen;
                $palText = $part;
            }
        }
    }
    return $palText;

}

assert_options(ASSERT_ACTIVE, 1);

assert(getPalindrome("Аргентина манит негра") == "Аргентина манит негра");
assert(getPalindrome("Аргентина ммнит негра") == "мм");
assert(getPalindrome("Sum summus mus") == "Sum summus mus");
assert(getPalindrome("Abc dfeg jk") == "A");


echo getPalindrome("Sum summus mus");