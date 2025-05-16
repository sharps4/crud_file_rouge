<?php
    function readJSON(
        string $path
    ) : array
    {
        return file_exists($path) ? (json_decode(file_get_contents($path), true) ?? []) : [];
    }

    function logged() : bool
    {
        session_start();
        return isset($_SESSION['logged']) && $_SESSION['logged'];
    }
?>