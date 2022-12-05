<?php
class Controller_User extends Controller {
    function __construct() {
        $this->model = new Model_User();
        $this->view = new View();
    }

    public function action_index() {
        $data = $this->model->get_data();
        $this->view->generate("user.php", $data);
    }

    public function action_login() {
        $this->model->change_login();
    }

    public function action_password() {
        $this->model->change_password();
    }

    public function action_email() {
        $this->model->change_email();
    }
}