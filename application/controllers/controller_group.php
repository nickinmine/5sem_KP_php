<?php
class Controller_Group extends Controller {
    function __construct() {
        $this->model = new Model_Group();
        $this->view = new View();
    }

    public function action_index() {
        $data = $this->model->get_data();
        $this->view->generate("group.php", $data);
    }

    public function action_group() {
        $data = $this->model->sql2_sort_by_group();
        $this->view->generate("group.php", $data);
    }

    public function action_form() {
        $data = $this->model->sql2_sort_by_form();
        $this->view->generate("group.php", $data);
    }

    public function action_discipline() {
        $data = $this->model->sql2_sort_by_discipline();
        $this->view->generate("group.php", $data);
    }
}