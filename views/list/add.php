<?php $title = $GLOBALS['lang']['list_add_title'] ?>

<form action="/historia/list/add?lang=<?= $GLOBALS['i18n'] ?>" method="post">
    <fieldset>
        <legend><?= $GLOBALS['lang']['list_add_title'] ?></legend>
        <div>
            <input type="text" name="reference" placeholder="<?= $GLOBALS['lang']['quote'] ?>*" required>
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
            <input type="submit" value="<?= $GLOBALS['lang']['add'] ?>">
        </div>
        <br>
        <div>
            <input type="reset" value="<?= $GLOBALS['lang']['reset'] ?>">
        </div>
    </fieldset>
</form>

<p>*<?= $GLOBALS['lang']['asterisk_1'] ?></p>
