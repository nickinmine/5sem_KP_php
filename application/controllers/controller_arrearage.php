<?php
class Controller_Arrearage {
    function __construct() {
        $this->model = new Model_Arrearage();
        $this->view = new View();
    }

    public function action_index() {
        $data = $this->model->get_data();
        $this->view->generate("arrearage.php", $data);
    }
}