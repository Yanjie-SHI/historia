<?php

class ListController extends AbstractController {

    public function index(): void {
        if ($this->isConnected()) {
            $this->loadModel('list');
            $this->loadModel('center');
            $archives = ListModel::readArchive($_SESSION['mail']);
            $types = [
                'Communes',
                'Archives départementales',
                'Entreprises',
                'Etablissements hospitaliers et de santé',
                'Institutions, établissements ou associations',
                'Présidence de la République et Ministères',
                'Services à compétence nationale',
                'Organismes liés aux archives ou organismes internationaux',
                'Assemblées parlementaires ou hautes juridictions',
                'Conseils régionaux',
                'Rectorats, universités ou établissements d\\\'enseignement supérieur',
                'Conseillers archives en DRAC',
                'Service interministériel'
            ];
            sort($types);
            $centres = CenterModel::readCenter($types);
            $this->render('index', compact('archives', 'centres'));
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
                    echo 'Impossible d\'ajouter l\'archive, vous la possédez déjà';
                }
            } else {
                http_response_code(400);
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
