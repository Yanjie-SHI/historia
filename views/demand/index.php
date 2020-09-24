<?php $title = $GLOBALS['lang']['demand_index_title'] ?>

<h2><?= $GLOBALS['lang']['free'] ?></h2>

<table>
    <thead>
        <tr>
            <th><?= $GLOBALS['lang']['date'] ?></th>
            <th><?= $GLOBALS['lang']['quote'] ?></th>
            <th><?= $GLOBALS['lang']['center'] ?></th>
            <th><?= $GLOBALS['lang']['description'] ?>
                <button class="show">
                    <img src="/historia/public/img/show.png" alt="<?= $GLOBALS['lang']['show'] ?>">
                </button>
                <button class="hide">
                    <img src="/historia/public/img/hide.png" alt="<?= $GLOBALS['lang']['hide'] ?>">
                </button>
            </th>
            <th><?= $GLOBALS['lang']['delete'] ?></th>
        </tr>
    </thead>
    <tbody>
    <?php for ($i = 0; $i < count($demandes); $i++) : ?>
        <?php if ($demandes[$i]['d_etat'] == 'L') : ?>
        <tr>
            <td>
                <center><?= $demandes[$i]['d_datetime_demande'] ?></center>
            </td>
            <td>
                <center><?= $demandes[$i]['a_reference'] ?></center>
            </td>
            <td>
                <center>
                    <a href="<?= $demandes[$i]['c_url'] ?>"><?= $demandes[$i]['c_nom'] ?></a>
                </center>
            </td>
            <td>
                <center>
                    <div class="description"><?= $demandes[$i]['d_description'] ?></div>
                </center>
            </td>
            <td>
                <center>
                    <a href="/historia/demand/delete/<?= $demandes[$i]['d_jeton'] . "?lang={$GLOBALS['i18n']}" ?>">
                        <img src="/historia/public/img/delete.png" alt="<?= $GLOBALS['lang']['delete'] ?>">
                    </a>
                </center>
            </td>
        </tr>
        <?php else : break ?>
        <?php endif; ?>
    <?php endfor ?>
    </tbody>
    <tfoot>
        <tr>
            <th><?= $GLOBALS['lang']['date'] ?></th>
            <th><?= $GLOBALS['lang']['quote'] ?></th>
            <th><?= $GLOBALS['lang']['center'] ?></th>
            <th><?= $GLOBALS['lang']['description'] ?>
                <button class="show">
                    <img src="/historia/public/img/show.png" alt="<?= $GLOBALS['lang']['show'] ?>">
                </button>
                <button class="hide">
                    <img src="/historia/public/img/hide.png" alt="<?= $GLOBALS['lang']['hide'] ?>">
                </button>
            </th>
            <th><?= $GLOBALS['lang']['delete'] ?></th>
        </tr>
    </tfoot>
</table>

<h2><?= $GLOBALS['lang']['booked'] ?></h2>

<table>
    <thead>
        <tr>
            <th><?= $GLOBALS['lang']['date'] ?></th>
            <th><?= $GLOBALS['lang']['quote'] ?></th>
            <th><?= $GLOBALS['lang']['center'] ?></th>
            <th><?= $GLOBALS['lang']['description'] ?>
                <button class="show">
                    <img src="/historia/public/img/show.png" alt="<?= $GLOBALS['lang']['show'] ?>">
                </button>
                <button class="hide">
                    <img src="/historia/public/img/hide.png" alt="<?= $GLOBALS['lang']['hide'] ?>">
                </button>
            </th>
            <th><?= $GLOBALS['lang']['deadline'] ?></th>
            <th><?= $GLOBALS['lang']['cancel'] ?></th>
        </tr>
    </thead>
    <tbody>
    <?php for (; $i < count($demandes); $i++) : ?>
        <tr>
            <td>
                <center><?= $demandes[$i]['d_datetime_demande'] ?></center>
            </td>
            <td>
                <center><?= $demandes[$i]['a_reference'] ?></center>
            </td>
            <td>
                <center>
                    <a href="<?= $demandes[$i]['c_url'] ?>"><?= $demandes[$i]['c_nom'] ?></a>
                </center>
            </td>
            <td>
                <center>
                    <div class="description"><?= $demandes[$i]['d_description'] ?></div>
                </center>
            </td>
            <td>
                <center>
                    <?php if (date('Y-m-d') > $demandes[$i]['r_date_reservation']) : ?>
                        <span style="color: red"><?= $demandes[$i]['r_date_reservation'] ?></span>
                    <?php else : ?>
                        <span style="color: green"><?= $demandes[$i]['r_date_reservation'] ?></span>
                    <?php endif; ?>
                </center>
            </td>
            <td>
                <center>
                    <?php if (date('Y-m-d') > $demandes[$i]['r_date_reservation']) : ?>
                         <a href="/historia/booking/delete/<?= $demandes[$i]['d_jeton'] . "?lang={$GLOBALS['i18n']}" ?>">
                             <img src="/historia/public/img/delete.png" alt="<?= $GLOBALS['lang']['delete'] ?>">
                         </a>
                    <?php endif; ?>
                 </center>
            </td>
        </tr>
    <?php endfor; ?>
    </tbody>
    <tfoot>
        <tr>
            <th><?= $GLOBALS['lang']['date'] ?></th>
            <th><?= $GLOBALS['lang']['quote'] ?></th>
            <th><?= $GLOBALS['lang']['center'] ?></th>
            <th><?= $GLOBALS['lang']['description'] ?>
                <button class="show">
                    <img src="/historia/public/img/show.png" alt="<?= $GLOBALS['lang']['show'] ?>">
                </button>
                <button class="hide">
                    <img src="/historia/public/img/hide.png" alt="<?= $GLOBALS['lang']['hide'] ?>">
                </button>
            </th>
            <th><?= $GLOBALS['lang']['deadline'] ?></th>
            <th><?= $GLOBALS['lang']['cancel'] ?></th>
        </tr>
    </tfoot>
</table>
