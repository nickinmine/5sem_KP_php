<?php
class Model_Auth extends Model {
    public function signin(): array {
        Lib::safe_session_start();
        if ($_POST) {
            $login = $_POST['login'];
            $password = Lib::encrypt_password($_POST['password']);
            $mysqli = Lib::get_sql_connection();
            $stmt = $mysqli->prepare("SELECT * FROM `user` WHERE `login` = ? AND `password` = ?");
            $stmt->bind_param("ss", $login, $password);
            $stmt->execute();
            $check = $stmt->get_result();
            if (mysqli_num_rows($check) > 0) {
                $user = $check->fetch_assoc();
                $_SESSION['user'] = [
                    "id" => $user['user_id'],
                    "login" => $user['login'],
                    "name" => $user['name'],
                    "role" => $user['role'],
                    "code" => $user['code'],
                    "kaf" => $user['kaf'],
                    "group" => $user['group'],
                    "email" => $user['email'],
                ];
                header('Location: /main');
            } else {
                header('Location: /auth');
                $_SESSION['message-auth'] = 'Неверный логин или пароль!';
            }
        } else {
            if ($_SESSION["user"]) {
                header('Location: /main');
            }
            $data['message-auth'] = $_SESSION['message-auth'];
            unset($_SESSION['message-auth']);
        }
        return $data;
    }

    public function signout() {
        Lib::safe_session_start();
        Lib::delete_session();
        header('Location: /');
    }
}