<?php
class Model_Admin extends Model {
    public function get_data(): array {
        Lib::safe_session_start();
        if (!$_SESSION["user"]) {
            $_SESSION['message-auth'] = 'Требуется авторизация!';
            http_response_code(401);
            header('Location: /auth');
        }
        if ($_SESSION['user']['role'] != 3) {
            http_response_code(401);
            header('Location: /main');
        }
        $data['user'] = $_SESSION['user'];
        $data['request']['sql1'] = Lib::get_group_list();
        $data['request']['sql2'] = Lib::get_discipline_list();
        $data['request']['sql3'] = Lib::get_classform_list();
        $data['request']['sql4'] = Lib::get_prepod_list();
        $data['request']['sql5'] = Lib::get_student_list();
        return $data;
    }

    public function set_matcher() {
        Lib::safe_session_start();
        if (!$_SESSION["user"]) {
            $_SESSION['message-auth'] = 'Требуется авторизация!';
            http_response_code(401);
            header('Location: /auth');
        }
        if ($_SESSION['user']['role'] != 3) {
            http_response_code(401);
            header('Location: /main');
        }
        if ($_POST) {
            $discipline_id = $_POST['discipline'];
            $group_id = $_POST['group'];
            $prepod_id = $_POST['prepod'];
            $classorm_id = $_POST['classform'];
            $hours_count = $_POST['hours'];
            $mysqli = Lib::get_sql_connection();
            $stmt = $mysqli->prepare("INSERT INTO `matcher` (`discipline`, `group`, `user_id`, `form_id`, `hours_count`) 
                                            VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("iiiii", $discipline_id, $group_id, $prepod_id, $classorm_id, $hours_count);
            $stmt->execute();
        }
        header('Location: /admin');
    }

    public function delete_user() {
        Lib::safe_session_start();
        if (!$_SESSION["user"]) {
            $_SESSION['message-auth'] = 'Требуется авторизация!';
            http_response_code(401);
            header('Location: /auth');
        }
        if ($_SESSION['user']['role'] != 3) {
            http_response_code(401);
            header('Location: /main');
        }
        if ($_POST) {
            $user_id = $_POST['user_id'];
            $mysqli = Lib::get_sql_connection();
            $stmt = $mysqli->prepare("CALL delete_user(?)");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
        }
        header('Location: /admin');
    }
}