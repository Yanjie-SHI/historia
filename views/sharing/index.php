<?php $title = $GLOBALS['lang']['sharing_index_title'] ?>

<p><?php printf($GLOBALS['lang']['total'], count($sharings)) ?></p>

<table>
    <thead>
        <tr>
            <th><?= $GLOBALS['lang']['date'] ?></th>
            <th><?= $GLOBALS['lang']['quote'] ?></th>
            <th><?= $GLOBALS['lang']['center'] ?></th>
            <th><?= $GLOBALS['lang']['share'] ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($sharings as $sharing) : ?>
        <tr>
            <td>
                <center><?= $sharing['d_datetime_demande'] ?></center>
            </td>
            <td>
                <center><?= $sharing['a_reference'] ?></center>
            </td>
            <td>
                <center>
                    <a href="<?= $sharing['c_url'] ?>"><?= $sharing['c_nom'] ?></a>
                </center>
            </td>
            <td>
                <center>
                    <a href="/historia/sharing/share/<?= $sharing['d_jeton'] . "?lang={$GLOBALS['i18n']}" ?>">
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
            <th><?= $GLOBALS['lang']['share'] ?></th>
        </tr>
    </tfoot>
</table>
