<?php
if (!session_id()) {
    session_start();
}

require_once '../app/core/app.php';
require_once '../app/core/controller.php';
require_once '../app/core/database.php';
require_once '../app/core/flasher.php';

$app = new App();
