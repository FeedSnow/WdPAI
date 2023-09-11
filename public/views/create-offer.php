<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/checkbox.css">
    <link rel="stylesheet" type="text/css" href="public/css/button.css">
    <link rel="stylesheet" type="text/css" href="public/css/text-input.css">
    <link rel="stylesheet" type="text/css" href="public/css/create-offer.css">

    <script src="https://kit.fontawesome.com/3ca3187568.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/menuButtons.js" defer></script>
    <script type="text/javascript" src="./public/js/create-offer.js" defer></script>
    <title>Create New Offer</title>
</head>
<body>

<div class="base-container">
    <?php include('navbar.php')?>

    <main>
        <?php include('header.php')?>

        <section class="create-offer">
            <form action="create-offer" method="POST" ENCTYPE="multipart/form-data">
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
                        <input type="file" id="upload-image" name="photo" accept="image/*" />
                    </div>
                </div>

                <div class="basic-info">
                    <h1>Informacje podstawowe</h1>
                    <input name="title" type="text" placeholder="tytuł" required>
                    <textarea name="desc" rows="5" placeholder="opis"></textarea>

                    <div class="sub">
                        <div class="price">
                            <input name="price" type="number" placeholder="cena" step="0.01" min="0" required>
                            <label class="checkbox-container">Do negocjacji
                                <input name="negotiable" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <input name="quantity" type="number" placeholder="ilość" min="0" required>
                    </div>

                </div>

                <div class="delivery">
                    <h1>Sposoby dostawy</h1>
                    <div class="advance-payment">
                        <h2>Przedpłata</h2>

                        <div class="method" id="adv-courier">
                            <label class="checkbox-container">Kurier
                                <input name="adv-courier-check" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <input type="number" name="adv-courier" placeholder="cena" value="13.99" step="0.01" min="0">
                        </div>

                        <div class="method" id="adv-inpost">
                            <label class="checkbox-container">Paczkomaty InPost
                                <input name="adv-inpost-check" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <input type="number" name="adv-inpost" placeholder="cena" value="9.99" step="0.01" min="0">
                        </div>

                        <div class="method" id="adv-in-person">
                            <label class="checkbox-container">Odbiór osobisty
                                <input name="adv-in-person-check" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <input type="number" name="adv-in-person" placeholder="cena" value="0.00" step="0.01" min="0">
                        </div>

                    </div>

                    <div class="payment-on-delivery">
                        <h2>Za pobraniem</h2>

                        <div class="method" id="cod-courier">
                            <label class="checkbox-container">Kurier
                                <input name="cod-courier-check" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <input type="number" name="cod-courier" placeholder="cena" value="16.99" step="0.01" min="0">
                        </div>

                        <div class="method" id="cod-in-person">
                            <label class="checkbox-container">Odbiór osobisty
                                <input name="cod-in-person-check" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <input type="number" name="cod-in-person" placeholder="cena" value="0.00" step="0.01" min="0">
                        </div>

                    </div>
                </div>

                <div class="address">
                    <h1>Adres odbioru</h1>
                    <select name="voivodeship" required>
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
                        <input name="locality" type="text" placeholder="miejscowość" required>
                        <input name="postcode" type="tel" placeholder="kod pocztowy" pattern="[0-9]{2}-[0-9]{3}" maxlength="6" required>
                    </div>

                    <input name="street" type="text" placeholder="ulica" required>

                    <div class="nums">
                        <input name="housenum" type="text" placeholder="numer domu" required>
                        <input name="flatnum" type="text" placeholder="numer mieszkania">
                    </div>
                </div>

                <div class="contact-details">
                    <h1>Dane kontaktowe</h1>
                    <p>(Opcjonalne) Podaj, jeśli chcesz, aby kupujący mógł się z Tobą bezpośrednio skontaktować.</p>
                    <input name="telnum" type="tel" placeholder="numer telefonu">
                    <input name="email" type="email" placeholder="adres e-mail">
                </div>

                <div class="buttons">
                    <button>Anuluj</button>
                    <button type="submit">Utwórz ofertę</button>
                </div>
            </form>
        </section>
    </main>

</div>

</body>