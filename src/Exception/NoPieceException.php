<?php

class NoPieceException extends Exception {
    public function __construct(Position $position) {
        parent::__construct("Pas de pièce à la position " . $position->toKey());
    }
}