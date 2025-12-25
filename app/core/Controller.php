<?php
class Controller {
    protected function view($view, $data = [], $layout = 'student') {
        extract($data);

        ob_start();
        require __DIR__ . '/../../views/' . $view . '.php';

        $content = ob_get_clean();

        // render layout
        require __DIR__ . "/../../views/layouts/$layout.php";
    }
}
