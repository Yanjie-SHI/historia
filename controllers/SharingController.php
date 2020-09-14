<?php

class SharingController extends AbstractController {

    public function index(): void {
        if ($this->isConnected()) {
            $this->loadModel('list');
            $archives = ListModel::readArchive($_SESSION['mail'], true);
            $this->loadModel('sharing');
            $sharings = SharingModel::readSharing($_SESSION['mail'], $archives['references']);
            $this->deleteTime($sharings);
            $this->render('index', compact('sharings'));
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

    public function share(string $token): void {
        if ($this->isConnected()) {
            $this->loadModel('sharing');
            $sharing = SharingModel::getSharing($token);
            if (empty($sharing)) {
                http_response_code(400);
                exit;
            }
            if (!empty($_POST)) {
                $this->checkPost();
                $message = 'Votre lien n\'est pas un lien WeTransfer valide';
                $this->regex('/^https:\/\/we.tl\/t-[a-zA-Z0-9]{10}$/', $message, [
                    $_POST['lien']
                ]);
                $this->sendMail($sharing[0], $_POST['lien'], $_POST['nombre_de_pages']);
                SharingModel::doSharing($_SESSION['mail'], $sharing[0]['u_mail'], $sharing[0]['d_jeton'], $_POST['nombre_de_pages']);
                $this->updateSession([
                    'ratio' => $_SESSION['ratio'] + $_POST['nombre_de_pages']
                ]);
                header("Location: /historia?lang={$GLOBALS['i18n']}");
            } else {
                $this->deleteTime($sharing);
                $this->render('share', compact('sharing'));
            }
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

    private function sendMail(array $sharing, string $link, string $number_pages): void {
        $subject = 'Demande satisfaite';
        $body = <<<HTML
                <html>
                    <body>
                        <center>
                            <h1>$subject</h1>
                        </center>
                        <p>Bonjour {$sharing['u_pseudo']},</p>
                        <p>Votre demande pour l'archive <mark>{$sharing['a_reference']}</mark> à <mark>{$sharing['c_nom']}</mark> est satisfaite :</p>
                        <ul>
                            <li>Lien WeTransfer :
                                <a href="$link">$link</a>
                            </li>
                            <li>Nombre de pages : $number_pages</li>
                        </ul>
                        <p>Si ce partage est abusif, vous pouvez le signaler en cliquant sur ce
                            <a href="http://localhost/historia/user/strike/{$_SESSION['jeton']}?lang={$GLOBALS['i18n']}">lien</a>.
                        </p>
                        <p>---------------</p>
                        <p>Ceci est un mail automatique, merci de ne pas y répondre.</p>
                    </body>
                </html>
HTML;
        $message = (new Swift_Message($subject, $body, 'text/html', 'utf-8'))
                ->setFrom(['contact.historia.42@gmail.com' => 'Historia'])
                ->setTo($sharing['u_mail']);
        $smtp_transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
                ->setUsername('contact.historia.42@gmail.com')
                ->setPassword('<Xv74Vu%2w');
        $mailer = new Swift_Mailer($smtp_transport);
        $mailer->send($message);
    }

}
