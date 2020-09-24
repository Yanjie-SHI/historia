<?php $title = $GLOBALS['lang']['demand_add_title'] ?>

<form action="/historia/demand/add?lang=<?= $GLOBALS['i18n'] ?>" method="post">
    <fieldset>
        <legend><?= $title ?></legend>
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
            <textarea name="description" cols="100" rows="10" class="wysiwyg" required><?= $GLOBALS['lang']['demand_add_textarea_1'] ?></textarea>
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

<p>*<?= $GLOBALS['lang']['asterisk_1'] ?></p>
