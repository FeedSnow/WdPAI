<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/checkbox.css">
    <link rel="stylesheet" type="text/css" href="public/css/button.css">
    <link rel="stylesheet" type="text/css" href="public/css/text-input.css">
    <link rel="stylesheet" type="text/css" href="public/css/login-page.css">
    <title>LOGIN PAGE</title>
</head>
<body>
    
    <div class="container">
        
        <div class="login-container">
            <div class="logo">
                <img src="public/img/logo.svg">
            </div>
            <form class="login" action="login" method="POST">
                <div class="messages">
                    <?php
                    if(isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input name="email" type="text" placeholder="adres e-mail">
                <input name="password" type="password" placeholder="hasło">
                
                <label class="checkbox-container">Nie wylogowuj mnie
                    <input name="dont-logout" type="checkbox">
                    <span class="checkmark"></span>
                </label>

                

                <div class="buttons">
                    <button type="submit">Zaloguj</button>
                    <button>Utwórz konto</button>
                </div>
            </form>
    
        </div>
    </div>
    
</body>
