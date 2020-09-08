<?php $title = $GLOBALS['lang']['list_index_title'] ?>

<form action="/historia/list/add?lang=<?= $GLOBALS['i18n'] ?>" method="post">
    <fieldset>
        <legend><?= $GLOBALS['lang']['add_archive'] ?></legend>
        <div class="controlgroup">
            <div>
                <input type="text" name="reference" placeholder="<?= $GLOBALS['lang']['reference'] ?>*" required>
            </div>
            <br>
            <div>
                <input type="submit" value="<?= $GLOBALS['lang']['add'] ?>">
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
        <th><?= $GLOBALS['lang']['archive'] ?></th>
        <th><?= $GLOBALS['lang']['delete'] ?></th>
    </thead>
    <tbody>
    <?php foreach ($archives as $archive) : ?>
        <tr>
            <td>
                <center><?= $archive['p_fk_archive_reference'] ?></center>
            </td>
            <td>
                <center>
                    <a href="/historia/list/delete/<?= $archive['p_fk_archive_reference'] . "?lang={$GLOBALS['i18n']}" ?>">
                        <img src="/historia/public/img/delete.png" alt="<?= $GLOBALS['lang']['delete'] ?>">
                    </a>
                </center>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
        <th><?= $GLOBALS['lang']['archive'] ?></th>
        <th><?= $GLOBALS['lang']['delete'] ?></th>
    </tfoot>
</table>
