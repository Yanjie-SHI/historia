<html lang="<?= $GLOBALS['lang']['lang'] ?>">
    <head>
        <meta charset="utf-8">
        <title><?= $title ?></title>
    </head>
    <body>
        <center>
            <form>
                <div>
                    <select name="lang">
                        <option value="fr" <?php if ($GLOBALS['i18n'] == 'fr') : ?> selected <?php endif; ?> >Français</option>
                        <option value="en" <?php if ($GLOBALS['i18n'] == 'en') : ?> selected <?php endif; ?> >English</option>
                    </select>
                    <input type="submit" value="<?= $GLOBALS['lang']['translate'] ?>">
                </div>
            </form>
        </center>
        <?php if ($this->isConnected()) : ?>
            <div style="float: right">
                <p><?= $GLOBALS['lang']['welcome'] . ' <b>' . $_SESSION['pseudo'] . '</b>' ?></p>
                <p><?= $GLOBALS['lang']['ratio'] . ' : <b>' . round($_SESSION['nb_offres'] / ($_SESSION['nb_demandes'] + 1), 2) . '</b>' ?></p>
            </div>
        <?php endif; ?>
        <div>
            <a href="/historia?lang=<?= $GLOBALS['i18n'] ?>">
                <button><?= $GLOBALS['lang']['home'] ?></button>
            </a>
        </div>
        <br>
        <?php if ($this->isConnected()) : ?>
            <div>
                <a href="/historia/list/index?lang=<?= $GLOBALS['i18n'] ?>">
                    <button><?= $GLOBALS['lang']['list_index_title'] ?></button>
                </a>
            </div>
            <br>
            <div>
                <a href="/historia/demand/index?lang=<?= $GLOBALS['i18n'] ?>">
                    <button><?= $GLOBALS['lang']['demand_index_title'] ?></button>
                </a>
            </div>
            <br>        
            <div>
                <a href="/historia/sharing/index?lang=<?= $GLOBALS['i18n'] ?>">
                    <button><?= $GLOBALS['lang']['sharing_index_title'] ?></button>
                </a>
            </div>
            <br>
            <div>
                <a href="/historia/user/disconnect?lang=<?= $GLOBALS['i18n'] ?>">
                    <button><?= $GLOBALS['lang']['logout'] ?></button>
                </a>
            </div>
        <?php else : ?>
            <div>
                <a href="/historia/user/create?lang=<?= $GLOBALS['i18n'] ?>">
                    <button><?= $GLOBALS['lang']['signin'] ?></button>
                </a>
            </div>
            <br>
            <div>
                <a href="/historia/user/connect?lang=<?= $GLOBALS['i18n'] ?>">
                    <button><?= $GLOBALS['lang']['login'] ?></button>
                </a>
            </div>
        <?php endif; ?>
        <center>
            <h1><?= $title ?></h1>
        </center>
        <?= $body ?>
    </body>
</html>
