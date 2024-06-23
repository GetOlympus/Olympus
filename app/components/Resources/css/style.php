<?php

/**
 * Inline CSS to display error.
 *
 * @category   PHP
 * @author     Achraf Chouk <achrafchouk@gmail.com>
 * @license    https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link       https://github.com/GetOlympus/Olympus
 * @since      0.0.39
 */

/**
 * Template copied directly from the Hades-Error-Handler bundle
 * @see https://github.com/GetOlympus/Hades-Error-Handler/tree/master/src/Hades/Resources/views
 */

return <<<EOT
:root{
    --color-main: 31,107,255;
    --color-hover: 191,38,255;
    --color-hover-28: 152,55,255;
    --color-hover-38: 131,64,255;
    --color-hover-61: 91,81,255;
    --color-hover-71: 71,90,255;
}

#olympus-error {
    background: #fff;
    margin: 100px auto 0;
    max-width: 98%;
    width: 800px;
}

#olympus-error h1 {
    color: #333;
    font: 700 42px/40px sans-serif;
    margin: 30px 0 0;
}

#olympus-error p {
    color: #333;
    font: 20px/28px Georgia, serif;
    margin: 30px 0 0;
}

#olympus-error code {
    display: inline-block;
    font: 16px/28px monospace;
    padding: 0 10px;
}
#olympus-error code {
    background: rgba(var(--color-main), .3);
    background: -webkit-linear-gradient(
        to right,
        rgba(var(--color-hover), .3) 0,
        rgba(var(--color-hover-28), .3) 28%,
        rgba(var(--color-hover-38), .3) 38%,
        rgba(var(--color-hover-61), .3) 61%,
        rgba(var(--color-hover-71), .3) 71%,
        rgba(var(--color-main), .3) 100%
    );
    background: linear-gradient(
        to right,
        rgba(var(--color-hover), .3) 0,
        rgba(var(--color-hover-28), .3) 28%,
        rgba(var(--color-hover-38), .3) 38%,
        rgba(var(--color-hover-61), .3) 61%,
        rgba(var(--color-hover-71), .3) 71%,
        rgba(var(--color-main), .3) 100%
    );
}

#olympus-error small {
    color: #333;
    display: block;
    font: 14px/16px Georgia, serif;
    margin: 30px 0 0;
}

a {
    color: rgb(var(--color-main));
}
a: hover{
    color: rgb(var(--color-hover));
}
EOT;
