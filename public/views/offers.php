<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/checkbox.css">
    <link rel="stylesheet" type="text/css" href="public/css/button.css">
    <link rel="stylesheet" type="text/css" href="public/css/text-input.css">
    <link rel="stylesheet" type="text/css" href="public/css/offers.css">
    <!-- <link rel="stylesheet" type="text/css" href="public/css/navbar.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="public/css/header.css"> -->

    <script src="https://kit.fontawesome.com/3ca3187568.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <title>Oferty</title>
</head>
<body>
    
    <div class="base-container">

        <?php include('navbar.php')?>

        <main>

            <?php include('header.php')?> <!-- -->

            <section class="offers">
                <?php foreach($offers as $offer): ?>
                    <div class="offer-tile" id="offer-1">
                        <img src="public/uploads/<?= $offer->getImage() ?>">
                        <div class="offer-info">
                            <div class="offer-main">
                                <h2><?= $offer->getTitle() ?></h2>
                                <p><?= $offer->getDescription() ?></p>
                            </div>

                            <div class="offer-footer">
                                <h3><?= (float)$offer->getPrice()/100 ?>zł</h3>
                                <i class="fa-solid fa-heart"></i>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </section>
        </main>
        
    </div>
    
</body>

<template id="offer-template">
    <div class="offer-tile" id="">
        <img src="">
        <div class="offer-info">
            <div class="offer-main">
                <h2>Title</h2>
                <p>Description</p>
            </div>

            <div class="offer-footer">
                <h3>0zł</h3>
                <i class="fa-solid fa-heart"></i>
            </div>
        </div>
    </div>
</template>