<?php

class UserController extends AbstractController {

    public function create(): void {
        if (!$this->isConnected()) {
            if (!empty($_POST)) {
                $this->checkPost();
                $this->loadModel('user');
                $data = UserModel::createUser(
                                $_POST['mail'],
                                password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT, ['cost' => 12]),
                                $_POST['pseudo']
                );
                extract($data);
                $this->render('create');
                if ($number_rows == 1) {
                    $this->sendMail($token);
                    $message = 'La création de votre compte a réussi.<br>'
                            . 'Confirmez-le en cliquant sur le lien contenu dans le mail que vous avez reçu à l\'adresse indiquée pendant l\'inscription';
                    $this->dialog($message);
                } else {
                    $this->dialog('La création de votre compte a échoué');
                }
            } else {
                $this->render('create');
            }
        } else {
            header("Location: /historia?lang={$GLOBALS['i18n']}");
        }
    }

    public function strike(string $token): void {
        if ($this->isConnected()) {
            $this->loadModel('user');
            $user = UserModel::getUser($token);
            if (!empty($user)) {
                UserModel::strikeUser($user[0]);
            } else {
                http_response_code(400);
            }
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

    public function validate(string $token): void {
        $this->loadModel('user');
        $message = UserModel::validateUser($token);
        $this->connect();
        $this->dialog($message);
    }

    public function connect(): void {
        if (!$this->isConnected()) {
            if (!empty($_POST)) {
                $this->checkPost();
                $this->loadModel('user');
                $user = UserModel::connectUser($_POST['mail'], $_POST['mot_de_passe']);
                if (count($user) > 1) {
                    $this->initSession($user['u_mail'], $user['u_pseudo'], $user['u_ratio'], $user['u_jeton']);
                    header("Location: /historia?lang={$GLOBALS['i18n']}");
                } else {
                    $message = $user[0];
                    $this->render('connect');
                    $this->dialog($message);
                }
            } else {
                $this->render('connect');
            }
        } else {
            header("Location: /historia?lang={$GLOBALS['i18n']}");
        }
    }

    public function disconnect(): void {
        $keys = array_keys($_SESSION);
        foreach ($keys as $key) {
            unset($_SESSION[$key]);
        }
        header("Location: /historia?lang={$GLOBALS['i18n']}");
    }

    private function sendMail(string $token): void {
        $subject = 'Confirmation de votre compte';
        $body = <<<HTML
                    <html>
                        <body>
                            <center>
                                <h1>Confirmation de votre compte</h1>
                            </center>
                            <p>Bonjour {$_POST['pseudo']},</p>
                            <p>La création de votre compte est bientôt terminée.</p>
                            <p>Il ne vous reste plus qu'à le confirmer en cliquant sur ce
                                <a href="http://localhost/historia/user/validate/$token?lang={$GLOBALS['i18n']}">lien</a>.
                            </p>
                            <p>---------------</p>
                            <p>Ceci est un mail automatique, merci de ne pas y répondre.</p>
                        </body>
                    </html>
HTML;
        $message = (new Swift_Message($subject, $body, 'text/html', 'utf-8'))
                ->setFrom(['contact.historia.42@gmail.com' => 'Historia'])
                ->setTo($_POST['mail']);
        $smtp_transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
                ->setUsername('contact.historia.42@gmail.com')
                ->setPassword('<Xv74Vu%2w');
        $mailer = new Swift_Mailer($smtp_transport);
        $mailer->send($message);
    }

}
