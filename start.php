<?php
    session_start();
    $_SESSION = [];
    require 'include/header.php';
    require_once 'include/recupererDonnees.php';
?>
<h2>Choisissez les catégories</h2>
<form action="quiz.php" method="post">
    <div class="form-group">
        <label>Nombre de questions</label>
        <input type="number" class="form-control" value="10" name="nombre">
    </div>
    <div class="checkbox">
        <?php foreach(getCategories() as $categorie): ?>
        <label>
            <input type="checkbox" name="categories[]" value="<?= $categorie['id'] ?>"> <?= $categorie['nom'] ?>
        </label>
        <?php endforeach; ?>
    </div>
    <button type="submit" class="btn btn-default">Commencer</button>
</form>

<?php
    require 'include/footer.php';
?>