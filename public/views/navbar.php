<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/navbar.css">
    <script type="text/javascript" src="./public/js/redirect.js" defer></script>
</head>

<nav>
    <img src="public/img/logo.svg">
    <ul>
        <div class="upper">
            <li>
                <button id="offers" onclick="redirect('offers')">
                    <i class="fa-brands fa-pagelines"></i>
                    <a>Oferty</a>
                </button>
            </li>
            <li>
                <button id="contacts" onclick="redirect('contacts')">
                    <i class="fa-solid fa-users"></i>
                    <a>Kontakty</a>
                </button>
            </li>
            <li>
                <button id="history">
                    <i class="fa-solid fa-clock"></i>
                    <a>Historia zakupów</a>
                </button>
            </li>
        </div>
        <div class="lower">
            <li>
                <button id="settings">
                    <i class="fa-solid fa-gear"></i>
                    <a>Ustawienia</a>
                </button>
            </li>
            <li>
                <button id="logout" onclick="redirect('logout')">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <a>Wyloguj</a>
                </button>
            </li>
        </div>
    </ul>
</nav>