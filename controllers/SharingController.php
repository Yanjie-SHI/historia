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
            if (!empty($_FILES)) {
                $this->checkFiles();
                $this->sendMail($sharing[0]);
                SharingModel::doSharing($_SESSION['mail'], $sharing[0]['d_jeton']);
                // mon_ratio += nb de pages de l'archive
                // son_ratio -= nb de pages de l'archive
                header("Location: /historia?lang={$GLOBALS['i18n']}");
            } else {
                $this->deleteTime($sharing);
                $this->render('share', compact('sharing'));
            }
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

    private function checkFiles(): void {
        if ($_FILES['archive']['error'] != 0) {
            echo 'Une erreur est survenue pendant le chargement de votre archive, veuillez réessayer';
            exit;
        }
        if ($_FILES['archive']['type'] != 'application/pdf') {
            echo 'On n\'accepte que les archives au format .pdf';
            exit;
        }
        if ($_FILES['archive']['size'] > 20_971_520) {
            echo 'Votre archive est trop volumineuse. '
            . 'Veuillez la compresser sur <a href="https://www.ilovepdf.com/fr/compresser_pdf" target="_blank">iLovePDF</a> '
            . 'avec le niveau de compression suffisant pour qu\'elle puisse être chargée';
            exit;
        }
    }

    private function sendMail(array $sharing): void {
        $subject = "[{$sharing['d_fk_archive_reference']}] Demande satisfaite";
        $body = <<<HTML
                <html>
                    <body>
                        <center>
                            <h1>$subject</h1>
                        </center>
                        <p>Bonjour {$sharing['u_pseudo']},</p>
                        <p>Votre demande pour l'archive <b>{$sharing['d_fk_archive_reference']}</b> est satisfaite.</p>
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
                ->setTo($sharing['u_mail'])
                ->attach(Swift_Attachment::fromPath($_FILES['archive']['tmp_name'])
                ->setFilename($_FILES['archive']['name']));
        $smtp_transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
                ->setUsername('contact.historia.42@gmail.com')
                ->setPassword('<Xv74Vu%2w');
        $mailer = new Swift_Mailer($smtp_transport);
        $mailer->send($message);
    }

}
