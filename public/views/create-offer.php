<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/checkbox.css">
    <link rel="stylesheet" type="text/css" href="public/css/button.css">
    <link rel="stylesheet" type="text/css" href="public/css/text-input.css">
    <link rel="stylesheet" type="text/css" href="public/css/create-offer.css">

    <script src="https://kit.fontawesome.com/3ca3187568.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/menuButtons.js" defer></script>
    <script type="text/javascript" src="./public/js/validation.js" defer></script>
    <script type="text/javascript" src="./public/js/create-offer.js" defer></script>
    <title>Create New Offer</title>
</head>
<body>

<div class="base-container">
    <?php include('navbar.php')?>

    <main>
        <?php include('header.php')?>

        <section class="create-offer">
            <form action="create-offer" onsubmit="return validateForm()" method="POST" ENCTYPE="multipart/form-data">
                <div class="messages">
                    <?php
                    if(isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <div class="images">
                    <div class="upload-image">
                        <label id="upload-image-label" for="upload-image"><i class="fa-solid fa-plus"></i></label>
                        <input type="file" id="upload-image" name="photo" accept="image/*" required/>
                    </div>
                </div>

                <div class="basic-info">
                    <h1>Informacje podstawowe</h1>
                    <input name="title" id="title" type="text" placeholder="tytuł" required>
                    <textarea name="desc" id="desc" rows="5" placeholder="opis"></textarea>

                    <div class="sub">
                        <div class="price">
                            <input name="price" id="price" type="number" placeholder="cena" step="0.01" min="0" required>
                        </div>
                        <input name="quantity" id="quantity" type="number" placeholder="ilość" min="0" required>
                    </div>

                </div>

                <div class="delivery">
                    <h1>Sposoby dostawy</h1>
                    <div class="advance-payment">
                        <h2>Przedpłata</h2>

                        <div class="method" id="adv-courier">
                            <h3>Kurier</h3>
                            <input type="number" name="adv-courier" id="adv-courier-input" placeholder="cena" step="0.01" min="0" required>
                        </div>

                        <div class="method" id="adv-inpost">
                            <h3>Paczkomaty InPost</h3>
                            <input type="number" name="adv-inpost" id="adv-inpost-input" placeholder="cena" step="0.01" min="0" required>
                        </div>

                        <div class="method" id="adv-in-person">
                            <h3>Odbiór osobisty</h3>
                            <input type="number" name="adv-in-person" id="adv-in-person-input" placeholder="cena" step="0.01" min="0" required>
                        </div>

                    </div>

                    <div class="payment-on-delivery">
                        <h2>Za pobraniem</h2>

                        <div class="method" id="cod-courier">
                            <h3>Kurier</h3>
                            <input type="number" name="cod-courier" id="cod-courier-input" placeholder="cena" step="0.01" min="0" required>
                        </div>

                        <div class="method" id="cod-in-person">
                            <h3>Odbiór osobisty</h3>
                            <input type="number" name="cod-in-person" id="cod-in-person-input" placeholder="cena" step="0.01" min="0" required>
                        </div>

                    </div>
                </div>

                <div class="address">
                    <h1>Adres odbioru</h1>
                    <select name="voivodeship" id="voivodeship" required>
                        <option value="" hidden>województwo</option>
                        <option value="DS">Dolnośląskie</option>
                        <option value="KP">Kujawsko-Pomorskie</option>
                        <option value="LU">Lubelskie</option>
                        <option value="LB">Lubuskie</option>
                        <option value="LD">Łódzkie</option>
                        <option value="MA">Małopolskie</option>
                        <option value="MZ">Mazowieckie</option>
                        <option value="OP">Opolskie</option>
                        <option value="PK">Podkarpackie</option>
                        <option value="PD">Podlaskie</option>
                        <option value="PM">Pomorskie</option>
                        <option value="SL">Śląskie</option>
                        <option value="SK">Świętokrzyskie</option>
                        <option value="WM">Warmińsko-Mazurskie</option>
                        <option value="WP">Wielkopolskie</option>
                        <option value="ZP">Zachodniopomorskie</option>
                    </select>

                    <div class="locality">
                        <input name="locality" id="locality" type="text" placeholder="miejscowość" required>
                        <input name="postcode" id="postcode" type="tel" placeholder="kod pocztowy" pattern="[0-9]{2}-[0-9]{3}" maxlength="6" required>
                    </div>

                    <input name="street" id="street" type="text" placeholder="ulica" required>

                    <div class="nums">
                        <input name="housenum" id="housenum" type="text" placeholder="numer domu" required>
                        <input name="flatnum" id="flatnum" type="text" placeholder="numer mieszkania">
                    </div>
                </div>
                <div class="buttons">
                    <button type="submit">Utwórz ofertę</button>
                </div>
            </form>
        </section>
    </main>

</div>

</body>