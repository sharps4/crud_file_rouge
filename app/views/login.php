<section>
    <form method="POST" action="<?= Router::getRouteURI('login') ?>">
        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password">
        <input type="submit" value="Se connecter">
    </form>
    <?php if ($params['error']): ?>
        <p>Mot de passe incorrect</p>
    <?php endif ?>
</section>