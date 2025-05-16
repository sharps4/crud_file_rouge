<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex">
        <meta name="googlebot" content="noindex">
        <link rel="stylesheet" href="/css/global.css">
        <?php foreach ($params['styles'] as $style): ?>
            <link rel="stylesheet" href="/css/<?= $style ?>.css">
        <?php endforeach ?>
        <title><?= isset($params['title']) ? $params['title'].' - ' : '' ?><?= SITE_NAME ?></title>
    </head>
    <body>
        <header></header>
        <main>
            <?php if (isset($params['main'])): ?>
                <?= $params['main'] ?>
            <?php endif; ?>
        </main>
        <footer></footer>
        <script src="/js/global.js"></script>
        <?php foreach ($params['scripts'] as $script): ?>
            <script src="/js/<?= $script ?>.js"></script>
        <?php endforeach ?>
    </body>
</html>