<?php
class Model_Attendance extends Model {
    public function get_data(): array {
        Lib::safe_session_start();
        if (!$_SESSION["user"]) {
            $_SESSION['message-auth'] = 'Требуется авторизация!';
            http_response_code(401);
            header('Location: /auth');
        }
        $data['user'] = $_SESSION['user'];
        $mysqli = Lib::get_sql_connection();

        $stmt = $mysqli->prepare("SELECT `date`, `comment` FROM `attendance` WHERE `matcher` = ? GROUP BY `date`, `comment`");
        $stmt->bind_param("i", $_GET['matcher']);
        $stmt->execute();
        $data['request']['sql1'] = $stmt->get_result();

        $stmt = $mysqli->prepare("SELECT `user_id`, `name` FROM `user` WHERE `user`.`group` = ? ORDER BY `name`");
        $stmt->bind_param("i", $_SESSION['user']['group']);
        $stmt->execute();
        $data['request']['sql2'] = $stmt->get_result();

        $stmt = $mysqli->prepare("SELECT `student_id`, `date`, `comment` FROM `attendance` WHERE `matcher` = ? ORDER BY `student_id`");
        $stmt->bind_param("i", $_GET['matcher']);
        $stmt->execute();
        $data['request']['sql3'] = $stmt->get_result();

        return $data;
    }
}