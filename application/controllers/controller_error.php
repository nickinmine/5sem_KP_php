<?php
class Controller_Error extends Controller {
    public function action_index() {
        $this->view->generate("status_404.php");
    }
}