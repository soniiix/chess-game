<?php

namespace ChessGame\Exception;
use ChessGame\Exception\ChessException;

class InvalidMoveException extends ChessException {
    public function __construct() {
        parent::__construct("Mouvement invalide");
    }
}