<?php
declare(strict_types=1);
namespace taskforce\utils;
use DateTime;

class DateConversion
{
    public static function getDate($date, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($date);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'года',
            'm' => 'месяца',
            'w' => 'недели',
            'd' => 'дня',
            'h' => 'часов'
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v;
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' назад' : 'вперед';
    }
}