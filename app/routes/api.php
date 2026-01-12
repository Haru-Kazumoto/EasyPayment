<?php

// STUDENTS
Router::api('students/detail', 'StudentController', 'show');
Router::api('students/update', 'StudentController', 'update');

// CLASSES
Router::api('classes/detail', 'ClassesController', 'show');
Router::api('classes/update', 'ClassesController', 'update');

// BILL TYPES
Router::api('bill-types/detail', 'BillTypesController', 'show');
Router::api('bill-types/update', 'BillTypesController', 'update');

// BILL
Router::api('bills/update', 'BillsController', 'update');

// TRANSACTION
Router::api('transaction/upload', 'TransactionController', 'store');
Router::api('transaction/approve', 'TransactionController', 'approve');

// USERS