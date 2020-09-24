<?php $title = $GLOBALS['lang']['details'] ?>

<table>
    <thead>
        <tr>
            <th><?= $GLOBALS['lang']['date'] ?></th>
            <th><?= $GLOBALS['lang']['quote'] ?></th>
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

<form action="/historia/booking/book/<?= $sharing[0]['d_jeton'] . "?lang={$GLOBALS['i18n']}" ?>" method="post">
    <fieldset>
        <legend><?= $GLOBALS['lang']['booking_index_title'] ?></legend>
        <div>
            <input type="text" name="date" class="datepicker" placeholder="<?= $GLOBALS['lang']['date'] ?>*" required>
        </div>
        <br>
        <div>
            <input type="submit" value="<?= $GLOBALS['lang']['book'] ?>">
        </div>
        <br>
        <div>
            <input type="reset" value="<?= $GLOBALS['lang']['reset'] ?>">
        </div>
    </fieldset>
</form>
