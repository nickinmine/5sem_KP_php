<?php
class Lib {
    private static string $HOSTNAME, $USERNAME, $PASSWORD, $DATABASE;

    function __construct() {
        self::$HOSTNAME = 'localhost';
        self::$USERNAME = 'root';
        self::$PASSWORD = 'root';
        self::$DATABASE = 'univerbase';
    }

    public static function safe_session_start(): void {
        if(!isset($_SESSION)) {
            session_start();
        }
    }

    public static function delete_session(): void {
        self::safe_session_start();
        if (array_key_exists('user', $_SESSION)) {
            unset($_SESSION['user']);
        }
    }

    public static function get_sql_connection(): mysqli {
        (new Lib)->__construct();
        return new mysqli(self::$HOSTNAME, self::$USERNAME, self::$PASSWORD, self::$DATABASE);
    }

    public static function encrypt_password(string $password = null): string {
        return sha1(md5($password));
    }

    public static function get_group_list() {
        self::safe_session_start();
        $mysqli = self::get_sql_connection();
        return $mysqli->query("SELECT `group_id`, `group` FROM `group` ORDER BY `group`");
    }

    public static function get_discipline_list() {
        self::safe_session_start();
        $mysqli = self::get_sql_connection();
        return $mysqli->query("SELECT `discipline_id`, `name` FROM `discipline` ORDER BY `name`");
    }

    public static function get_classform_list() {
        self::safe_session_start();
        $mysqli = self::get_sql_connection();
        return $mysqli->query("SELECT `form_id`, `name` FROM `classform`");
    }

    public static function get_prepod_list() {
        self::safe_session_start();
        $mysqli = self::get_sql_connection();
        return $mysqli->query("SELECT `user_id`, `name` FROM `user` WHERE `role` = 2 ORDER BY `name`");
    }

    public static function get_student_list() {
        self::safe_session_start();
        $mysqli = self::get_sql_connection();
        return $mysqli->query("SELECT `user_id`, `name` FROM `user` WHERE `role` = 1 ORDER BY `name`");
    }

    public static function get_rating_list($attestation_id) {
        self::safe_session_start();
        $mysqli = self::get_sql_connection();
        $stmt = $mysqli->prepare("SELECT `rating_id`, `name` FROM `rating` WHERE `attestation_id` = ?");
        $stmt->bind_param("i", $attestation_id);
        $stmt->execute();

        return $stmt->get_result();
    }
}