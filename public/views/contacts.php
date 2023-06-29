<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/checkbox.css">
    <link rel="stylesheet" type="text/css" href="public/css/button.css">
    <link rel="stylesheet" type="text/css" href="public/css/text-input.css">
    <link rel="stylesheet" type="text/css" href="public/css/contacts.css">
    <!-- <link rel="stylesheet" type="text/css" href="public/css/header.css"> -->

    <script src="https://kit.fontawesome.com/3ca3187568.js" crossorigin="anonymous"></script>
    <title>Kontakty</title>
</head>
<body>

<div class="base-container">
    <?php include('navbar.php')?>

    <main>
        <?php include('header.php')?>

        <section class="contacts">

            <div class="contact-tile" id="contact-1">
                <img src="public/img/prof.png">
                <div class="contact-info">
                    <h1>Jan Kowalski</h1>
                    <div class="contact-details">
                        <p id="number">500-000-000</p>
                        <p id="email">jkowalski@gmail.com</p>
                        <p id="locality">Kraków, PL</p>
                    </div>
                </div>
            </div>

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

        </section>
    </main>

</div>

</body>

// TODO
WYWALIĆ KONTAKTY, WIADOMOŚCI, POWIADOMIENIA. MOŻE OBSERWOWANE TEŻ.