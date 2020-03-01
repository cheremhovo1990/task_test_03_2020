<?php

declare(strict_types=1);


class PawnTopVerify extends PawnBaseAlgorithmVerify
{
    function first($xFrom, $yFrom, $xTo, $yTo)
    {
        if ($xFrom != $xTo) {
            $this->desk->throwException('Не верный ход');
        }
        if ($yFrom-1 != $yTo && $yFrom-2 != $yTo) {
            $this->desk->throwException('Не верный ход');
        }
        if (!is_null($this->desk->getFigure($xFrom, $yFrom-1))) {
            $this->desk->throwException('Не верный ход');
        }
        if ($yFrom-2 == $yTo) {
            if (!is_null($this->desk->getFigure($xFrom, $yFrom-2))) {
                $this->desk->throwException('Не верный ход');
            }
        }
    }

    function next($xFrom, $yFrom, $xTo, $yTo)
    {
        if ($yFrom-1 != $yTo) {
            $this->desk->throwException('Не верный ход');
        }
        $this->verifyX($xFrom, $xTo, $yTo);
        if ($xFrom == $xTo) {
            if (!is_null($this->desk->getFigure($xFrom, $yFrom-1))) {
                $this->desk->throwException('Не верный ход');
            }
        }
    }
}