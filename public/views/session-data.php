<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/session-data.css">
    <script type="text/javascript" src="./public/js/redirect.js" defer></script>
</head>

<div class="session-data">
    <div class="userId"><?= $_SESSION['user']->getId(); ?></div>
    <div class="userRoleValue"><?= $_SESSION['user']->roleValue(); ?></div>
</div>