<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<!DOCTYPE html>
<html>
<head>
    <title>Error</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <h1>Error</h1>
    <p><?= $message ?></p>
    <?php if (isset($trace)): ?>
        <h2>Exception Trace</h2>
        <pre><?= $trace ?></pre>
    <?php endif ?>
</body>
</html>