<?php

namespace App\Mixins;

use Closure;
use Illuminate\Support\Str;

class StrMixin
{
    private const NUMBER_TO_WORD = [
        900 => 'девятьсот',
        800 => 'восемьсот',
        700 => 'семьсот',
        600 => 'шестьсот',
        500 => 'пятьсот',
        400 => 'четыреста',
        300 => 'триста',
        200 => 'двести',
        100 => 'сто',
        90 => 'девяносто',
        80 => 'восемьдесят',
        70 => 'семьдесят',
        60 => 'шестьдесят',
        50 => 'пятьдесят',
        40 => 'сорок',
        30 => 'тридцать',
        20 => 'двадцать',
        19 => 'девятнадцать',
        18 => 'восемнадцать',
        17 => 'семнадцать',
        16 => 'шестнадцать',
        15 => 'пятнадцать',
        14 => 'четырнадцать',
        13 => 'тринадцать',
        12 => 'двенадцать',
        11 => 'одиннадцать',
        10 => 'десять',
        9 => 'девять',
        8 => 'восемь',
        7 => 'семь',
        6 => 'шесть',
        5 => 'пять',
        4 => 'четыре',
        3 => 'три',
        2 => 'два',
        1 => 'один',
    ];

    private const LEVEL = [
        4 => ['миллиард', 'миллиарда', 'миллиардов'],
        3 => ['миллион', 'миллиона', 'миллионов'],
        2 => ['тысяча', 'тысячи', 'тысяч'],
    ];

    /**
     * Возвращает дату прописью.
     *
     * @return Closure
     */
    public function dateInWords()
    {
        return static function (string $date, string $dateDelimiter, string $newDelimiter) {
            $dateArray = explode($dateDelimiter, $date);
            $mothsArray = [
                '',
                'января',
                'февраля',
                'марта',
                'апреля',
                'мая',
                'июня',
                'июля',
                'августа',
                'сентября',
                'октября',
                'ноября',
                'декабря'
            ];

            $day = str_pad(
                $dateArray[2],
                2,
                '0',
                STR_PAD_LEFT
            );

            return $day . $newDelimiter . $mothsArray[(int)$dateArray[1]] . $newDelimiter . $dateArray[0] . ' г.';
        };
    }

    /**
     * Запись числительного словами.
     *
     * TODO: переписать, не читается.
     *
     * @return Closure
     */
    public function sumInWords()
    {
        return static function ($number, array $firstCurrency = [], array $secondCurrency = []) {
            [$rubles, $kopecks] = explode('.', number_format($number, 2));

            $parts = explode(',', $rubles);

            for ($str = '', $level = count($parts), $i = 0, $iMax = count($parts); $i < $iMax; $i++, $level--) {
                if ((int)$num = $parts[$i]) {
                    foreach (StrMixin::NUMBER_TO_WORD as $key => $value) {
                        if ($num >= $key) {
                            if ($level === 2 && $key === 1) {
                                $value = 'одна';
                            }
                            if ($level === 2 && $key === 2) {
                                $value = 'две';
                            }
                            $str .= ($str !== '' ? ' ' : '') . $value;
                            $num -= $key;
                        }
                    }
                    if (isset(StrMixin::LEVEL[$level])) {
                        $str .= ' ' . Str::numToWord($parts[$i], StrMixin::LEVEL[$level]);
                    }
                }
            }

            if (count($firstCurrency) > 0 && count($secondCurrency) > 0) {
                if ((int)$rubles = str_replace(',', '', $rubles)) {
                    $str .= ' ' . Str::numToWord($rubles, $firstCurrency);
                }

                $str .= ($str !== '' ? ' ' : '') . $kopecks;
                $str .= ' ' . Str::numToWord($kopecks, $secondCurrency);
            }

            return mb_strtoupper(
                mb_substr($str, 0, 1, 'UTF-8'),
                'UTF-8'
            )
                . mb_substr(
                    $str,
                    1,
                    mb_strlen($str, 'UTF-8'),
                    'UTF-8'
                );
        };
    }

    /**
     * Склонение числительного.
     *
     * TODO: переписать, не читается.
     *
     * @return Closure
     */
    public function numToWord()
    {
        return static function (int $num, array $words) {
            return (
                $words[($num = ($num %= 100) > 19 ? ($num % 10) : $num) === 1 ? 0 : ((in_array($num, [2, 3, 4])) ? 1 : 2)]
            );
        };
    }

    /**
     * Форматирование числа для цены.
     *
     * @return Closure
     */
    public function priceFormat()
    {
        return static function ($price) {
            return number_format($price, 2, ',', ' ');
        };
    }
}
