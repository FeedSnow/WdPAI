<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/checkbox.css">
    <link rel="stylesheet" type="text/css" href="public/css/button.css">
    <link rel="stylesheet" type="text/css" href="public/css/text-input.css">
    <link rel="stylesheet" type="text/css" href="public/css/contacts.css">
    <link rel="stylesheet" type="text/css" href="public/css/empty-page.css">

    <script src="https://kit.fontawesome.com/3ca3187568.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/menuButtons.js" defer></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <title>Kontakty</title>
</head>
<body>
<?php include('session-data.php')?>

<div class="base-container">
    <?php include('navbar.php')?>

    <main>
        <?php include('header.php')?>

        <div class="empty-page">
            <div class="empty-page-background">
                <h1 class="empty-page-info">Brak kontaktów do wyświetlenia</h1>
            </div>
        </div>

        <section class="contacts">

        </section>
    </main>

</div>

</body>

<template id="contact-template">
    <div class="contact-tile" id="contact-1">
        <img src="">
        <div class="contact-info">
            <h1>Name</h1>
            <div class="contact-details">
                <p id="number">Phone</p>
                <p id="email">Email</p>
                <p id="locality">Locality</p>
            </div>
        </div>
    </div>
</template>