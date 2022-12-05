<?php
class Model_Visits extends Model {
    public function get_data(): array {
        Lib::safe_session_start();
        if (!$_SESSION["user"]) {
            $_SESSION['message-auth'] = 'Требуется авторизация!';
            http_response_code(401);
            header('Location: /auth');
        }
        $data['user'] = $_SESSION['user'];
        $mysqli = Lib::get_sql_connection();
        /*$stmt = $mysqli->prepare("SELECT `attestation_id`, `form`, g.`group`, d.`name`
                                        FROM `matcher`
                                        JOIN `discipline` d ON `matcher`.`discipline` = d.`discipline_id`
                                        JOIN `attestation` a ON a.`attestation_id` = d.`attestation`
                                        JOIN `group` g on g.`group_id` = matcher.`group`
                                        WHERE `discipline_id` = ? AND `group_id` = ?
                                        ");
        $stmt->bind_param("ii", $_GET['discipline'], $_GET['group']);
        $stmt->execute();
        $data['request']['sql1'] = $stmt->get_result()->fetch_assoc();*/

        return $data;
    }
}