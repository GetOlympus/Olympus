<?php

/**
 * HTML template to display error.
 *
 * @category   PHP
 * @author     Achraf Chouk <achrafchouk@gmail.com>
 * @license    https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link       https://github.com/GetOlympus/Olympus
 * @since      0.0.39
 */

$getolympus = 'https://github.com/GetOlympus';

return <<<EOT
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-EN" lang="en-EN">
<head>
    <title>$title</title>

    <meta charset="utf-8"/>
    <meta name="robots" content="noindex"/>
    <meta name="generator" content="Olympus"/>

    <style>$css</style>
</head>
<body>
    <div id="olympus-error">
        <h1>$title</h1>
        <p>$message</p>
        <small>
            $type
            <br/>--<br/>
            Please, find more details on the <a href="$getolympus" target="_blank">Olympus framework</a> repository.
        </small>
    </div>
</body>
</html>
EOT;
