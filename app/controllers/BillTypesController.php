<?php
class BillTypesController extends Controller 
{
    public function index()
    {
        $types = BillTypes::getAll();

        $this->view('bill-types',[
            'bill_types' => $types
        ],'admin');
    }
}