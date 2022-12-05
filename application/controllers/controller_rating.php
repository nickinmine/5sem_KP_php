<?php
class Controller_Rating extends Controller {
    function __construct() {
        $this->model = new Model_Rating();
        $this->view = new View();
    }

    public function action_index() {
        $data = $this->model->get_data();
        $this->view->generate("rating.php", $data);
    }
}