<div class="login-page">
    <?php
    $msg = AccountController::getResponse();
    if(!empty($msg)){?>
    <div class="alert alert-info alert-dismissable">
        <?php echo $msg;?>
    </div>
    <?php }?>
    <div class="form">
        <form action="<?php echo _URL.'account/register'?>" method="post" class="register-form">
            <input name="username" type="text" placeholder="gebruikersnaam"/>
            <input name="password" type="password" placeholder="wachtwoord"/>
            <input name="password_validated" type="password" placeholder="herhaal wachtwoord"/>
            <button>aanmaken</button>
            <p class="message">Al geregistreerd? <a href="#">Inloggen</a></p>
        </form>
        <form action="<?php echo _URL.'account/login'?>" method="post" class="login-form">
            <input name="username" type="text" placeholder="gebruikersnaam"/>
            <input name="password" type="password" placeholder="wachtwoord"/>
            <button>inloggen</button>
            <p class="message">Nog geen account? <a href="#">Maak een account</a></p>
        </form>
    </div>
</div>