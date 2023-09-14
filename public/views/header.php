<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/header.css">
    <script type="text/javascript" src="./public/js/redirect.js" defer></script>
</head>

<header>
    <div class="search-bar">
        <input type="text" id="search" placeholder="Szukaj">
    </div>

    <div class="buttons">
        <div class="left">
            <button class="short" id="search" onclick="search()">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <button class="short" id="add-offer" onclick="redirect('create-offer')">
                <i class="fa-solid fa-square-plus"></i>
            </button>
        </div>

        <div class="right">
            <button class="short" id="my-account">
                <img src="public/uploads/<?=$_SESSION['user']->getImage()?>">
            </button>
        </div>
    </div>
</header>