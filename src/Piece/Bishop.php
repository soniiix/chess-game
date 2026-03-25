<?php

class Bishop extends Piece{
    protected PieceType $type = PieceType::BISHOP;

    protected function isValidMovementShape(Position $target): bool{
        // déplacement diagonal
        $ecartX = abs($target->getRow() - $this->getPosition()->getRow());
        $ecartY = abs($target->getColumn() - $this->getPosition()->getColumn());
        return $ecartX === $ecartY;
    }
}