<?php

namespace ChessGame\Exception;

class OccupiedByAllyException extends ChessException {
    public function __construct() {
        parent::__construct("La case ciblée est occupée par une pièce alliée.");
    }
}