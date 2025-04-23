<?php
require_once '../../models/Database.php';
require_once '../../models/Game.php';

$db = (new Database())->getConnection();
$gameModel = new Game($db);
$games = $gameModel->getAll();

$editMode = false;
$gameToEdit = null;

if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    $gameToEdit = $gameModel->getById($editId);
    if ($gameToEdit) {
        $editMode = true;
    }
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editace a mazání her</title>
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

    <?php if ($editMode): ?>
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h2>Upravit hru: <?= htmlspecialchars($gameToEdit['title']) ?></h2>
                </div>
                <div class="card-body">
                    <form action="../../controllers/game_update.php" method="post">
                        <input type="hidden" name="id" value="<?= $gameToEdit['id'] ?>">
                        <div class="mb-3">
                            <label class="form-label">ID hry:</label>
                            <input type="text" class="form-control" value="<?= $gameToEdit['id'] ?>" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Název hry:</label>
                            <input type="text" id="title" name="title" class="form-control" required value="<?= htmlspecialchars($gameToEdit['title']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="developer" class="form-label">Vývojář:</label>
                            <input type="text" id="developer" name="developer" class="form-control" required value="<?= htmlspecialchars($gameToEdit['developer']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="genre" class="form-label">Žánr:</label>
                            <input type="text" id="genre" name="genre" class="form-control" value="<?= htmlspecialchars($gameToEdit['genre']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="platform" class="form-label">Platforma:</label>
                            <input type="text" id="platform" name="platform" class="form-control" value="<?= htmlspecialchars($gameToEdit['platform']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="release_year" class="form-label">Rok vydání:</label>
                            <input type="number" id="release_year" name="release_year" class="form-control" required value="<?= htmlspecialchars($gameToEdit['release_year']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Cena:</label>
                            <input type="number" id="price" name="price" class="form-control" step="0.01" required value="<?= htmlspecialchars($gameToEdit['price']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="pegi" class="form-label">PEGI:</label>
                            <input type="text" id="pegi" name="pegi" class="form-control" required value="<?= htmlspecialchars($gameToEdit['pegi']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Popis:</label>
                            <textarea id="description" name="description" class="form-control" rows="3"><?= htmlspecialchars($gameToEdit['description']) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="link" class="form-label">Odkaz:</label>
                            <input type="url" id="link" name="link" class="form-control" value="<?= htmlspecialchars($gameToEdit['link']) ?>">
                        </div>

                        <button type="submit" class="btn btn-success w-100">Uložit změny</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <h2>Výpis her</h2>
    <?php if (!empty($games)): ?>
    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Název</th>
                <th>Vývojář</th>
                <th>Žánr</th>
                <th>Rok</th>
                <th>Cena</th>
                <th>PEGI</th>
                <th>Akce</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($games as $game): ?>
            <tr>
                <td><?= htmlspecialchars($game['id']) ?></td>
                <td><?= htmlspecialchars($game['title']) ?></td>
                <td><?= htmlspecialchars($game['developer']) ?></td>
                <td><?= htmlspecialchars($game['genre']) ?></td>
                <td><?= htmlspecialchars($game['release_year']) ?></td>
                <td><?= number_format($game['price'], 2, ',', ' ') ?> Kč</td>
                <td><?= htmlspecialchars($game['pegi']) ?></td>
                <td>
                    <a href="?edit=<?= $game['id'] ?>" class="btn btn-sm btn-warning">Upravit</a>
                    <a href="../../controllers/game_delete.php?id=<?= $game['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Opravdu chcete smazat tuto hru?');">Smazat</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <div class="alert alert-info">Žádná hra nebyla nalezena.</div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
