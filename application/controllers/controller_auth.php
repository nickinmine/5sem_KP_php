<?php
class Controller_Auth extends Controller {

    function __construct() {
        $this->model = new Model_Auth();
        $this->view = new View();
    }

    public function action_index() {
        $data = $this->model->signin();
        $this->view->generate("auth.php", $data);
    }

    public function action_signout() {
        $this->model->signout();
        $this->view->generate("index.php");
    }

    public function action_recovery() {

    }
}