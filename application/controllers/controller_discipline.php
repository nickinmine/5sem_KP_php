<?php
class Controller_Discipline extends Controller {
    function __construct() {
        $this->model = new Model_Discipline();
        $this->view = new View();
    }

    public function action_index() {
        $data = $this->model->get_data();
        $this->view->generate("discipline.php", $data);
    }
}