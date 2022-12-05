<?php
class Model_User extends Model {
    public function get_data(): array {
        Lib::safe_session_start();
        if (!$_SESSION["user"]) {
            $_SESSION['message-auth'] = 'Требуется авторизация!';
            http_response_code(401);
            header('Location: /auth');
        }
        $data['user'] = $_SESSION['user'];
        $data['message-change-login'] = $_SESSION['message-change-login'];
        $data['message-change-password'] = $_SESSION['message-change-password'];
        $data['message-change-email'] = $_SESSION['message-change-email'];
        unset($_SESSION['message-change-login']);
        unset($_SESSION['message-change-password']);
        unset($_SESSION['message-change-email']);

        $mysqli = Lib::get_sql_connection();
        //Информация о группе и профиле
        if ($_SESSION['user']['role'] == 1) {
            $stmt = $mysqli->prepare("SELECT `group`, `spec` FROM `group` WHERE `group_id` = ?");
            $stmt->bind_param("i", $_SESSION['user']['group']);
            $stmt->execute();
            $data['request']['sql1'] = $stmt->get_result()->fetch_assoc();
        }
        if ($_SESSION['user']['role'] == 2) {
            $stmt = $mysqli->prepare("SELECT `name` FROM `kaf` WHERE `kaf_id` = ?");
            $stmt->bind_param("i", $_SESSION['user']['kaf']);
            $stmt->execute();
            $data['request']['sql1'] = $stmt->get_result()->fetch_assoc();
        }

        return $data;
    }

    public function change_login() {
        if ($_POST) {
            Lib::safe_session_start();
            if ($_POST['login'] == $_SESSION['user']['login']) {
                $_SESSION['message-change-login'] = 'Новый логин не может повторять старый логин.';
                header('Location: /user');
                return;
            }
            $mysqli = Lib::get_sql_connection();
            $stmt = $mysqli->prepare("SELECT count(`login`) AS cnt FROM `user` WHERE `login` = ?");
            $stmt->bind_param("s", $_POST['login']);
            $stmt->execute();
            $res = $stmt->get_result()->fetch_assoc();
            if ($res['cnt'] > 0) {
                $_SESSION['message-change-login'] = 'Новый логин не может повторять чужой логин.';
                header('Location: /user');
                return;
            }
            $stmt = $mysqli->prepare("UPDATE `user` SET `login` = ? WHERE `user`.`user_id` = ?");
            $stmt->bind_param("si", $_POST['login'], $_SESSION['user']['id']);
            $stmt->execute();
            $_SESSION['user']['login'] = $_POST['login'];
        }
        header('Location: /user');
    }

    public function change_password() {
        if ($_POST) {
            Lib::safe_session_start();
            if ($_POST['new-password1'] != $_POST['new-password2']) {
                $_SESSION['message-change-password'] = 'Новый пароль не совпадает.';
                header('Location: /user');
                return;
            }
            if ($_POST['new-password1'] == $_POST['old-password']) {
                $_SESSION['message-change-password'] = 'Новый пароль не должен совпадать со старым.';
                header('Location: /user');
                return;
            }
            $mysqli = Lib::get_sql_connection();
            $oldpassword = Lib::encrypt_password($_POST['old-password']);
            $newpassword = Lib::encrypt_password($_POST['new-password1']);
            $stmt = $mysqli->prepare("SELECT count(`password`) AS cnt 
                                            FROM `user` WHERE `login` = ? AND `password` = sha1(md5(?))");
            $stmt->bind_param("ss", $_SESSION['user']['login'], $_POST['old-password']);
            $stmt->execute();
            $res = $stmt->get_result()->fetch_assoc();
            if ($res['cnt'] == 0) {
                $_SESSION['message-change-password'] = 'Неверный пароль.';
                header('Location: /user');
                return;
            }
            $stmt = $mysqli->prepare("UPDATE `user` SET `password` = sha1(md5(?)) WHERE `user_id` = ?");
            $stmt->bind_param("ss", $_POST['new-password1'], $_SESSION['user']['id']);
            $stmt->execute();
        }
        header('Location: /user');
    }

    public function change_email() {
        if ($_POST) {
            Lib::safe_session_start();
            if ($_POST['email'] == $_SESSION['user']['email']) {
                $_SESSION['message-change-email'] = 'Новая почта не может повторять старую.';
                Route::addlog('Новая почта не может повторять старую.');
                header('Location: /user');
                return;
            }
            $mysqli = Lib::get_sql_connection();
            $stmt = $mysqli->prepare("UPDATE `user` SET `email` = ? WHERE `user`.`user_id` = ?");
            $stmt->bind_param("si", $_POST['email'], $_SESSION['user']['id']);
            $stmt->execute();
            $_SESSION['user']['email'] = $_POST['email'];
        }
        header('Location: /user');
    }
}