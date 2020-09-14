<?php $title = $GLOBALS['lang']['sharing_share_title'] ?>

<table>
    <thead>
        <tr>
            <th><?= $GLOBALS['lang']['date'] ?></th>
            <th><?= $GLOBALS['lang']['archive'] ?></th>
            <th><?= $GLOBALS['lang']['center'] ?></th>
            <th><?= $GLOBALS['lang']['description'] ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <center><?= $sharing[0]['d_datetime_demande'] ?></center>
            </td>
            <td>
                <center><?= $sharing[0]['a_reference'] ?></center>
            </td>
            <td>
                <center>
                    <a href="<?= $sharing[0]['c_url'] ?>"><?= $sharing[0]['c_nom'] ?></a>
                </center>
            </td>
            <td>
                <center><?= $sharing[0]['d_description'] ?></center>
            </td>
        </tr>
    </tbody>
</table>
<br>

<form action="/historia/sharing/share/<?= $sharing[0]['d_jeton'] . "?lang={$GLOBALS['i18n']}" ?>" method="post">
    <fieldset>
        <legend><?= $GLOBALS['lang']['sharing_index_title'] ?></legend>
        <div>
            <input type="url" name="lien" placeholder="<?= $GLOBALS['lang']['link'] ?>" required>
        </div>
        <br>
        <div>
            <input type="number" name="nombre_de_pages" placeholder="<?= $GLOBALS['lang']['number_pages'] ?>" required>
        </div>
        <br>
        <div>
            <input type="submit" value="<?= $GLOBALS['lang']['share'] ?>*">
        </div>
        <br>
        <div>
            <input type="reset" value="<?= $GLOBALS['lang']['reset'] ?>">
        </div>
    </fieldset>
</form>

<p>*<?= $GLOBALS['lang']['sharing_share_p_1'] ?></p>

<ul>
    <li><?= $GLOBALS['lang']['sharing_share_li_1'] ?></li>
    <li><?= $GLOBALS['lang']['sharing_share_li_2'] ?></li>
    <li><?= $GLOBALS['lang']['sharing_share_li_3'] ?></li>
</ul>
