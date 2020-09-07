<?php

class DemandController extends AbstractController {

    public function index(): void {
        if ($this->isConnected()) {
            $this->loadModel('demand');
            $demandes = DemandModel::readDemand($_SESSION['mail']);
            $this->deleteTime($demandes);
            $this->render('index', compact('demandes'));
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

    public function add(): void {
        if ($this->isConnected()) {
            if ($_SESSION['nb_demandes'] < $_SESSION['nb_offres']) {
                if (!empty($_POST)) {
                    $this->checkPost();
                    if (preg_match('/^[A-Z0-9_]+$/', $_POST['reference'])) {
                        $this->loadModel('demand');
                        if (DemandModel::addDemand($_SESSION['mail'], $_POST['reference'], date('Y-m-d H:i:s'))) {
                            $this->updateSession(['nb_demandes' => $_SESSION['nb_demandes'] + 1]);
                            header("Location: /historia/demand/index?lang={$GLOBALS['i18n']}");
                        } else {
                            echo 'Vous ne pouvez pas déposer plus d\'une demande pour une même archive';
                        }
                    } else {
                        echo 'Seuls les caractères numériques, les lettres majuscules et les underscore sont autorisés pour les références d\'archives';
                    }
                } else {
                    http_response_code(400);
                }
            } else {
                echo 'Votre ratio doit être supérieur à 1 pour pouvoir déposer une demande';
            }
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

    public function delete(string $reference): void {
        if ($this->isConnected()) {
            $this->loadModel('demand');
            if (DemandModel::deleteDemand($_SESSION['mail'], $reference)) {
                $this->updateSession(['nb_demandes' => $_SESSION['nb_demandes'] - 1]);
                header("Location: /historia/demand/index?lang={$GLOBALS['i18n']}");
            } else {
                echo 'Vous ne pouvez pas supprimer cette demande puisque vous ne la possédez pas';
            }
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

}
