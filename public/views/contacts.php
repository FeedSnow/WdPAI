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
            <?php foreach($contacts as $contact): ?>
                <div class="contact-tile" id="contact-1">
                    <img src="public/uploads/<?= $contact->getImage(); ?>">
                    <div class="contact-info">
                        <h1><?= $contact->getName(); ?></h1>
                        <div class="contact-details">
                            <p id="number"><?= substr_replace(
                                    substr_replace(
                                            $contact->getPhone(), '-', 6, 0),
                                    '-', 3, 0); ?></p>
                            <p id="email"><?= $contact->getEmail(); ?></p>
                            <p id="locality"><?= $contact->getLocality(); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
<!--
            <div class="contact-tile" id="contact-2">
                <img src="public/img/prof.png">
                <div class="contact-info">
                    <h2>Name</h2>
                    <div class="contact-details">
                        <p id="number">number</p>
                        <p id="email">e-mail</p>
                        <p id="locality">locality</p>
                    </div>
                </div>
            </div>

            <div class="contact-tile" id="contact-3">
                <img src="public/img/prof.png">
                <div class="contact-info">
                    <h2>Name</h2>
                    <div class="contact-details">
                        <p id="number">number</p>
                        <p id="email">e-mail</p>
                        <p id="locality">locality</p>
                    </div>
                </div>
            </div>
-->
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