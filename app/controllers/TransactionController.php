<?php
class TransactionController extends Controller
{
    public function histories()
    {
        $student = Student::findOneByUser(auth()['id']);
        $transactions = Transaction::getTransactionByStudents($student['id']);

        $this->view('transactions', compact('transactions'), 'student');
    }

    public function indexAdmin()
    {
        $this->view('students-transactions', [
            'transactions' => Transaction::getAll()
        ], 'admin');
    }

    public function approve()
    {
        $transaction_id = $_GET['tx_id'];
        $user_id = auth()['id'];

        $res = Transaction::approving($transaction_id, $user_id);
        if(!$res) {
            $this->error('Gagal mengapprove pembayaran', null, 400);
        }

        $this->success('Berhasil mengapprove pembayaran');
    }

    public function store()
    {
        try {
            // Get student_id from session (sesuaikan dengan sistem auth Anda)
            $student = Student::findOneByUser(auth()['id']);

            if (!$student) {
                return $this->error(
                    'Unauthorized',
                    ['message' => 'Student tidak ditemukan'],
                    401
                );
            }


            // Validasi jumlah pembayaran tidak melebihi sisa tagihan
            $bill = Bill::findOne($_GET['bill_id']);

            if (!$bill) {
                return $this->error(
                    'Tagihan tidak ditemukan',
                    ['message' => 'Bill ID tidak valid'],
                    404
                );
            }

            $totalPaid = Transaction::getTotalPaid($_GET['bill_id'], $student['id']);
            $remainingAmount = $bill['amount'] - $totalPaid;

            if ($_POST['amount'] > $remainingAmount) {
                return $this->error(
                    'Jumlah pembayaran melebihi sisa tagihan',
                    [
                        'message' => 'Jumlah pembayaran (Rp ' . number_format($_POST['amount'], 0, ',', '.') . ') melebihi sisa tagihan (Rp ' . number_format($remainingAmount, 0, ',', '.') . ')',
                        'amount_paid' => $_POST['amount'],
                        'remaining_amount' => $remainingAmount,
                        'total_bill' => $bill['amount']
                    ],
                    422
                );
            }

            if ($remainingAmount <= 0) {
                return $this->error(
                    'Tagihan sudah lunas',
                    ['message' => 'Tagihan ini sudah dibayar penuh'],
                    422
                );
            }

            // Prepare data
            $data = [
                'bill_id' => (int) $_GET['bill_id'],
                'amount' => (int) $_POST['amount'],
                'payment_method' => strtolower($_POST['payment_method']),
                'student_id' => $student['id'],
            ];

            // Upload payment
            $transaction = Transaction::uploadPayment($data);

            if (!$transaction) {
                return $this->error(
                    'Gagal menyimpan pembayaran',
                    ['message' => 'Terjadi kesalahan saat menyimpan data'],
                    500
                );
            }

            return $this->success(
                'Pembayaran berhasil diupload',
                [
                    'transaction' => $transaction
                ],
                201
            );
        } catch (\Exception $e) {
            return $this->error(
                'Terjadi kesalahan',
                [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ],
                500
            );
        }
    }
}
