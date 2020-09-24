<?php $title = $GLOBALS['lang']['booking_search_title'] ?>

<form action="/historia/booking/search?lang=<?= $GLOBALS['i18n'] ?>" method="post">
    <fieldset>
        <legend><?= $title ?></legend>
        <div>
            <label for="center"><?= $GLOBALS['lang']['center'] ?>*</label>
            <select name="centre[]" class="selectize" id="center" required multiple>
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
            <input type="submit" value="<?= $GLOBALS['lang']['search'] ?>">
        </div>
        <br>
        <div>
            <input type="reset" value="<?= $GLOBALS['lang']['reset'] ?>">
        </div>
    </fieldset>
</form>

<?php if (isset($bookings)) : ?>

<p><?php printf($GLOBALS['lang']['total'], count($bookings)) ?></p>

<table>
    <thead>
        <tr>
            <th><?= $GLOBALS['lang']['date'] ?></th>
            <th><?= $GLOBALS['lang']['quote'] ?></th>
            <th><?= $GLOBALS['lang']['center'] ?></th>
            <th><?= $GLOBALS['lang']['book'] ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($bookings as $booking) : ?>
        <tr>
            <td>
                <center><?= $booking['d_datetime_demande'] ?></center>
            </td>
            <td>
                <center><?= $booking['a_reference'] ?></center>
            </td>
            <td>
                <center>
                    <a href="<?= $booking['c_url'] ?>"><?= $booking['c_nom'] ?></a>
                </center>
            </td>
            <td>
                <center>
                    <a href="/historia/booking/book/<?= $booking['d_jeton'] . "?lang={$GLOBALS['i18n']}" ?>">
                        <img src="/historia/public/img/book.png" alt="<?= $GLOBALS['lang']['book'] ?>">
                    </a>
                </center>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th><?= $GLOBALS['lang']['date'] ?></th>
            <th><?= $GLOBALS['lang']['quote'] ?></th>
            <th><?= $GLOBALS['lang']['center'] ?></th>
            <th><?= $GLOBALS['lang']['book'] ?></th>
        </tr>
    </tfoot>
</table>

<?php endif; ?>
