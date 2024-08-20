<?php
$title = "Quizz";
require '../Outils/header.php';
require '../Database/pdo.php';

$request = $pdo->query('SELECT * FROM quizz_list');
if ($request) {
    $result = $request->fetchAll();
} else {
    $errorInfo = $pdo->errorInfo();
    echo "Erreur SQL : " . $errorInfo[2];
}

?>
<div class="home">
    <div class="search">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
        </svg>
        <input type="text" id="search" name="search" placeholder="Recherchez votre quizz..." />
    </div>

    <div class="container">
        <?php

        foreach ($result as $tableau) {
            $titre = $tableau['quizz_name'];
            $desc = $tableau['quizz_desc'];
            $id = $tableau['id'];
            $destination = "about";
            if ($user->isadmin()) {
                $destination = "edit";
            }
            echo "
        <a href='$destination-quizz.php?id=$id' class='quizz-container'>
            <h2 class='quizz-tilte'>$titre</h2>
            <p class='quizz-description'>
                $desc
            </p>
        </a>";
        }

        ?>
    </div>
</div>
</body>

<?php require '../Outils/footer.php'; ?>