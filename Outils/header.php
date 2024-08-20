<?php
require '../Database/pdo.php';
require 'class.php';

if ($_COOKIE["id"]) {
    $id = $_COOKIE["id"];
    $request = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $request->bindValue(':id', $id);
    $request->execute();

    $result = $request->fetch();

    try {
        $user = new User($result);
    } catch (\Throwable $th) {
        header('Location: ../Views/index.php');
    }

    if ($user->isadmin()) {
        $bouton = '<li class="links" ><a href="../Views/formateur.php" ><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="" class="bi bi-plus-square" viewBox="0 0 16 16">
  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
</svg></a></li>';
    }
} else {
    header('Location: ../Views/index.php');
}

if ($title == 'Créer un quizz') {
    $bouton = '<li class="links" ><a href="../Views/formateur.php" class="active"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="red" class="bi bi-plus-square" viewBox="0 0 16 16">
  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
</svg></a></li>';
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Quizz" ?></title>
    <link rel="stylesheet" href="../CSS/style.css">
    <script src="../js/header.js" defer></script>


    <!-- la variable here va me permettre de savoir sur quel page je suis avec une condition sur la variable titre -->
    <?php if ($title == 'Quizz') {
        // Quizz/accueil
        $here = 1;
        echo '<link rel="stylesheet" href="../CSS/quizz.css">';
    } elseif ($title == 'Mon Profil') {
        // Profil

        $here = 2;
        echo '<link rel="stylesheet" href="../CSS/profil.css">';
        echo '<script src="../js/profil.js" defer></script>';
    } else {
        // Admin

        $here = 3;
    }
    ?>
</head>

<body>
    <header>
        <div class="left-header">
            <div class="theme-checkbox">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-sun" viewBox="0 0 16 16">
                    <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708" />
                </svg>
                <div class="theme-container">
                    <label class="switch" for="checkbox">
                        <input type="checkbox" name="checkbox" id="checkbox" />
                        <div class="slider round"></div>
                    </label>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-moon" viewBox="0 0 16 16">
                    <path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278M4.858 1.311A7.27 7.27 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.32 7.32 0 0 0 5.205-2.162q-.506.063-1.029.063c-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286" />
                </svg>
            </div>
            <img src="../logo/logo.png" alt="logo" class="logo" />
        </div>
        <nav>
            <ul class="link-container">
                <li class="links">
                    <a href="../Views/quizz.php" class="<?php if ($here == 1) {
                                                            echo 'active';
                                                        } ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="<?php if ($here == 1) {
                                                                                                    echo 'red';
                                                                                                } ?>" class="bi bi-dice-2" viewBox="0 0 16 16">
                            <path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3z" />
                            <path d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m8 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                        </svg>
                    </a>
                </li>

                <?= $bouton ?? "" ?>
                <li class="links">
                    <a href="../Views/profil.php" <?php if ($here == 2) {
                                                        echo 'class="active"';
                                                    } ?>>
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="<?php if ($here == 2) {
                                                                                                    echo 'red';
                                                                                                } ?>" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>
                    </a>
                </li>
                <li class="links">
                    <a href="../Views/index.php" onclick="deconnexion()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="" class="bi bi-door-closed-fill" viewBox="0 0 16 16">
                            <path d="M12 1a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2a1 1 0 0 1 1-1zm-2 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                        </svg>
                    </a>
                </li>
            </ul>
        </nav>
    </header>