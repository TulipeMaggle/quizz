<?php

/**
 * @var PDO $pdo
 */

$title = 'Mon Profil';
require '../Outils/header.php';

if (!empty($_POST)) {
    if ($_POST['pseudo'] !== '' && $_POST['email'] !== '') {
        $request = $pdo->prepare("UPDATE `quizz`.`users` SET `pseudo` = :pseudo, `email` = :email WHERE (`id` = :id);");

        $request->bindValue(':pseudo', $_POST['pseudo']);
        $request->bindValue(':email', $_POST['email']);
        $request->bindValue(':id', "$user->id");

        $request->execute();
    }
}
$rr = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$rr->bindValue(':id', "$user->id");
$rr->execute();

$result = $rr->fetch();
$user = new User($result);
?>

<body>
    <div class="home">
        <div class="conteneur">
            <form class="left-side" action="" method="POST">
                <div class="left-form">
                    <div class="edit-case">
                        <input name="pseudo" class="informations-input" id="pseudo-input" type="text" value=<?= "$user->pseudo" ?> disabled>

                        <svg class="informations-edit-button" id="pseudo-edit" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>

                    </div>
                    <div class="edit-case">
                        <input name="email" class="informations-input" id="email-input" type="text" value=<?= "$user->email" ?> disabled>

                        <svg class="informations-edit-button" id="email-edit" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>

                    </div>
                    <input id="enregistrer" type="submit" value="Enregistrer">
            </form>
        </div>
        <div class="right-side">
            <h2>Historique des quizz Créés/exercés</h2>
            <div class="boite">
                <h3>Nom du quizz super long plein de caractères blabla</h3>
                <h4>Score : 9/10</h4>
            </div>
        </div>
    </div>
    </div>

    <?
    require '../Outils/footer.php';
    ?>
</body>