<?php
if (!isset($systemException)) { return; }
header('HTTP/1.1 500 Internal Server Error'); ?>
<html>
    <head>
        <title>System Error</title>
    </head>
    <body>
        <h1>Error Loading Site</h1>';
        <p><strong>Message:</strong><br /><pre><?php echo $systemException->getMessage(); ?></pre></p>
        <?php if (isset($_GET['debug'])):
            printf('(%s) %s: %s', $systemException->getCode(), $systemException->getFile(), $systemException->getLine());
        ?>
        <pre>
        <?php print_r($systemException->getTraceAsString()); ?>
        </pre>
    <?php endif; ?>
    </body>
</html>