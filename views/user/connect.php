<?php $title = $GLOBALS['lang']['login'] ?>

<form action="/historia/user/connect?lang=<?= $GLOBALS['i18n'] ?>" method="post">
    <fieldset>
        <legend><?= $title ?></legend>
        <div class="controlgroup">
            <div>
                <input type="email" name="mail" placeholder="<?= $GLOBALS['lang']['mail'] ?>*" required autofocus>
            </div>
            <br>
            <div>
                <input type="password" name="mot_de_passe" placeholder="<?= $GLOBALS['lang']['password'] ?>*" required>
            </div>
            <br>
            <div>
                <input type="submit" value="<?= $GLOBALS['lang']['login'] ?>">
            </div>
            <br>
            <div>
                <input type="reset" value="<?= $GLOBALS['lang']['reset'] ?>">
            </div>
        </div>
    </fieldset>
</form>
