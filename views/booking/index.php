<?php $title = $GLOBALS['lang']['booking_index_title'] ?>

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
