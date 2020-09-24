<html lang="<?= $GLOBALS['lang']['lang'] ?>">
    <head>
        <meta charset="utf-8">
        <title><?= $title ?></title>
        <link rel="stylesheet" type="text/css" href="/historia/public/css/jquery-ui.min.css">
        <link rel="stylesheet" type="text/css" href="/historia/public/css/selectize.css">
        <link rel="stylesheet" type="text/css" href="/historia/public/css/base.css">
        <script type="text/javascript" src="/historia/public/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="/historia/public/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/historia/public/js/selectize.min.js"></script>
        <script type="text/javascript" src="/historia/public/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="/historia/public/ckeditor/adapters/jquery.js"></script>
        <script type="text/javascript" src="/historia/public/js/base.js"></script>
    </head>
    <body>
        <center>
            <form>
                <select name="lang" class="selectmenu">
                    <option value="fr" <?php if ($GLOBALS['i18n'] == 'fr') : ?> selected <?php endif; ?> >Français</option>
                    <option value="en" <?php if ($GLOBALS['i18n'] == 'en') : ?> selected <?php endif; ?> >English</option>
                </select>
                <input type="submit" value="<?= $GLOBALS['lang']['translate'] ?>">
            </form>
        </center>
        <?php if ($this->isConnected()) : ?>
            <div style="float: right">
                <p><?= $GLOBALS['lang']['welcome'] . ' <b>' . $_SESSION['pseudo'] . '</b>' ?></p>
                <p><?= $GLOBALS['lang']['ratio'] . ' : <b>' . $_SESSION['ratio'] . '</b> point(s)' ?></p>
            </div>
        <?php endif; ?>
        <ul class="menu">
            <li>
                <div>
                    <a href="/historia?lang=<?= $GLOBALS['i18n'] ?>"><?= $GLOBALS['lang']['home'] ?></a>
                </div>
            </li>
        <?php if ($this->isConnected()) : ?>
            <li>
                <div><?= $GLOBALS['lang']['list_index_title'] ?>
                    <span style="float: right"><b>&gt;</b></span>
                </div>
                <ul>
                    <li>
                        <div>
                            <a href="/historia/list/index?lang=<?= $GLOBALS['i18n'] ?>"><?= $GLOBALS['lang']['list_index_title'] ?></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <a href="/historia/list/add?lang=<?= $GLOBALS['i18n'] ?>"><?=  $GLOBALS['lang']['list_add_title'] ?></a>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <div><?= $GLOBALS['lang']['demand_index_title'] ?>
                    <span style="float: right"><b>&gt;</b></span>
                </div>
                <ul>
                    <li>
                        <div>
                            <a href="/historia/demand/index?lang=<?= $GLOBALS['i18n'] ?>"><?= $GLOBALS['lang']['demand_index_title'] ?></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <a href="/historia/demand/add?lang=<?= $GLOBALS['i18n'] ?>"><?= $GLOBALS['lang']['demand_add_title'] ?></a>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <div><?= $GLOBALS['lang']['book'] . ' / ' . $GLOBALS['lang']['share'] ?>
                    <span style="float: right"><b>&gt;</b></span>
                </div>
                <ul>
                    <li>
                        <div>
                            <a href="/historia/booking/index?lang=<?= $GLOBALS['i18n'] ?>"><?= $GLOBALS['lang']['booking_index_title'] ?></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <a href="/historia/sharing/index?lang=<?= $GLOBALS['i18n'] ?>"><?= $GLOBALS['lang']['sharing_index_title'] ?></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <a href="/historia/booking/list?lang=<?= $GLOBALS['i18n'] ?>"><?= $GLOBALS['lang']['booking_list_title'] ?></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <a href="/historia/booking/search?lang=<?= $GLOBALS['i18n'] ?>"><?= $GLOBALS['lang']['booking_search_title'] ?></a>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <div>
                    <a href="/historia/user/disconnect?lang=<?= $GLOBALS['i18n'] ?>"><?= $GLOBALS['lang']['logout'] ?></a>
                </div>
            </li>
        <?php else : ?>
            <li>
                <div>
                    <a href="/historia/user/create?lang=<?= $GLOBALS['i18n'] ?>"><?= $GLOBALS['lang']['signin'] ?></a>
                </div>
            </li>
            <li>
                <div>
                    <a href="/historia/user/connect?lang=<?= $GLOBALS['i18n'] ?>"><?= $GLOBALS['lang']['login'] ?></a>
                </div>
            </li>
        <?php endif; ?>
        </ul>
        <center>
            <h1><?= $title ?></h1>
        </center>
        <?= $body ?>
    </body>
</html>
