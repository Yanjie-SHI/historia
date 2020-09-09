<?php

abstract class AbstractController {

    protected function render(string $view, array $data = []): void {
        extract($data);
        ob_start();
        require_once ROOT . 'views/' . str_replace('Controller', '', lcfirst(get_class($this))) . '/' . $view . '.php';
        $body = ob_get_clean();
        require_once ROOT . 'views/layouts/base.php';
    }

    protected function loadModel(string $model): void {
        $model = ucfirst($model) . 'Model';
        require_once ROOT . 'models/' . $model . '.php';
    }

    protected function checkPost(): void {
        $keys = array_keys($_POST);
        foreach ($keys as $key) {
            if (empty($_POST[$key])) {
                http_response_code(400);
                exit;
            }
        }
    }

    protected function isConnected(): bool {
        return !empty($_SESSION);
    }

    protected function initSession(string $mail, string $pseudo, string $ratio, string $jeton): void {
        $_SESSION['mail'] = $mail;
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['ratio'] = $ratio;
        $_SESSION['jeton'] = $jeton;
    }

    protected function updateSession(array $keys): void {
        foreach ($keys as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    protected function deleteTime(array &$demandes): void {
        for ($i = 0; $i < count($demandes); $i++) {
            $datetime = explode(' ', $demandes[$i]['d_datetime_demande']);
            $demandes[$i]['d_datetime_demande'] = $datetime[0];
        }
    }

    protected function regex(string $regex, string $message, array $subjects): void {
        foreach ($subjects as $subject) {
            if (!preg_match($regex, $subject)) {
                echo $message;
                exit;
            }
        }
    }

}
