<?php

namespace Davidsonts\DigitableLineToBarCode;

class DigitableLineToBarCode
{
    public static function toBarCode($digitableLine)
    {
        strlen($digitableLine) == 44 or die('Digitable line must have 44 characters');

        $bar_code = [];
        for ($i=0; $i < 4; $i++) { 
            $number = substr($digitableLine, 0, 11);
            $arr = str_split($number);
            $calc = self::calc($arr);
            $bar_code[$i] = $number . $calc;  
            $digitableLine = str_replace($number, '', $digitableLine);
        }
        return implode('', $bar_code);
    }

    private static function calc($arr)
    {
        $soma = [];
        $multiplicador = 2; 
        foreach (array_reverse($arr) as $key => $value) {
            $soma[$key] = $value * $multiplicador;
            $multiplicador = $multiplicador == 9 ? 2 : ++$multiplicador;
        }

        $rest = (array_sum($soma)) % 11;
        $result = 11 - $rest;

        if($result > 9) {
            $total = 0;
        } elseif($result == 0)  {
            $total = $result;
        } else {
            $total = $result;
        }

       return $total;
    }
}
