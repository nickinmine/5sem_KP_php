<?php
class Model_Group extends Model {
    public function get_data(): array {
        Lib::safe_session_start();
        if (!$_SESSION["user"]) {
            $_SESSION['message-auth'] = 'Требуется авторизация!';
            http_response_code(401);
            header('Location: /auth');
        }
        $data['user'] = $_SESSION['user'];

        $mysqli = Lib::get_sql_connection();
        if ($_SESSION['user']['role'] == 1) {
            //кол-во студентов в группе
            $stmt = $mysqli->prepare("SELECT COUNT(*) AS `count` FROM `user` WHERE `user`.`group` = ?");
            $stmt->bind_param("i", $_SESSION['user']['group']);
            $stmt->execute();
            $data['request']['sql1'] = $stmt->get_result()->fetch_assoc();

            //список группы
            $stmt = $mysqli->prepare("SELECT `name`, `code`, `group`.`group`, `email` FROM `user` JOIN `group`" .
                "ON `user`.`group` = `group`.`group_id` WHERE `user`.`group` = ? ORDER BY `name`");
            $stmt->bind_param("i", $_SESSION['user']['group']);
            $stmt->execute();
            $data['request']['sql2'] = $stmt->get_result();
        }
        if ($_SESSION['user']['role'] == 2) {
            //кол-во занятий
            $stmt = $mysqli->prepare("SELECT count(*) AS cnt FROM `matcher` WHERE user_id = ?");
            $stmt->bind_param("i", $_SESSION['user']['id']);
            $stmt->execute();
            $data['request']['sql1'] = $stmt->get_result()->fetch_assoc();

            //список групп, закреплённых за преподавателем
            $stmt = $mysqli->prepare("SELECT d.`name` AS `discipline_name`,
                                                   g.`group` AS `group_name`, 
                                                   clf.`name` AS `form_name`,
                                                   `matcher`.`group` AS `group_id`,
                                                   `matcher`.form_id AS `form_id`,
                                                   `matcher`.discipline AS `discipline_id`,
                                                   `matcher_id`
                                            FROM `matcher`
                                            JOIN `discipline` d on `matcher`.`discipline` = d.`discipline_id`
                                            JOIN `group` g ON `matcher`.`group` = g.`group_id`
                                            JOIN `classform` clf ON `matcher`.`form_id` = clf.`form_id`
                                            WHERE `user_id` = ?");
            $stmt->bind_param("i", $_SESSION['user']['id']);
            $stmt->execute();
            $data['request']['sql2'] = $stmt->get_result();
        }

        return $data;
    }

    public function sql2_sort_by_group() {
        Lib::safe_session_start();
        if (!$_SESSION["user"]) {
            $_SESSION['message-auth'] = 'Требуется авторизация!';
            http_response_code(401);
            header('Location: /auth');
        }
        if ($_SESSION['user']['role'] != 2) {
            header('Location: /group');
        }
        $data['user'] = $_SESSION['user'];
        $mysqli = Lib::get_sql_connection();
        //кол-во занятий
        $stmt = $mysqli->prepare("SELECT count(*) AS cnt FROM `matcher` WHERE user_id = ?");
        $stmt->bind_param("i", $_SESSION['user']['id']);
        $stmt->execute();
        $data['request']['sql1'] = $stmt->get_result()->fetch_assoc();

        //список групп, закреплённых за преподавателем
        $stmt = $mysqli->prepare("SELECT d.`name` AS `discipline_name`,
                                                   g.`group` AS `group_name`, 
                                                   clf.`name` AS `form_name`,
                                                   `matcher`.`group` AS `group_id`,
                                                   `matcher`.form_id AS `form_id`,
                                                   `matcher`.discipline AS `discipline_id`,
                                                   `matcher_id`
                                            FROM `matcher`
                                            JOIN `discipline` d on `matcher`.`discipline` = d.`discipline_id`
                                            JOIN `group` g ON `matcher`.`group` = g.`group_id`
                                            JOIN `classform` clf ON `matcher`.`form_id` = clf.`form_id`
                                            WHERE `user_id` = ?
                                            ORDER BY `group_name`");
        $stmt->bind_param("i", $_SESSION['user']['id']);
        $stmt->execute();
        $data['request']['sql2'] = $stmt->get_result();
        return $data;
    }

    public function sql2_sort_by_form() {
        Lib::safe_session_start();
        if (!$_SESSION["user"]) {
            $_SESSION['message-auth'] = 'Требуется авторизация!';
            http_response_code(401);
            header('Location: /auth');
        }
        if ($_SESSION['user']['role'] != 2) {
            header('Location: /group');
        }
        $data['user'] = $_SESSION['user'];
        $mysqli = Lib::get_sql_connection();
        //кол-во занятий
        $stmt = $mysqli->prepare("SELECT count(*) AS cnt FROM `matcher` WHERE user_id = ?");
        $stmt->bind_param("i", $_SESSION['user']['id']);
        $stmt->execute();
        $data['request']['sql1'] = $stmt->get_result()->fetch_assoc();

        //список групп, закреплённых за преподавателем
        $stmt = $mysqli->prepare("SELECT d.`name` AS `discipline_name`,
                                                   g.`group` AS `group_name`, 
                                                   clf.`name` AS `form_name`,
                                                   `matcher`.`group` AS `group_id`,
                                                   `matcher`.form_id AS `form_id`,
                                                   `matcher`.discipline AS `discipline_id`,
                                                   `matcher_id`
                                            FROM `matcher`
                                            JOIN `discipline` d on `matcher`.`discipline` = d.`discipline_id`
                                            JOIN `group` g ON `matcher`.`group` = g.`group_id`
                                            JOIN `classform` clf ON `matcher`.`form_id` = clf.`form_id`
                                            WHERE `user_id` = ?
                                            ORDER BY `form_name`");
        $stmt->bind_param("i", $_SESSION['user']['id']);
        $stmt->execute();
        $data['request']['sql2'] = $stmt->get_result();
        return $data;
    }

    public function sql2_sort_by_discipline() {
        Lib::safe_session_start();
        if (!$_SESSION["user"]) {
            $_SESSION['message-auth'] = 'Требуется авторизация!';
            http_response_code(401);
            header('Location: /auth');
        }
        if ($_SESSION['user']['role'] != 2) {
            header('Location: /group');
        }
        $data['user'] = $_SESSION['user'];
        $mysqli = Lib::get_sql_connection();
        //кол-во занятий
        $stmt = $mysqli->prepare("SELECT count(*) AS cnt FROM `matcher` WHERE user_id = ?");
        $stmt->bind_param("i", $_SESSION['user']['id']);
        $stmt->execute();
        $data['request']['sql1'] = $stmt->get_result()->fetch_assoc();

        //список групп, закреплённых за преподавателем
        $stmt = $mysqli->prepare("SELECT d.`name` AS `discipline_name`,
                                                   g.`group` AS `group_name`, 
                                                   clf.`name` AS `form_name`,
                                                   `matcher`.`group` AS `group_id`,
                                                   `matcher`.form_id AS `form_id`,
                                                   `matcher`.discipline AS `discipline_id`,
                                                   `matcher_id`
                                            FROM `matcher`
                                            JOIN `discipline` d on `matcher`.`discipline` = d.`discipline_id`
                                            JOIN `group` g ON `matcher`.`group` = g.`group_id`
                                            JOIN `classform` clf ON `matcher`.`form_id` = clf.`form_id`
                                            WHERE `user_id` = ?
                                            ORDER BY `discipline_name`");
        $stmt->bind_param("i", $_SESSION['user']['id']);
        $stmt->execute();
        $data['request']['sql2'] = $stmt->get_result();
        return $data;
    }

}