<?php
class Controller_Index extends Controller {
    public function action_index() {
        $this->view->generate("index.php");
    }
}