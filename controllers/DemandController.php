<?php

class DemandController extends AbstractController {

    public function index(): void {
        if ($this->isConnected()) {
            $this->loadModel('demand');
            $demandes = DemandModel::readDemand($_SESSION['mail']);
            $this->loadModel('booking');
            for ($i = 0; $i < count($demandes); $i++) {
                if ($demandes[$i]['d_etat'] == 'R') {
                    $booking = BookingModel::getBooking($demandes[$i]['d_jeton']);
                    $demandes[$i]['r_date_reservation'] = $booking[0]['r_date_reservation'];
                }
            }
            $this->deleteTime($demandes, 'd_datetime_demande');
            $this->render('index', compact('demandes'));
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

    public function add(): void {
        if ($this->isConnected()) {
            if ($_SESSION['ratio'] > 0) {
                if (!empty($_POST)) {
                    $this->checkPost();
                    $match = $this->regex('/^.{100,1023}$/s', [
                        $_POST['description']
                    ]);
                    if (!$match) {
                        $this->loadModel('center');
                        $centres = CenterModel::readCenter();
                        $this->render('add', compact('centres'));
                        $this->dialog('La description doit faire entre 100 et 1020 caractères. La vôtre en fait actuellement ' . strlen($_POST['description']));
                        exit;
                    }
                    $this->loadModel('demand');
                    if (DemandModel::addDemand($_SESSION['mail'], $_POST['reference'], $_POST['description'], $_POST['centre'], date('Y-m-d H:i:s'))) {
                        header("Location: /historia/demand/index?lang={$GLOBALS['i18n']}");
                    } else {
                        $this->index();
                        $this->dialog('Vous ne pouvez pas déposer plus d\'une demande pour une même archive');
                    }
                } else {
                    $this->loadModel('center');
                    $centres = CenterModel::readCenter();
                    $this->render('add', compact('centres'));
                }
            } else {
                $this->index();
                $this->dialog('Votre ratio doit être > 0 pour pouvoir déposer une demande');
            }
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

    public function delete(string $jeton): void {
        if ($this->isConnected()) {
            $this->loadModel('demand');
            DemandModel::deleteDemand($jeton);
            header("Location: /historia/demand/index?lang={$GLOBALS['i18n']}");
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

}
