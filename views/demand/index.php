<?php $title = $GLOBALS['lang']['demand_index_title'] ?>

<form action="/historia/demand/add?lang=<?= $GLOBALS['i18n'] ?>" method="post">
    <fieldset>
        <legend><?= $title ?></legend>
        <div class="controlgroup">
            <div>
                <input type="text" name="reference" placeholder="<?= $GLOBALS['lang']['reference'] ?>*" required>
            </div>
            <br>
            <div>
                <input type="text" name="centre" placeholder="<?= $GLOBALS['lang']['center'] ?>*" required>
            </div>
            <br>
            <div>
                <textarea name="description" cols="100" rows="10" required><?= $GLOBALS['lang']['demand_index_textarea_1'] ?></textarea>
            </div>
            <br>
            <div>
                <input type="submit" value="<?= $GLOBALS['lang']['ask'] ?>">
            </div>
            <br>
            <div>
                <input type="reset" value="<?= $GLOBALS['lang']['reset'] ?>">
            </div>
        </div>
    </fieldset>
</form>
<br>

<table>
    <thead>
        <tr>
            <th><?= $GLOBALS['lang']['date'] ?></th>
            <th><?= $GLOBALS['lang']['archive'] ?></th>
            <th><?= $GLOBALS['lang']['center'] ?></th>
            <th><?= $GLOBALS['lang']['description'] ?></th>
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
                <center><?= $demande['d_centre'] ?></center>
            </td>
            <td>
                <center><?= $demande['d_description'] ?></center>
            </td>
            <td>
                <center>
                    <a href="/historia/demand/delete/<?= $demande['d_fk_archive_reference'] . "?lang={$GLOBALS['i18n']}" ?>">
                        <img src="/historia/public/img/delete.png" alt="<?= $GLOBALS['lang']['delete'] ?>">
                    </a>
                </center>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th><?= $GLOBALS['lang']['date'] ?></th>
            <th><?= $GLOBALS['lang']['archive'] ?></th>
            <th><?= $GLOBALS['lang']['center'] ?></th>
            <th><?= $GLOBALS['lang']['description'] ?></th>
            <th><?= $GLOBALS['lang']['delete'] ?></th>
        </tr>
    </tfoot>    
</table>
