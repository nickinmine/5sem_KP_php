<?php
class Controller_Attendance extends Controller {
    function __construct() {
        $this->model = new Model_Attendance();
        $this->view = new View();
    }

    public function action_index() {
        $data = $this->model->get_data();
        $this->view->generate("attendance.php", $data);
    }
}