<?php $title = $GLOBALS['lang']['signin'] ?>

<form action="/historia/user/create?lang=<?= $GLOBALS['i18n'] ?>" method="post">
    <fieldset>
        <legend><?= $title ?></legend>
        <div>
            <input type="email" name="mail" placeholder="<?= $GLOBALS['lang']['mail'] ?>*" required autofocus>
        </div>
        <br>
        <div>
            <input type="password" name="mot_de_passe" placeholder="<?= $GLOBALS['lang']['password'] ?>*" required>
        </div>
        <br>
        <div>
            <input type="text" name="pseudo" placeholder="<?= $GLOBALS['lang']['pseudo'] ?>*" required>
        </div>
        <br>
        <div>
            <input type="submit" value="<?= $GLOBALS['lang']['create'] ?>">
        </div>
        <br>
        <div>
            <input type="reset" value="<?= $GLOBALS['lang']['reset'] ?>">
        </div>
    </fieldset>
</form>
