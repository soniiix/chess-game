<?php

namespace ChessGame\Exception;

class WrongTurnException extends ChessException {
    public function __construct() {
        parent::__construct("Ce n'est pas au tour de cette couleur de jouer.");
    }
}