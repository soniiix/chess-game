<?php

class Knight extends Piece {
    protected PieceType $type = PieceType::KNIGHT;

    protected function isValidMovementShape(Position $target): bool{
        $currentColumn = $this->getPosition()->getColumn();
        $currentRow = $this->getPosition()->getRow();
        $targetColumn = $target->getColumn();
        $targetRow = $target->getRow();

        // déplacement à gauche
        if ($targetColumn === ($currentColumn - 2)){
            // à gauche puis bas ou à gauche puis haut
            return ($targetRow === ($currentRow - 1) || $targetRow === ($currentRow + 1));
        }
        // déplacement à droite
        if ($targetColumn === ($currentColumn + 2)){
            // à droite puis bas ou à droite puis haut
            return ($targetRow === ($currentRow - 1) || $targetRow === ($currentRow + 1));
        }

        // déplacement en bas
        if ($targetRow === ($currentRow - 2)){
            // en bas puis à gauche ou en bas puis à droite
            return ($targetColumn === ($currentColumn - 1) || $targetColumn === ($currentColumn + 1));
        }

        // déplacement en haut
        if ($targetRow === ($currentRow + 2)){
            // en haut puis à gauche ou en haut puis à droite
            return ($targetColumn === ($currentColumn - 1) || $targetColumn === ($currentColumn + 1));
        }
        
        return false;
    }
}