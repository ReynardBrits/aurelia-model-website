<?php
$pageTitle = $pageTitle ?? 'Aurelia Model Academy';
$bodyClass = $bodyClass ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="Personal model training for all ages in Joubertina, Eastern Cape."
    >

    <title><?= htmlspecialchars($pageTitle) ?></title>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="<?= htmlspecialchars($bodyClass) ?>">