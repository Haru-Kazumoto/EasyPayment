<?php
class Controller {
    protected function view($view, $data = []) {
        extract($data);
        require __DIR__ . '/../../views/' . $view . '.php';
    }
}
