<html lang="<?= $GLOBALS['lang']['lang'] ?>">
    <head>
        <meta charset="utf-8">
        <title><?= $title ?></title>
        <link rel="stylesheet" href="/historia/public/css/jquery-ui.min.css">
        <link rel="stylesheet" href="/historia/public/css/base.css">
        <script src="/historia/public/js/jquery-3.5.1.min.js"></script>
        <script src="/historia/public/js/jquery-ui.min.js"></script>
        <script src="/historia/public/js/base.js"></script>
    </head>
    <body>
        <center>
            <form>
                <div class="controlgroup">
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
        <ul id="menu">
            <div>
                <li>
                    <a href="/historia?lang=<?= $GLOBALS['i18n'] ?>"><?= $GLOBALS['lang']['home'] ?></a>
                </li>
            </div>
        <?php if ($this->isConnected()) : ?>
            <div>
                <li>
                    <a href="/historia/list/index?lang=<?= $GLOBALS['i18n'] ?>"><?= $GLOBALS['lang']['list_index_title'] ?></a>
                </li>
            </div>
            <div>
                <li>
                    <a href="/historia/demand/index?lang=<?= $GLOBALS['i18n'] ?>"><?= $GLOBALS['lang']['demand_index_title'] ?></a>
                </li>
            </div>
            <div>
                <li>
                    <a href="/historia/sharing/index?lang=<?= $GLOBALS['i18n'] ?>"><?= $GLOBALS['lang']['sharing_index_title'] ?></a>
                </li>
            </div>
            <div>
                <li>
                    <a href="/historia/user/disconnect?lang=<?= $GLOBALS['i18n'] ?>"><?= $GLOBALS['lang']['logout'] ?></a>
                </li>
            </div>
        <?php else : ?>
            <div>
                <li>
                    <a href="/historia/user/create?lang=<?= $GLOBALS['i18n'] ?>"><?= $GLOBALS['lang']['signin'] ?></a>
                </li>
            </div>
            <div>
                <li>
                    <a href="/historia/user/connect?lang=<?= $GLOBALS['i18n'] ?>"><?= $GLOBALS['lang']['login'] ?></a>
                </li>
            </div>
        <?php endif; ?>
        </ul>
        <center>
            <h1><?= $title ?></h1>
        </center>
        <?= $body ?>
    </body>
</html>
