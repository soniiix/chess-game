<?php

class King extends Piece {
    protected PieceType $type = PieceType::KING;

    protected function isValidMovementShape(Position $target): bool{
        $ecartX = abs($target->getRow() - $this->getPosition()->getRow());
        $ecartY = abs($target->getColumn() - $this->getPosition()->getColumn());

        // 1 seule case de déplacement possible, soit en ligne soit en colonne
        return ($ecartX <= 1 && $ecartY <= 1);
    }
}