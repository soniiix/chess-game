<?php

class OccupiedByAllyException extends Exception {
    public function __construct() {
        parent::__construct("La case ciblée est occupée par une pièce alliée.");
    }
}