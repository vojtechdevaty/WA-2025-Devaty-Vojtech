<?php
require_once '../models/Database.php';
require_once '../models/Game.php';

class GameController {
    private $db;
    private $gameModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->gameModel = new Game($this->db);
    }

    public function createGame() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = htmlspecialchars($_POST['title']);
            $developer = htmlspecialchars($_POST['developer']);
            $genre = !empty($_POST['genre']) ? htmlspecialchars($_POST['genre']) : null;
            $platform = !empty($_POST['platform']) ? htmlspecialchars($_POST['platform']) : null;
            $release_year = intval($_POST['release_year']);
            $price = floatval($_POST['price']);
            $pegi = htmlspecialchars($_POST['pegi']);
            $description = htmlspecialchars($_POST['description']);
            $link = htmlspecialchars($_POST['link']); // správné pole místo trailer_link

            // Zpracování nahraných obrázků
            $imagePaths = [];
            if (!empty($_FILES['images']['name'][0])) {
                $uploadDir = '../public/images/';
                foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                    $filename = basename($_FILES['images']['name'][$key]);
                    $targetPath = $uploadDir . $filename;

                    if (move_uploaded_file($tmp_name, $targetPath)) {
                        $imagePaths[] = '/public/images/' . $filename; // Relativní cesta
                    }
                }
            }

            // Uložení hry do DB
            if ($this->gameModel->create($title, $developer, $genre, $platform, $release_year, $price, $pegi, $description, $link, $imagePaths)) {
                header("Location: ../views/games/game_list.php");
                exit();
            } else {
                echo "Chyba při ukládání hry.";
            }
        }
    }

    public function listGames() {
        $games = $this->gameModel->getALL();
        include '../views/games/games_list.php';
    }
}

// Volání metody při odeslání formuláře
$controller = new GameController();
$controller->createGame();
