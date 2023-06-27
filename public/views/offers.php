<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/checkbox.css">
    <link rel="stylesheet" type="text/css" href="public/css/button.css">
    <link rel="stylesheet" type="text/css" href="public/css/text-input.css">
    <link rel="stylesheet" type="text/css" href="public/css/offers.css">
    <link rel="stylesheet" type="text/css" href="public/css/navbar.css">
    <!-- <link rel="stylesheet" type="text/css" href="public/css/header.css"> -->

    <script src="https://kit.fontawesome.com/3ca3187568.js" crossorigin="anonymous"></script>
    <title>Offers</title>
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

            <section class="offers">
                <div class="offer-tile" id="offer-1">
                    <img src="public/uploads/<?= $offer->getImage() ?>">
                    <div class="offer-info">
                        <div class="offer-main">
                            <h2><?= $offer->getTitle() ?></h2>
                            <p><?= $offer->getDescription() ?></p>
                        </div>

                        <div class="offer-footer">
                            <h3>Cena</h3>
                            <i class="fa-solid fa-heart"></i>
                        </div>
                    </div>
                </div>
                
                <div class="offer-tile" id="offer-2">
                    <img src="public/img/czarny-bez.png">
                    <div class="offer-info">
                        <div class="offer-main">
                            <h2>Czarny bez</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...</p>
                        </div>

                        <div class="offer-footer">
                            <h3>Cena</h3>
                            <i class="fa-solid fa-heart"></i>
                        </div>
                    </div>
                </div>

                <div class="offer-tile" id="offer-3">
                    <img src="public/img/czarny-bez.png">
                    <div class="offer-info">
                        <div class="offer-main">
                            <h2>Czarny bez</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...</p>
                        </div>

                        <div class="offer-footer">
                            <h3>Cena</h3>
                            <i class="fa-solid fa-heart"></i>
                        </div>
                    </div>
                </div>

                <div class="offer-tile" id="offer-4">
                    <img src="public/img/czarny-bez.png">
                    <div class="offer-info">
                        <div class="offer-main">
                            <h2>Czarny bez</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...</p>
                        </div>

                        <div class="offer-footer">
                            <h3>Cena</h3>
                            <i class="fa-solid fa-heart"></i>
                        </div>
                    </div>
                </div>

                <div class="offer-tile" id="offer-5">
                    <img src="public/img/czarny-bez.png">
                    <div class="offer-info">
                        <div class="offer-main">
                            <h2>Czarny bez</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...</p>
                        </div>

                        <div class="offer-footer">
                            <h3>Cena</h3>
                            <i class="fa-solid fa-heart"></i>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        
    </div>
    
</body>