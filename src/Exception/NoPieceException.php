<?php

namespace ChessGame\Exception;
use ChessGame\Position;

class NoPieceException extends ChessException {
    public function __construct(Position $position) {
        parent::__construct("Pas de pièce à la position " . $position->toKey());
    }
}