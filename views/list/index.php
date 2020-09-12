<?php $title = $GLOBALS['lang']['list_index_title'] ?>

<form action="/historia/list/add?lang=<?= $GLOBALS['i18n'] ?>" method="post">
    <fieldset>
        <legend><?= $GLOBALS['lang']['add_archive'] ?></legend>
            <div>
                <input type="text" name="reference" placeholder="<?= $GLOBALS['lang']['reference'] ?>*" required>
            </div>
            <br>
            <div>
                <label for="centre"><?= $GLOBALS['lang']['center'] ?>*</label>
                <select name="centre" id="centre" required>
                <?php foreach ($centres as $centre) : ?>
                    <optgroup label="<?= $centre[0]['c_type'] . ' [' . count($centre) . ']' ?>">
                    <?php foreach ($centre as $value) : ?>
                        <option value="<?= $value['c_identifiant'] ?>"><?= $value['c_nom'] ?></option>
                    <?php endforeach; ?>
                    </optgroup>
                <?php endforeach; ?>
                </select>
            </div>
            <br>
            <div>
                <input type="submit" value="<?= $GLOBALS['lang']['add'] ?>">
            </div>
            <br>
            <div>
                <input type="reset" value="<?= $GLOBALS['lang']['reset'] ?>">
            </div>
    </fieldset>
</form>
<br>

<table>
    <thead>
        <th><?= $GLOBALS['lang']['archive'] ?></th>
        <th><?= $GLOBALS['lang']['center'] ?></th>
        <th><?= $GLOBALS['lang']['delete'] ?></th>
    </thead>
    <tbody>
    <?php foreach ($archives as $archive) : ?>
        <tr>
            <td>
                <center><?= $archive['a_reference'] ?></center>
            </td>
            <td>
            <center>
                <a href="<?= $archive['c_url'] ?>"><?= $archive['c_nom'] ?></a>
            </center>
            </td>
            <td>
                <center>
                    <a href="/historia/list/delete/<?= $archive['p_jeton'] . "?lang={$GLOBALS['i18n']}" ?>">
                        <img src="/historia/public/img/delete.png" alt="<?= $GLOBALS['lang']['delete'] ?>">
                    </a>
                </center>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
        <th><?= $GLOBALS['lang']['archive'] ?></th>
        <th><?= $GLOBALS['lang']['center'] ?></th>
        <th><?= $GLOBALS['lang']['delete'] ?></th>
    </tfoot>
</table>
