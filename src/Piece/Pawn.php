<?php

class Pawn extends Piece {
    protected PieceType $type = PieceType::PAWN;

    protected function isValidMovementShape(Position $target): bool{
        $currentColumn = $this->getPosition()->getColumn();
        $currentRow = $this->getPosition()->getRow();
        $targetColumn = $target->getColumn();
        $targetRow = $target->getRow();
        $rowDiff = $targetRow - $currentRow;
        $columnDiff = $targetColumn - $currentColumn;
        $direction = $this->getColor() === PieceColor::WHITE ? 1 : -1;

        // avance normale d'une case
        if ($columnDiff === 0 && $rowDiff === $direction) {
            return true;
        }

        // avance de 2 cases uniquement depuis la ligne de départ
        if ($columnDiff === 0 && $rowDiff === (2 * $direction)) {
            $startRow = $this->getColor() === PieceColor::WHITE ? 1 : 6;
            return $currentRow === $startRow;
        }

        // capture en diagonale
        if (abs($columnDiff) === 1 && $rowDiff === $direction) {
            return true;
        }

        return false;
    }
}