<?php

class ListController extends AbstractController {

    public function index(): void {
        if ($this->isConnected()) {
            $this->loadModel('list');
            $archives = ListModel::readArchive($_SESSION['mail']);
            $this->render('index', compact('archives'));
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

    public function add(): void {
        if ($this->isConnected()) {
            if (!empty($_POST)) {
                $this->checkPost();
                $this->loadModel('list');
                if (ListModel::addArchive($_SESSION['mail'], $_POST['reference'], $_POST['centre'])) {
                    header("Location: /historia/list/index?lang={$GLOBALS['i18n']}");
                } else {
                    $this->index();
                    $this->dialog('Impossible d\'ajouter l\'archive, vous la possédez déjà');
                }
            } else {
                $this->loadModel('center');
                $centres = CenterModel::readCenter();
                $this->render('add', compact('centres'));
            }
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

    public function delete(string $jeton): void {
        if ($this->isConnected()) {
            $this->loadModel('list');
            ListModel::deleteArchive($jeton);
            header("Location: /historia/list/index?lang={$GLOBALS['i18n']}");
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

}
