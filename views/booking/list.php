<?php $title = $GLOBALS['lang']['booking_list_title'] ?>

<p><?php printf($GLOBALS['lang']['total'], count($list)) ?></p>

<table>
    <thead>
        <tr>
            <th><?= $GLOBALS['lang']['date'] ?></th>
            <th><?= $GLOBALS['lang']['quote'] ?></th>
            <th><?= $GLOBALS['lang']['center'] ?></th>
            <th><?= $GLOBALS['lang']['deadline'] ?></th>
            <th><?= $GLOBALS['lang']['cancel'] ?></th>
            <th><?= $GLOBALS['lang']['share'] ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($list as $booking) : ?>
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
                    <?php if (date('Y-m-d') < $booking['r_date_reservation']) : ?>
                        <span style="color: green"><?= $booking['r_date_reservation'] ?></span>
                    <?php else : ?>
                        <span style="color: red"><?= $booking['r_date_reservation'] ?></span>
                    <?php endif; ?>
                </center>
            </td>
            <td>
                <center>
                    <a href="/historia/booking/delete/<?= $booking['d_jeton'] . "?lang={$GLOBALS['i18n']}" ?>">
                        <img src="/historia/public/img/delete.png" alt="<?= $GLOBALS['lang']['delete'] ?>">
                    </a>
                </center>
            </td>
            <td>
                <center>
                    <a href="/historia/sharing/share/<?= $booking['d_jeton'] . "?lang={$GLOBALS['i18n']}" ?>">
                        <img src="/historia/public/img/share.png" alt="<?= $GLOBALS['lang']['share'] ?>">
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
            <th><?= $GLOBALS['lang']['deadline'] ?></th>
            <th><?= $GLOBALS['lang']['cancel'] ?></th>
            <th><?= $GLOBALS['lang']['share'] ?></th>
        </tr>
    </tfoot>
</table>
