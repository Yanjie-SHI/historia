<?php $title = $GLOBALS['lang']['demand_index_title'] ?>

<form action="/historia/demand/add?lang=<?= $GLOBALS['i18n'] ?>" method="post">
    <fieldset>
        <legend><?= $title ?></legend>
        <div>
            <input type="text" name="reference" placeholder="<?= $GLOBALS['lang']['reference'] ?>*" required>
        </div>
        <br>
        <div>
            <label for="center"><?= $GLOBALS['lang']['center'] ?>*</label>
            <select name="centre" class="selectize" id="center" required>
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
            <textarea name="description" cols="100" rows="10" class="wysiwyg" required><?= $GLOBALS['lang']['demand_index_textarea_1'] ?></textarea>
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

<table>
    <thead>
        <tr>
            <th><?= $GLOBALS['lang']['date'] ?></th>
            <th><?= $GLOBALS['lang']['archive'] ?></th>
            <th><?= $GLOBALS['lang']['center'] ?></th>
            <th><?= $GLOBALS['lang']['description'] ?>
                <button class="show"><?= $GLOBALS['lang']['show'] ?></button>
                <button class="hide"><?= $GLOBALS['lang']['hide'] ?></button>
            </th>
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
                <center><?= $demande['a_reference'] ?></center>
            </td>
            <td>
                <center>
                    <a href="<?= $demande['c_url'] ?>"><?= $demande['c_nom'] ?></a>
                </center>
            </td>
            <td>
            <center>
                <div class="description"><?= $demande['d_description'] ?></div>
            </center>
            </td>
            <td>
                <center>
                    <a href="/historia/demand/delete/<?= $demande['d_jeton'] . "?lang={$GLOBALS['i18n']}" ?>">
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
            <th><?= $GLOBALS['lang']['description'] ?>
                <button class="show"><?= $GLOBALS['lang']['show'] ?></button>
                <button class="hide"><?= $GLOBALS['lang']['hide'] ?></button>
            </th>
            <th><?= $GLOBALS['lang']['delete'] ?></th>
        </tr>
    </tfoot>    
</table>
