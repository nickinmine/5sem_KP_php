<?php
class Model_Arrearage extends Model {
    public function get_data(): array {
        Lib::safe_session_start();
        if (!$_SESSION["user"]) {
            $_SESSION['message-auth'] = 'Требуется авторизация!';
            http_response_code(401);
            header('Location: /auth');
        }
        if ($_SESSION['user']['role'] != 2) {
            http_response_code(401);
            header('Location: /main');
        }
        $data['user'] = $_SESSION['user'];

        //поиск должников ФИО, дисциплина, форма, дата
        $mysqli = Lib::get_sql_connection();
        $stmt = $mysqli->prepare("SELECT u.`name` AS `user_name`, 
                                               d.`name` AS `discipline_name`,
                                               a.`form` AS `attestation_name`,
                                               g.`group` AS `group`,
                                               `exam_date`
                                        FROM `matcher` 
                                        JOIN `discipline` d on `matcher`.`discipline` = d.`discipline_id`
                                        JOIN `progress` on `matcher`.`matcher_id` = `progress`.`matcher`
                                        JOIN `user` u on `progress`.`student_id` = u.`user_id` 
                                        JOIN `attestation` a on d.`attestation` = a.`attestation_id`
                                        JOIN `group` g on g.group_id = matcher.`group`
                                        WHERE `matcher`.`user_id` = ? AND `success` = 0");
        $stmt->bind_param("i", $_SESSION['user']['id']);
        $stmt->execute();
        $data['request']['sql1'] = $stmt->get_result();

        return $data;
    }
}