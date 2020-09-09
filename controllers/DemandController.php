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
            if ($_SESSION['ratio'] >= 0) {
                if (!empty($_POST)) {
                    $this->checkPost();
                    $message = 'La référence et le centre n\'autorisent que les caractères numériques, les lettres majuscules et les underscore';
                    $this->regex('/^[A-Z0-9_]+$/', $message, [
                        $_POST['reference'],
                        $_POST['centre']
                    ]);
                    $message = 'La description doit faire entre 25 et 255 caractères';
                    $this->regex('/^.{25,255}$/', $message, [
                        $_POST['description']
                    ]);
                    $this->loadModel('demand');
                    if (DemandModel::addDemand($_SESSION['mail'], $_POST['reference'], $_POST['description'], $_POST['centre'], date('Y-m-d H:i:s'))) {
                        header("Location: /historia/demand/index?lang={$GLOBALS['i18n']}");
                    } else {
                        echo 'Vous ne pouvez pas déposer plus d\'une demande pour une même archive';
                    }
                } else {
                    http_response_code(400);
                }
            } else {
                echo 'Votre ratio doit être >= 0 pour pouvoir déposer une demande';
            }
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

    public function delete(string $reference): void {
        if ($this->isConnected()) {
            $this->loadModel('demand');
            if (DemandModel::deleteDemand($_SESSION['mail'], $reference)) {
                header("Location: /historia/demand/index?lang={$GLOBALS['i18n']}");
            } else {
                echo 'Vous ne pouvez pas supprimer cette demande puisque vous ne la possédez pas';
            }
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

}
