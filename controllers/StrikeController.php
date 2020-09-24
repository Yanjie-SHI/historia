<?php

class StrikeController extends AbstractController {

    public function index(string $banneur, string $banni, string $strike): void {
        if ($this->isConnected() && $_SESSION['jeton'] == $banneur) {
            $this->loadModel('user');
            $user = UserModel::getUser($banni);
            if (!empty($user)) {
                $this->loadModel('strike');
                StrikeModel::strike($user[0], $strike);
                header("Location: /historia?lang={$GLOBALS['i18n']}");
            } else {
                http_response_code(400);
            }
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

}
