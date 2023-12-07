<?
include '../../library/configuration.php';
    $check_pesanan = mysqli_query($op, "SELECT * FROM pesanan WHERE status = 'Menunggu'");
    while($data_pesanan = mysqli_fetch_assoc($check_pesanan)) {
    
        $check_driver = mysqli_query($op, "SELECT telepon,nama FROM users WHERE stay = 'On' AND pesanan IS NULL");
        while($data_driver = mysqli_fetch_assoc($check_driver)) {
            whatsapp($data_driver['telepon'], 'Ada pesanan baru nih, ayo ambil sebelum di ambil yang lain!');
            echo $data_driver['nama'].'<hr>';
        }
    }