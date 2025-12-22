<h2>Tagihan Sekolah</h2>
<table border="1">
    <tr>
        <th>Nama</th>
        <th>Jumlah</th>
        <th>Status</th>
    </tr>
    <?php foreach ($bills as $bill): ?>
        <tr>
            <td><?= htmlspecialchars($bill['name']) ?></td>
            <td>Rp <?= number_format($bill['amount']) ?></td>
            <td><?= $bill['status'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>