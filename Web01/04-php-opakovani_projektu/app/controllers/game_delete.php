<?php
require_once '../models/Database.php';
require_once '../models/Game.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $db = (new Database())->getConnection();
    $gameModel = new Game($db);

    if ($gameModel->delete($id)) {
        // přesměrování na správný výpis po smazání
        header("Location: ../views/games/games_edit_delete.php");
        exit();
    } else {
        echo "Chyba při mazání hry.";
    }
} else {
    echo "Neplatný požadavek.";
}
