<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přidat hru</title>
    
    <!-- Bootstrap CSS -->
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
                        <a class="nav-link" href="../../views/games/game_create.php">Přidat hru</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="game_list.php">Výpis her</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h2>Přidat novou hru</h2>
                </div>
                <div class="card-body">
                    <form action="../../controllers/GameController.php" method="post" enctype="multipart/form-data">
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Název hry: <span class="text-danger">*</span></label>
                            <input type="text" id="title" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="developer" class="form-label">Vývojář: <span class="text-danger">*</span></label>
                            <input type="text" id="developer" name="developer" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="genre" class="form-label">Žánr:</label>
                            <input type="text" id="genre" name="genre" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="platform" class="form-label">Platforma:</label>
                            <input type="text" id="platform" name="platform" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="release_year" class="form-label">Rok vydání: <span class="text-danger">*</span></label>
                            <input type="number" id="release_year" name="release_year" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Cena: <span class="text-danger">*</span></label>
                            <input type="number" id="price" name="price" class="form-control" step="0.01" required>
                        </div>

                        <div class="mb-3">
                            <label for="pegi" class="form-label">PEGI hodnocení: <span class="text-danger">*</span></label>
                            <input type="text" id="pegi" name="pegi" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Popis:</label>
                            <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="link" class="form-label">Odkaz na hru (např. Steam):</label>
                            <input type="url" id="link" name="link" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label">Obrázky (můžete nahrát více):</label>
                            <input type="file" id="images" name="images[]" class="form-control" multiple accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-success w-100">Uložit hru</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
