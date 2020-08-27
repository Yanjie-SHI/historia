<?php $title = $GLOBALS['lang']['demand_index_title'] ?>

<form action="/historia/demand/add?lang=<?= $GLOBALS['i18n'] ?>" method="post">
    <fieldset>
        <legend><?= $title ?></legend>
        <div>
            <input type="text" name="reference" placeholder="<?= $GLOBALS['lang']['reference'] ?>*" required>
        </div>
        <br>
        <div>
            <input type="submit" value="<?= $GLOBALS['lang']['ask'] ?>">
        </div>
        <br>
        <div>
            <input type="reset" value="<?= $GLOBALS['lang']['reset'] ?>">
        </div>
    </fieldset>
</form>
<br>

<table width="100%" border="1px">
    <thead>
        <tr>
            <th><?= $GLOBALS['lang']['date'] ?></th>
            <th><?= $GLOBALS['lang']['archive'] ?></th>
            <th><?= $GLOBALS['lang']['delete'] ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($demandes as $demande) : ?>
        <tr>
            <td>
                <center><?= $demande['d_datetime_demande'] ?></center>
            </td>
            <td>
                <center><?= $demande['d_fk_archive_reference'] ?></center>
            </td>
            <td>
                <center>
                    <a href="/historia/demand/delete/<?= $demande['d_fk_archive_reference'] . "?lang={$GLOBALS['i18n']}" ?>"><?= $GLOBALS['lang']['delete'] ?></a>
                </center>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th><?= $GLOBALS['lang']['date'] ?></th>
            <th><?= $GLOBALS['lang']['archive'] ?></th>
            <th><?= $GLOBALS['lang']['delete'] ?></th>
        </tr>
    </tfoot>    
</table>
