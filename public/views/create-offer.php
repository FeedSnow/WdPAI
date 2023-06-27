<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/checkbox.css">
    <link rel="stylesheet" type="text/css" href="public/css/button.css">
    <link rel="stylesheet" type="text/css" href="public/css/text-input.css">
    <link rel="stylesheet" type="text/css" href="public/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/create-offer.css">
    <!-- <link rel="stylesheet" type="text/css" href="public/css/header.css"> -->

    <script src="https://kit.fontawesome.com/3ca3187568.js" crossorigin="anonymous"></script>
    <title>Create New Offer</title>
</head>
<body>

<div class="base-container">
    <nav>
        <img src="public/img/logo.svg">
        <ul>
            <div class="upper">
                <li>
                    <button>
                        <i class="fa-brands fa-pagelines"></i>
                        <a href="#">Oferty</a>
                    </button>
                </li>
                <li>
                    <button>
                        <i class="fa-solid fa-users"></i>
                        <a href="#">Kontakty</a>
                    </button>
                </li>
                <li>
                    <button>
                        <i class="fa-solid fa-clock"></i>
                        <a href="#">Historia zakupów</a>
                    </button>
                </li>
            </div>
            <div class="lower">
                <li>
                    <button>
                        <i class="fa-solid fa-gear"></i>
                        <a href="#">Ustawienia</a>
                    </button>
                </li>
                <li>
                    <button>
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <a href="#">Wyloguj</a>
                    </button>
                </li>
            </div>
        </ul>
    </nav>

    <main>
        <header>
            <div class="search-bar">
                <form>
                    <input type="text" placeholder="Szukaj ofert">
                </form>
            </div>

            <div class="buttons">
                <div class="left">
                    <button class="short" id="search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <button class="short" id="add-offer">
                        <i class="fa-solid fa-square-plus"></i>
                    </button>
                </div>

                <div class="right">
                    <button class="short" id="messages">
                        <i class="fa-solid fa-comments"></i>
                    </button>
                    <button class="short" id="notifications">
                        <i class="fa-solid fa-bell"></i>
                    </button>
                    <button class="short" id="followed">
                        <i class="fa-solid fa-heart"></i>
                    </button>
                    <button class="short" id="basket">
                        <i class="fa-solid fa-basket-shopping"></i>
                    </button>
                    <button class="short" id="my-account">
                        <i class="fa-solid fa-circle-user"></i>
                    </button>
                </div>
            </div>
        </header>

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
                            <input name="price" type="number" placeholder="cena" required>
                            <label class="checkbox-container">Do negocjacji
                                <input name="negotiable" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <input name="quantity" type="number" placeholder="ilość" required>
                    </div>

                </div>

                <div class="delivery">
                    <h1>Sposoby dostawy</h1>
                    <div class="advance-payment">
                        <h2>Przedpłata</h2>

                        <div class="method" id="ap-courier">
                            <label class="checkbox-container">Kurier
                                <input name="ap-courier" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <input type="number" placeholder="cena" value="13.99" step="0.01" min="0">
                        </div>

                        <div class="method" id="ap-inpost">
                            <label class="checkbox-container">Paczkomaty InPost
                                <input name="ap-inpost" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <input type="number" placeholder="cena" value="9.99" step="0.01" min="0">
                        </div>

                        <div class="method" id="ap-in-person">
                            <label class="checkbox-container">Odbiór osobisty
                                <input name="ap-in-person" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <input type="number" placeholder="cena" value="0.00" step="0.01" min="0">
                        </div>

                    </div>

                    <div class="payment-on-delivery">
                        <h2>Za pobraniem</h2>

                        <div class="method" id="pod-courier">
                            <label class="checkbox-container">Kurier
                                <input name="pod-courier" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <input type="number" placeholder="cena" value="16.99" step="0.01" min="0">
                        </div>

                        <div class="method" id="pod-in-person">
                            <label class="checkbox-container">Odbiór osobisty
                                <input name="pod-in-person" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <input type="number" placeholder="cena" value="0.00" step="0.01" min="0">
                        </div>

                    </div>
                </div>

                <div class="address">
                    <h1>Adres dostawy</h1>
                    <select name="voivodeships" required>
                        <option hidden>województwo</option>
                        <option value="Dolnośląskie">Dolnośląskie</option>
                        <option value="Kujawsko-Pomorskie">Kujawsko-Pomorskie</option>
                        <option value="Lubelskie">Lubelskie</option>
                        <option value="Lubuskie">Lubuskie</option>
                        <option value="Łódzkie">Łódzkie</option>
                        <option value="Małopolskie">Małopolskie</option>
                        <option value="Mazowieckie">Mazowieckie</option>
                        <option value="Opolskie">Opolskie</option>
                        <option value="Podkarpackie">Podkarpackie</option>
                        <option value="Podlaskie">Podlaskie</option>
                        <option value="Pomorskie">Pomorskie</option>
                        <option value="Śląskie">Śląskie</option>
                        <option value="Świętokrzyskie">Świętokrzyskie</option>
                        <option value="Warmińsko-Mazurskie">Warmińsko-Mazurskie</option>
                        <option value="Wielkopolskie">Wielkopolskie</option>
                        <option value="Zachodniopomorskie">Zachodniopomorskie</option>
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