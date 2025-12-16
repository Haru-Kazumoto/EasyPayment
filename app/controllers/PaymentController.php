<?php
class PaymentController extends Controller {
    public function index() {
        require_auth();
        $bills = Bill::getByStudent(auth()['student_id']);
        $this->view('bills', compact('bills'));
    }
}
