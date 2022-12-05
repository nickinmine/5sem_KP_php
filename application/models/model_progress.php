<?php
class Model_Progress {
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
        $mysqli = Lib::get_sql_connection();

        if ($_POST) {
            $stmt = $mysqli->prepare("SELECT count(*) AS cnt FROM `progress` WHERE student_id = ? AND `matcher` = ?");
            $stmt->bind_param("ii", $_POST['user_id'], $_GET['matcher']);
            $stmt->execute();
            $res = $stmt->get_result()->fetch_assoc();
            Route::addlog($res['cnt']);
            if ($res['cnt'] == 0) {
                $stmt = $mysqli->prepare("INSERT INTO `progress` (`student_id`, `matcher`, `rating`) VALUES (?, ?, ?)");
                $stmt->bind_param("iii", $_POST['user_id'], $_GET['matcher'], $_POST['rating']);
                $stmt->execute();
            } else {
                $stmt = $mysqli->prepare("SELECT `progress_id` FROM `progress` WHERE student_id = ? AND `matcher` = ? ORDER BY `exam_date` LIMIT 1");
                $stmt->bind_param("ii", $_POST['user_id'], $_GET['matcher']);
                $stmt->execute();
                $result = $stmt->get_result()->fetch_assoc();
                Route::addlog("progressid: " . $result['progress_id']);
                $stmt = $mysqli->prepare("UPDATE `progress` SET `rating` = ? WHERE `progress`.`progress_id` = ?");
                $stmt->bind_param("ii", $_POST['rating'], $result['progress_id']);
                $stmt->execute();
            }
        }

        $stmt = $mysqli->prepare("SELECT `attestation_id`, `form`, g.`group`, d.`name`
                                        FROM `matcher`
                                        JOIN `discipline` d ON `matcher`.`discipline` = d.`discipline_id` 
                                        JOIN `attestation` a ON a.`attestation_id` = d.`attestation` 
                                        JOIN `group` g on g.`group_id` = matcher.`group`
                                        WHERE `discipline_id` = ? AND `group_id` = ?
                                        ");
        $stmt->bind_param("ii", $_GET['discipline'], $_GET['group']);
        $stmt->execute();
        $data['request']['sql1'] = $stmt->get_result()->fetch_assoc();

        $stmt = $mysqli->prepare("SELECT `user`.`user_id`, `user`.`name` FROM `user` WHERE `user`.`group` = ?");
        $stmt->bind_param("i", $_GET['group']);
        $stmt->execute();
        $data['request']['sql2'] = $stmt->get_result();
        $i = 1;
        $exams = array();
        $stmt = $mysqli->prepare("SELECT `exam_date`, `name`, `success`, `rating` FROM `progress` 
                                        JOIN `rating` r ON `progress`.`rating` = r.`rating_id` 
                                        WHERE `student_id` = ? AND `matcher` = ? ORDER BY `exam_date` DESC LIMIT 1");
        foreach ($data['request']['sql2'] as $row) {
            $stmt->bind_param("ii", $row['user_id'], $_GET['matcher']);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            $exams['date'][$i] = $result['exam_date'];
            $exams['result'][$i] = $result['name'];
            $exams['success'][$i] = $result['success'];
            $exams['rating'][$i] = $result['rating'];
            $i++;
        }
        $data['request']['sql3'] = $exams;
        $data['request']['rating'] = Lib::get_rating_list($data['request']['sql1']['attestation_id']);
        return $data;
    }
}