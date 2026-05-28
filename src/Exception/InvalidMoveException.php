<?php

namespace ChessGame\Exception;
use Exception;

class InvalidMoveException extends Exception {
    public function __construct() {
        parent::__construct("Mouvement invalide");
    }
}