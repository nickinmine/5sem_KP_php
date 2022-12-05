<?php
class Controller_Progress extends Controller {
    function __construct() {
        $this->model = new Model_Progress();
        $this->view = new View();
    }

    public function action_index() {
        $data = $this->model->get_data();
        $this->view->generate("progress.php", $data);
    }
}