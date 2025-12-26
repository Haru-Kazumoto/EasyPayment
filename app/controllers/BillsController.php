<?php
class BillsController extends Controller {

    public function index() {
        $this->view('bills', [], 'student');
    }

    public function create() {
        
    }

    public function delete($billId) {
        // Code for deleting a bill
    }

    public function update($billId) {
        // Code for updating a bill
    }

}