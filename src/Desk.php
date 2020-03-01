<?php

class Desk {

    private $isNewBatch = true;
    private $isStepBack;
    private $figures = [];
    
    public function __construct() {
        $this->figures['a'][1] = new Rook(false, $this);
        $this->figures['b'][1] = new Knight(false, $this);
        $this->figures['c'][1] = new Bishop(false, $this);
        $this->figures['d'][1] = new Queen(false, $this);
        $this->figures['e'][1] = new King(false, $this);
        $this->figures['f'][1] = new Bishop(false, $this);
        $this->figures['g'][1] = new Knight(false, $this);
        $this->figures['h'][1] = new Rook(false, $this);

        $this->figures['a'][2] = new Pawn(false, $this);
        $this->figures['b'][2] = new Pawn(false, $this);
        $this->figures['c'][2] = new Pawn(false, $this);
        $this->figures['d'][2] = new Pawn(false, $this);
        $this->figures['e'][2] = new Pawn(false, $this);
        $this->figures['f'][2] = new Pawn(false, $this);
        $this->figures['g'][2] = new Pawn(false, $this);
        $this->figures['h'][2] = new Pawn(false, $this);

        $this->figures['a'][7] = new Pawn(true, $this);
        $this->figures['b'][7] = new Pawn(true, $this);
        $this->figures['c'][7] = new Pawn(true, $this);
        $this->figures['d'][7] = new Pawn(true, $this);
        $this->figures['e'][7] = new Pawn(true, $this);
        $this->figures['f'][7] = new Pawn(true, $this);
        $this->figures['g'][7] = new Pawn(true, $this);
        $this->figures['h'][7] = new Pawn(true, $this);

        $this->figures['a'][8] = new Rook(true, $this);
        $this->figures['b'][8] = new Knight(true, $this);
        $this->figures['c'][8] = new Bishop(true, $this);
        $this->figures['d'][8] = new Queen(true, $this);
        $this->figures['e'][8] = new King(true, $this);
        $this->figures['f'][8] = new Bishop(true, $this);
        $this->figures['g'][8] = new Knight(true, $this);
        $this->figures['h'][8] = new Rook(true, $this);
    }

    public function move($move) {
        if (!preg_match('/^([a-h])(\d)-([a-h])(\d)$/', $move, $match)) {
            throw new \Exception("Incorrect move");
        }

        $xFrom = $match[1];
        $yFrom = $match[2];
        $xTo   = $match[3];
        $yTo   = $match[4];
        $this->verifyY($yFrom);
        $this->verifyY($yTo);
        if (isset($this->figures[$xFrom][$yFrom])) {
            /** @var $figure Figure */
            $figure = $this->figures[$xFrom][$yFrom];
            $this->nextStep($figure);
            $this->setFirstStep($figure);
            $figure->verifyNextStep($xFrom, $yFrom, $xTo, $yTo);
            $this->figures[$xTo][$yTo] = $figure;
            $this->isNewBatch = false;
        }
        unset($this->figures[$xFrom][$yFrom]);
    }

    public function dump() {
        for ($y = 8; $y >= 1; $y--) {
            echo "$y ";
            for ($x = 'a'; $x <= 'h'; $x++) {
                if (isset($this->figures[$x][$y])) {
                    echo $this->figures[$x][$y];
                } else {
                    echo '-';
                }
            }
            echo "\n";
        }
        echo "  abcdefgh\n";
    }

    public function getFigure($x, $y): ?Figure
    {
        return $this->figures[$x][$y]??null;
    }

    private function setFirstStep(Figure $figure)
    {
        if ($this->isNewBatch) {
            $this->isStepBack = $figure->getIsBlack();
        }
    }

    private function nextStep(Figure $figure)
    {
        if (!$this->isNewBatch) {
            if ($figure->equalIsBack($this->isStepBack)) {
                throw new DomainException('Не ваш ход');
            } else {
                $this->isStepBack = $figure->getIsBlack();
            }
        }
    }

    public function verifyY($y)
    {
        if (!in_array($y, [1,2,3,4,5,6,7,8])) {
            throw new DomainException("Не верный ход по y \"$y\"");
        }
    }

    public function throwException($message)
    {
        throw new DomainException($message);
    }
}
