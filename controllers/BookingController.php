<?php

class BookingController extends AbstractController {

    public function index(): void {
        if ($this->isConnected()) {
            $this->loadModel('booking');
            $bookings = BookingModel::readBooking($_SESSION['mail']);
            $this->deleteTime($bookings, 'd_datetime_demande');
            $this->render('index', compact('bookings'));
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

    public function book(string $token): void {
        if ($this->isConnected()) {
            $this->loadModel('sharing');
            $sharing = SharingModel::getSharing($token);
            $this->deleteTime($sharing, 'd_datetime_demande');
            if (empty($sharing)) {
                http_response_code(400);
                exit;
            }
            if (!empty($_POST)) {
                $this->checkPost();
                $this->loadModel('booking');
                BookingModel::addBooking($_SESSION['mail'], $token, date('Y-m-d', strtotime($_POST['date'])));
                header("Location: /historia/booking/list?lang={$GLOBALS['i18n']}");
            } else {
                $this->render('book', compact('sharing'));
            }
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

    public function delete(string $token): void {
        if ($this->isConnected()) {
            $this->loadModel('booking');
            BookingModel::deleteBooking($token);
            header("Location: /historia?lang={$GLOBALS['i18n']}");
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

    public function list(): void {
        if ($this->isConnected()) {
            $this->loadModel('booking');
            $list = BookingModel::list($_SESSION['mail']);
            $this->deleteTime($list, 'd_datetime_demande');
            $this->render('list', compact('list'));
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

    public function search(): void {
        if ($this->isConnected()) {
            $this->loadModel('center');
            $centres = CenterModel::readCenter();
            if (!empty($_POST)) {
                $this->checkPost();
                $this->loadModel('booking');
                $bookings = BookingModel::search($_SESSION['mail'], $_POST['centre']);
                $this->deleteTime($bookings, 'd_datetime_demande');
                $this->render('search', compact('centres', 'bookings'));
            } else {
                $this->render('search', compact('centres'));
            }
        } else {
            header("Location: /historia/user/connect?lang={$GLOBALS['i18n']}");
        }
    }

}
