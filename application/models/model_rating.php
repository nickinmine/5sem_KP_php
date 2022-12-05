<?php
class Model_Rating extends Model {
    public function get_data(): array {
        Lib::safe_session_start();
        if (!$_SESSION["user"]) {
            $_SESSION['message-auth'] = 'Требуется авторизация!';
            http_response_code(401);
            header('Location: /auth');
        }
        $data['user'] = $_SESSION['user'];

        $mysqli = Lib::get_sql_connection();
        //полученные оценки студента
        $stmt = $mysqli->prepare("
            SELECT
                `kaf`.`name` AS kaf_name, 
                `discipline`.`name` AS discipline_name,
                `user`.`name` AS prepod_name,
                `attestation`.`form` AS attestation_name,
                `rating`.`name` AS rating_name,
                `progress`.`exam_date`
            FROM `kaf`
            JOIN `discipline` ON `kaf`.`kaf_id` = `discipline`.`kaf`
            JOIN `matcher` ON `discipline`.`discipline_id` = `matcher`.`discipline`
            JOIN `progress` ON `matcher`.`matcher_id` = `progress`.`matcher`
            JOIN `user` ON `user`.`user_id` = `matcher`.`user_id`
            JOIN `attestation` ON `discipline`.`attestation` = `attestation`.`attestation_id`
            JOIN `rating` ON `progress`.`rating` = `rating`.`rating_id`
            WHERE `progress`.`student_id` = ?
            ORDER BY `discipline`, `user`.`name`, `exam_date` DESC;");
        $stmt->bind_param("i", $_SESSION['user']['id']);
        $stmt->execute();
        $data['request']['sql1'] = $stmt->get_result();

        //проверка наличия задолженностей
        $stmt = $mysqli->prepare("
            SELECT COUNT(*) AS `count`
            FROM `progress` 
            WHERE `student_id` = ? AND `success` = 0");
        $stmt->bind_param("i", $_SESSION['user']['id']);
        $stmt->execute();
        $data['request']['sql2'] = $stmt->get_result()->fetch_assoc();

        //получение списка задолженностей при наличии
        if ($data['request']['sql2']['count'] > 0) {
            $stmt = $mysqli->prepare("
                SELECT `discipline`.`name` AS `discipline_name`, `exam_date`, `attestation`.`form` AS `attestation_form`
                FROM `progress`
                JOIN `matcher` ON `progress`.`matcher` = `matcher`.`matcher_id`
                JOIN `discipline` ON `matcher`.`discipline` = `discipline`.`discipline_id`
                JOIN `attestation` ON `discipline`.`attestation` = `attestation`.`attestation_id`
                WHERE `student_id` = ? AND `success` = 0");
            $stmt->bind_param("i", $_SESSION['user']['id']);
            $stmt->execute();
            $data['request']['sql3'] = $stmt->get_result();
        }
        return $data;
    }
}