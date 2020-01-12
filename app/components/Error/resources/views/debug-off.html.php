<?php

/**
 * Layout template file if debug is OFF.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/GetOlympus/Olympus
 * @since    0.0.1
 */

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-EN" lang="en-EN">
<head>
  <title><?php echo $tpl->escape($page_title) ?></title>
  <meta charset="utf-8">
  <meta name="robots" content="noindex">
  <meta name="generator" content="Olympus">
  <style>#olympus-error{background:#fff;margin:100px auto 0;max-width:98%;width:800px}#olympus-error h1{color:#333;font:700 42px/40px sans-serif;margin:30px 0 0}#olympus-error p{color:#333;font:20px/28px Georgia,serif;margin:30px 0 0}#olympus-error code{background:rgba(117,205,69,.3);color:#333;display:inline-block;font:16px/28px monospace;padding:0 10px}#olympus-error small{color:#333;display:block;font:14px/16px Georgia,serif;margin:30px 0 0}a{color:#75cd45}a:hover{color:#5da535}</style>
</head>

<body>
  <div id="olympus-error">
    <h1><?php echo $page_title ?></h1>
    <p>An unexpected error has occurred. Please, try again later by refreshing this page.</p>
    <small>Server error<br/>--<br/>If the error persists, please contact the webmaster.</small>
  </div>
</body>
</html>
