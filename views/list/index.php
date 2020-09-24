<?php $title = $GLOBALS['lang']['list_index_title'] ?>

<table>
    <thead>
        <tr>
            <th><?= $GLOBALS['lang']['quote'] ?></th>
            <th><?= $GLOBALS['lang']['center'] ?></th>
            <th><?= $GLOBALS['lang']['delete'] ?></th>
        </tr>
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
        <tr>
            <th><?= $GLOBALS['lang']['quote'] ?></th>
            <th><?= $GLOBALS['lang']['center'] ?></th>
            <th><?= $GLOBALS['lang']['delete'] ?></th>
        </tr>
    </tfoot>
</table>
