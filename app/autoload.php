<?php
    function loadDir(
        string $path
    ) : void
    {
        foreach (scandir($path) as $file)
        {
            if ($file !== '.' && $file !== '..')
            {
                require_once("$path/$file");
            }
        }
    }

    require_once("../app/controllers/Controller.php");
    require_once("../app/models/Model.php");

    loadDir('../app/utils');
    loadDir('../app/controllers');
    loadDir('../app/models');
?>