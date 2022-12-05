<?php
class Controller_Admin {
    function __construct() {
        $this->model = new Model_Admin();
        $this->view = new View();
    }

    public function action_index() {
        $data = $this->model->get_data();
        $this->view->generate("admin.php", $data);
    }

    public function action_setmatcher() {
        $this->model->set_matcher();
    }

    public function action_deleteuser() {
        $this->model->delete_user();
    }
}