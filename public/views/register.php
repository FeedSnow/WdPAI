<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/checkbox.css">
    <link rel="stylesheet" type="text/css" href="public/css/button.css">
    <link rel="stylesheet" type="text/css" href="public/css/text-input.css">
    <link rel="stylesheet" type="text/css" href="public/css/registration-page.css">
    <script type="text/javascript" src="./public/js/validation.js" defer></script>
    <title>REGISTRATION PAGE</title>
</head>
<body>
    
    <div class="container">
        
        <div class="login-container">
            <div class="logo">
                <img src="public/img/logo.svg">
            </div>
            <form class="register" name="register" action="register" onsubmit="return validateForm()" method="POST">
                <div class="messages">
                    <?php
                    if(isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>

                <input name="name" type="text" placeholder="imię">
                <input name="surname" type="text" placeholder="nazwisko">
                <input name="email" type="text" placeholder="adres e-mail">
                <input name="password" type="password" placeholder="hasło">
                <input name="confirm-password" type="password" placeholder="potwierdź hasło">

                <label class="checkbox-container">Akceptuję regulamin serwisu Seedlings
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>

                

                <div class="buttons">
                    <button>Wróć</button>
                    <button type="submit">Utwórz konto</button>
                </div>
            </form>
    
        </div>
    </div>
    
</body>