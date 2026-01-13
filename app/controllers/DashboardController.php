<?php
class DashboardController extends Controller
{
    public function admin()
    {
        require_auth();

        $summary = [
            'total_siswa' => Student::count()['total'],
            'total_tagihan' => Bill::sumAmount()['total'],
            'total_pemasukan' => Transaction::sumAmount('approved')['total'],
            'total_data_pemasukan' => Transaction::countApproved()['total'],
            'total_data_tagihan' => Bill::count()['total_data']
        ];

        $latest_transactions = Transaction::getAll(5);

        $this->view('dashboard-admin', compact('summary', 'latest_transactions'), 'admin');
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
