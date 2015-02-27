<?php
session_start();
require_once 'include/recupererDonnees.php';

if (!isset($_POST['reponses'])) {
    // Début de partie
    $_SESSION['indexQuestion'] = 0;
    $_SESSION['nbrePoints'] = 0;
    $_SESSION['questions'] = getQuestion($_POST['nombre'], $_POST['categories']);
    $_SESSION['nbreQuestions'] = count($_SESSION['questions']);
} else {
    if(!array_diff(getReponsesCorrectes($_SESSION['questions'][$_SESSION['indexQuestion']]['id']), $_POST['reponses'])) {
        // Réponse correct = +1 point
        $_SESSION['nbrePoints']++;
    }
    if($_SESSION['indexQuestion'] + 1 < $_SESSION['nbreQuestions']){
        // Question suivante
        $_SESSION['indexQuestion']++;
    } else {
        // Partie terminée
        $score = round(100 / $_SESSION['nbreQuestions'] * $_SESSION['nbrePoints']);

    }

}
$question = $_SESSION['questions'][$_SESSION['indexQuestion']];

require 'include/header.php';
?>
    <?php if(!isset($score)): ?>
    <h2>Question <?= $_SESSION['indexQuestion'] + 1 ?> / <?= $_SESSION['nbreQuestions'] ?></h2>
    <form action="quiz.php" method="post" class="well">
        <h3><?= $question['nom'] ?></h3>
        <div class="checkbox">
            <?php foreach(getReponses($question['id']) as $reponse): ?>
                <label>
                    <input type="checkbox" name="reponses[]" value="<?= $reponse['id'] ?>"> <?= $reponse['nom'] ?>
                </label>
            <?php endforeach; ?>
        </div>
        <button type="submit" class="btn btn-default">Commencer</button>
    </form>
    <?php else: ?>
    <h2>Terminé</h2>
    <div class="well">
        <?php echo $score > 50 ? 'Bravo ! ' : '' ?> Tu as répondu correctement à <?= $_SESSION['nbrePoints'] ?> questions sur <?= $_SESSION['nbreQuestions'] ?>.
        Score : <?= $score ?>%
    </div>
    <?php endif; ?>
<?php
require 'include/footer.php';
?>