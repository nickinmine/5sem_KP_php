<?php
class Model_Discipline extends Model {
    public function get_data(): array {
        Lib::safe_session_start();
        if (!$_SESSION["user"]) {
            $_SESSION['message-auth'] = 'Требуется авторизация!';
            http_response_code(401);
            header('Location: /auth');
        }
        $data['user'] = $_SESSION['user'];

        $mysqli = Lib::get_sql_connection();
        //список дисциплин и преподавателей
        $stmt = $mysqli->prepare("
                    SELECT
                        `kaf`.`name` AS kaf_name,
                        `discipline`.`name` AS discipline_name,
                        `discipline`.`discipline_id` AS discipline_id,
                        `user`.`name` AS prepod_name,
                        `classform`.`name` AS form_name,
                        `classform`.`form_id` AS form_id,
                        `hours_count`,
                        `attestation`.`form` AS attestation_name,
                        `matcher`.`matcher_id`
                    FROM `kaf`
                    JOIN `discipline` ON `kaf`.`kaf_id` = `discipline`.`kaf`
                    JOIN `matcher` ON `discipline`.`discipline_id` = `matcher`.`discipline`
                    JOIN `user` ON `user`.`user_id` = `matcher`.`user_id`
                    JOIN `attestation` ON `discipline`.`attestation` = `attestation`.`attestation_id`
                    JOIN `classform` ON `matcher`.`form_id` = `classform`.`form_id`
                    WHERE `matcher`.`group` = ?
                    ORDER BY `discipline`, `user`.`name`;
                ");
        $stmt->bind_param("i", $_SESSION['user']['group']);
        $stmt->execute();
        $data['request']['sql1'] = $stmt->get_result();

        return $data;
    }
}