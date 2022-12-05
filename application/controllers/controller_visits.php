<?php
class Controller_Visits extends Controller {
    function __construct() {
        $this->model = new Model_Visits();
        $this->view = new View();
    }

    public function action_index() {
        $data = $this->model->get_data();
        $this->view->generate("visits.php", $data);
    }
}