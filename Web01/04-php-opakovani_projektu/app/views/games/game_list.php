<?php
require_once '../../models/Database.php';
require_once '../../models/Game.php';

$db = (new Database())->getConnection();
$gameModel = new Game($db);
$games = $gameModel->getAll();
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Výpis her</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Herní databáze</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="game_create.php">Přidat hru</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="game_list.php">Výpis her</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h2>Výpis her</h2>

    <?php if (!empty($games)): ?>
        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Název</th>
                    <th>Vývojář</th>
                    <th>Žánr</th>
                    <th>Platforma</th>
                    <th>Rok</th>
                    <th>Cena</th>
                    <th>PEGI</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($games as $game): ?>
                    <tr>
                        <td><?= htmlspecialchars($game['title']) ?></td>
                        <td><?= htmlspecialchars($game['developer']) ?></td>
                        <td><?= htmlspecialchars($game['genre']) ?></td>
                        <td><?= htmlspecialchars($game['platform']) ?></td>
                        <td><?= htmlspecialchars($game['release_year']) ?></td>
                        <td><?= htmlspecialchars($game['price']) ?> Kč</td>
                        <td><?= htmlspecialchars($game['pegi']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Nebyly načteny žádné hry</div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

