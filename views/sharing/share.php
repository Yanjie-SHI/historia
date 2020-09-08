<?php $title = $GLOBALS['lang']['sharing_share_title'] ?>

<p><?= $GLOBALS['lang']['date'] ?> : <b><?= $sharing[0]['d_datetime_demande'] ?></b></p>
<p><?= $GLOBALS['lang']['archive'] ?> : <b><?= $sharing[0]['d_fk_archive_reference'] ?></b></p>
<p><?= $GLOBALS['lang']['user'] ?> : <b><?= $sharing[0]['u_pseudo'] ?></b></p>

<form action="/historia/sharing/share/<?= $sharing[0]['d_jeton'] . "?lang={$GLOBALS['i18n']}" ?>" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend><?= $GLOBALS['lang']['sharing_index_title'] ?></legend>
        <div class="controlgroup">
            <div>
                <label for="archive"><?= $GLOBALS['lang']['sharing_share_label_1'] ?> : </label>
                <input type="file" id="archive" name="archive" required>
            </div>
            <br>
            <div>
                <input type="submit" value="<?= $GLOBALS['lang']['share'] ?>">
            </div>
            <br>
            <div>
                <input type="reset" value="<?= $GLOBALS['lang']['reset'] ?>">
            </div>
        </div>
    </fieldset>
</form>

<p><?= $GLOBALS['lang']['sharing_share_p_4'] ?></p>

<p><?= $GLOBALS['lang']['sharing_share_p_5'] ?></p>

<p><?= $GLOBALS['lang']['sharing_share_p_6'] ?></p>

<ul>
    <li><?= $GLOBALS['lang']['sharing_share_li_1'] ?></li>
    <li><?= $GLOBALS['lang']['sharing_share_li_2'] ?></li>
    <li><?= $GLOBALS['lang']['sharing_share_li_3'] ?></li>
</ul>
