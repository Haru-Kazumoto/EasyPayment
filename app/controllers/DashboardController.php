<?php
class DashboardController extends Controller
{
    public function admin()
    {
        require_auth();

        $this->view('dashboard-admin', [], 'admin');
    }

    public function student()
    {
        require_auth();

        $summary = [
            'total_tagihan'         => Bill::sumAmount()['total'],
            'dibayar'               => Transaction::sumAmount('approved')['total'],
            'pending'               => Transaction::sumAmount('pending')['total'],
            'transaksi_bulan_ini'   => Transaction::monthlyTransaction()['total'],
            'total_pending'         => Transaction::countPending()['total'],
            'total_berhasil'        => Transaction::count()['total']
        ];

        $latest_bills = Bill::getLatest();

        $this->view('dashboard-student', compact('summary', 'latest_bills'), 'student');
    }
}
