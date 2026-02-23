<?php
session_start();
require_once 'config.php';
require_once 'includes.php';

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/LOG/login.php');
    exit;
}

// Ambil data user berdasarkan ID di session
$user_id = $_SESSION['user_id'];
$query   = "SELECT * FROM robot80_data_anggota WHERE id=$user_id";
$result  = $mysqli->query($query);
$user    = $result->fetch_assoc();

update_user_activity($user_id);
?>

<?php
require_once('conf/conf.php');

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
date_default_timezone_set("Asia/Bangkok");

$tanggal = mktime(date("m"),date("d"),date("Y"));
$jam     = date("H:i");
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi RS. Asura</title>
    <link href="http://10.10.20.250/dashboard/download.jpeg" rel="icon" type="image/png">
<script src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/GETAR/script-getar.js"></script>

<meta http-equiv="refresh" content="1200;url=logout2.php"/> 


<audio autoplay>
    <source src="http://10.10.20.250/dashboard/APPS-ROBOT/TV/AUDIO/BAYAR2.mp3" type="audio/mpeg">
</audio>




<style>



/* Reset & Global */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}
body {
    background: #f2f4f8;
    width: 100%;
    min-height: 100vh;
    margin: 0;
    padding-bottom: 100px;
}


/* HEADER */
.header {
    background: linear-gradient(135deg,#4e8cff,#6fb1ff);
    padding: 20px;
    color: #fff;
    border-bottom-left-radius: 30px;
    border-bottom-right-radius: 30px;
    position: sticky;
    top: 0;
    z-index: 999;
}
.header-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.header-top div small {
    font-size: 12px;
    display: block;
    margin-bottom: 5px;
}
.icons {
    display: flex;
    gap: 10px;
}
.icon {
    width: 50px;
    height: 50px;
    background: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
.icon img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

/* CARD */
.card {
    background: #fff;
    margin: -30px 20px 20px;
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
.balance-btn {
    margin: 10px 0;
    padding: 10px 15px;
    background: #eef2ff;
    border: none;
    border-radius: 10px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}
.balance-btn:hover {
    background: #d4e0ff;
}
.card-number {
    font-weight: bold;
    letter-spacing: 2px;
    margin-top: 10px;
}
.card-footer {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    color: #777;
    margin-top: 10px;
}

/* MENU GRID */
.menu {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    margin: 20px 10px;
    gap: 15px;
}
.menu-item {
    background: #fff;
    width: 70px;
    height: 70px;
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    font-size: 12px;
    text-align: center;
    cursor: pointer;
    transition: 0.3s;
}
.menu-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}
.menu-item img {
    width: 40px;
    height: 40px;
    margin-bottom: 5px;
}

/* SECTION */
.section {
    padding: 0 20px;
    margin-top: 20px;
}
.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}
.section-header h3 {
    font-size: 16px;
    color: #333;
}
.section-header a {
    color: #4e8cff;
    text-decoration: none;
    font-size: 12px;
}

/* ACTIVITY BOX */
.activity-box, .success-box {
    background: #fff;
    border-radius: 20px;
    padding: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    margin-bottom: 15px;
}
.activity-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}
.activity-item:last-child {
    border-bottom: none;
}
.left {
    display: flex;
    gap: 10px;
    align-items: center;
}
.icon-box {
    width: 45px;
    height: 45px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: bold;
}
.google { background: #ff6a5c; }
.bitcoin { background: #7bc96f; }
.dividend { background: #f5c04f; }

.red { color: #e53935; font-weight: bold; }
.green { color: #43a047; font-weight: bold; }
.blue { color: #4e8cff; font-weight: bold; }

/* SEND MONEY */
.send-money {
    display: flex;
    gap: 15px;
    overflow-x: auto;
    padding-bottom: 10px;
}
.send-item {
    min-width: 70px;
    text-align: center;
    flex-shrink: 0;
}
.send-item img {
    width: 60px;
    height: 60px;
    border-radius: 15px;
    object-fit: cover;
    margin-bottom: 5px;
}

/* BOTTOM NAV */
.bottom-nav {
    position: fixed;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    max-width: 420px;
    width: 100%;
    background: #fff;
    display: flex;
    justify-content: space-around;
    padding: 10px 0;
    border-top-left-radius: 25px;
    border-top-right-radius: 25px;
    box-shadow: 0 -5px 20px rgba(0,0,0,0.1);
}
.nav-item {
    font-size: 12px;
    text-align: center;
}
.home-btn {
    background: #4e8cff;
    width: 55px;
    height: 55px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    margin-top: -30px;
    font-size: 22px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* RESPONSIVE */
@media (max-width: 360px) {
    .menu-item { width: 60px; height: 60px; }
    .send-item img { width: 50px; height: 50px; }
    .card { margin: -30px 10px 20px; padding: 15px; }
}


.scroll-box {
    width: 100%;
    height: 300px;          /* tinggi area tampilan di web kamu */
    overflow: auto;         /* ini bikin bisa geser kanan & bawah */
    border: 1px solid #ddd;
    border-radius: 8px;
    background: #00000008;
}

/* ukuran asli layar antrian */
.scroll-box iframe {
    width: 1200px;   /* lebar dashboard TV biasanya */
    height: 580px;   /* tinggi konten antrian */
    border: none;
}





</style>












</head>

<body>

<!-- HEADER -->
<div class="header">
    <div class="header-top">
        <div>
            <small> <?php
                $waktu = gmdate("H:i", time() + 7 * 3600);
                $t     = explode(":", $waktu);
                $jam   = $t[0];
                $menit = $t[1];

                if ($jam >= 0 && $jam < 10) {
                    $ucapan = "Selamat Pagi";
                } elseif ($jam >= 10 && $jam < 15) {
                    $ucapan = "Selamat Siang";
                } elseif ($jam >= 15 && $jam < 18) {
                    $ucapan = "Selamat Sore";
                } elseif ($jam >= 18 && $jam <= 24) {
                    $ucapan = "Selamat Malam";
                } else {
                    $ucapan = "Jangan Lupa Ibadah";
                }
                echo $ucapan;
                ?>,
                             <p> <span>(<?= $user['nama']; ?>)</span>
            </p>
<p>   <p>&nbsp;</p>
            <!-- Menampilkan Jam (Aktif) -->
            <h5><div id="clock"></div></h2>
            <script>
                function showTime() {
                    var today = new Date(),
                        curr_hour = today.getHours(),
                        curr_minute = today.getMinutes(),
                        curr_second = today.getSeconds(),
                        a_p = (curr_hour < 24) ? "(WIB)" : "(WIB)";

                    if (curr_hour === 0) curr_hour = 24;
                    if (curr_hour > 24) curr_hour -= 24;

                    curr_hour   = checkTime(curr_hour);
                    curr_minute = checkTime(curr_minute);
                    curr_second = checkTime(curr_second);

                    document.getElementById('clock').innerHTML =
                        curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
                }
                function checkTime(i) { return (i < 10) ? "0" + i : i; }
                setInterval(showTime, 500);
            </script>

            <!-- Menampilkan Hari, Bulan dan Tahun -->
            <script>
                var months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                var myDays = ['Minggu','Senin','Selasa','Rabu','Kamis',"Jum&#39;at",'Sabtu'];
                var date = new Date(),
                    day  = date.getDate(),
                    month = months[date.getMonth()],
                    thisDay = myDays[date.getDay()],
                    yy   = date.getYear(),
                    year = (yy < 1000) ? yy + 1900 : yy;

                document.write(thisDay + ', ' + day + ' ' + month + ' ' + year);
            </script>
            <?php $sekarang = date("d-m-Y"); ?></small>
            <h2>Selamat Datang</h2>
        </div>
        <div class="icons">
            <div class="icon"><div id="id2a77ace70026f" a='{"t":"s","v":"1.2","lang":"id","locs":[449],"ssot":"c","sics":"ds","cbkg":"#FFFFFF00","cfnt":"#000000","slis":"45","etp":"bool"}'>Sumber Data Cuaca: <a href="https://cuacalab.id/cuaca_palembang/2_minggu/">https://cuacalab.id/cuaca_palembang/2_minggu/</a></div><script async src="https://static1.cuacalab.id/widgetjs/?id=id2a77ace70026f"></script></div>

<a href="https://10.10.20.250/webapps/presensi/">
            <div class="icon" class="animated infinite swing" ><img src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/SCAN2.png" alt="" class="profile-pic" height="80" width="80" ></div></a>

<a href="<?= $user['alamat']; ?>">
            <div class="icon">  <img src="  <?= $user['alamat']; ?>" alt="" class="profile-pic" height="80" width="80" ><a/></div>
        </div>
    </div>
</div>
<p>   <p>&nbsp;</p>
<p>   <p>&nbsp;</p>
<!-- CARD -->
<div class="card">
    <h4>AI ROBOT SYSTEM V80</h4>
  <a href="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/LOGIN-SALDO-V80/index-dashboard-saldo-github.php">
  <div class="balance-btn">Cek PKWT, SIP & STR</div>
</a>
    <div class="card-number">IP :<?php
// Mengetahui IP Pengunjung
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'IP tidak dikenali';
    return $ipaddress;
}
   
   
// Mengetahui web browser yang digunakan pengunjung
function get_client_browser() {
    $browser = '';
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape'))
        $browser = 'Netscape';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
        $browser = 'Firefox';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))
        $browser = 'Chrome';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
        $browser = 'Opera';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
        $browser = 'Internet Explorer';
    else
        $browser = 'Other';
    return $browser;
}
   echo " ". get_client_ip()."<br>";
   
?></div>
    <div class="card-footer">
        <span>Posisi : <?= $user['posisi']; ?> (<?= $user['username']; ?>)</span>
        <span>Versi. 8.0</span>
    </div>
</div>



<!-- MENU -->
<div class="menu">
<a href="#">
  <div class="menu-item"> <center>  <H3><?php 
											$tgl = Date("Y-m-d ");
											$tes=("select count(no_rawat)  as h from reg_periksa where tgl_registrasi='$tgl'") ;
											$hasil=bukaquery($tes);
											
											while ($data = mysqli_fetch_array ($hasil)){
											$jml= ($data['h']);
										}
										print_r ($jml);
										?> <br>RAJAL</center>  </b></div>
</a>


<a href="#">
  <div class="menu-item"> <center>  <H3><?php 
											
											$tes=("select count(status) as jml from kamar where status = 'ISI'") ;
											$hasil=bukaquery($tes);
											
											while ($data = mysqli_fetch_array ($hasil)){
											$jml= ($data['jml']);
										}
										print_r ($jml);
										?>  <br>RANAP</center>  </b></div>
</a>



    <a href="#">
  <div class="menu-item"> <center>  <H3> <?php 
											$tgl = Date("Y-m-d ");
											$tes=("select count(no_rawat)  as h from periksa_lab where tgl_periksa='$tgl'") ;
											$hasil=bukaquery($tes);
											
											while ($data = mysqli_fetch_array ($hasil)){
											$jml= ($data['h']);
										}
										print_r ($jml);
										?>  <br>LAB</center>  </b></div>
</a>


    <a href="#">
  <div class="menu-item"> <center>  <H3><?php
$tgl = date("Y-m-d ");
$tes = "select count(no_rawat) as h from resep_obat where tgl_perawatan='$tgl'";
$hasil = bukaquery($tes);
while ($data = mysqli_fetch_array($hasil)) {
    $jml = $data['h'];
}
print_r($jml);
?> <br>FARMASI</center>  </b></div>
</a>


</div>






<!-- MENU -->
<div class="menu">
<a href="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/OBAT-STOK/index-harga-obat.php">
  <div class="menu-item"><img src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/TARIF2.webp" alt="" class="profile-pic" height="40" width="40" ><h2><b><br>Obat</div></b></h3>
</a>
<a href="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/SCAN/RALAN-NEW/">
  <div class="menu-item"><img src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/TARIF2.webp" alt="" class="profile-pic" height="40" width="40" ><h2><b><br>Tindakan</div></b></h3>
</a>
    <a href="http://10.10.20.250/dashboard/APPS-ROBOT/aplikasi-ranap2.php">
  <div class="menu-item"><img src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/TARIF2.webp" alt="" class="profile-pic" height="40" width="40" ><h2><b><br>Kamar</div></b></h3>
</a>
    <a href="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/pintasan.php">
  <div class="menu-item"><img src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/PINTASAN4.webp" alt="" class="profile-pic" height="40" width="40" ><h2><b><br>Pintasan</div></b></h3>
</a>
</div>

<p>   <p>&nbsp;</p>

<!-- RECENT ACTIVITY -->
<div class="section">
    <div class="section-header">
        <h3>Fitur Baru</h3>
    
    </div>


<a href="http://10.10.20.250/dashboard/ROBOT-BANK">
    <div class="activity-box">
        <div class="activity-item">
            <div class="left">
                <div class="icon-box google">A</div>
                <div>
                    <b>TABUNGAN KARYAWAN</b><br>
                    <small>Transfer Gratis</small>
                </div>
            </div>
            <div class="red">BARU<br><small>Update</small></div>
        </div></a>


<a href="http://10.10.20.250/dashboard/ROBOT-DISPLAY">
        <div class="activity-item">
            <div class="left">
                <div class="icon-box bitcoin">B</div>
                <div>
                    <b>DISPLAY ANTRIAN</b><br>
                    <small>Kecangihan AI</small>
                </div>
            </div>
            <div class="blue">BARU<br><small>Update</small></div>
        </div></a>


<a href="http://10.10.20.250/dashboard/ROBOT-DOWNLOAD">
        <div class="activity-item">
            <div class="left">
                <div class="icon-box dividend">C</div>
                <div>
                    <b>DOWNLOAD</b><br>
                    <small>Maintetance & Karyawan</small>
                </div>
            </div>
            <div class="green">BARU<br><small>Update</small></div>
        </div></a>



    </div>
</div>




<!-- ACCOUNT ACTIVITY -->
<div class="section">
    <div class="section-header">
        <h3>Pemberitahuan Jadwal Sholat</h3>
       
    </div>
    <div class="success-box">
        <b><iframe src="http://10.10.20.250/dashboard/APPS-ROBOT/TV/MASTER/sholat2.php" class="snapwidget-widget" allowtransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:220px; height:110px" title="Klinik Asura"></iframe></b>
      
    </div>
</div>







<!-- ACCOUNT ACTIVITY -->
<div class="section">
    <div class="section-header">
        <h3>Pemberitahuan Obat Kadaluarsa</h3>
    
    </div>
    <div class="success-box">
        <b><?php
			include "koneksi.php";
			$sekarang	=date("d-m-Y");
		?>

<font color="black"><h8><?php
// 1. Dapatkan tanggal dari input pengguna (misalnya dari form) atau gunakan tanggal saat ini
$tanggal_input = isset($_GET['expire']) ? $_GET['expire'] : date("Y-m-d");

// 2. Hubungkan ke database (contoh menggunakan MySQLi)
$host = "10.10.20.250";
$username = "root";
$password = "";
$database = "sikdraisyah";

$koneksi = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// 3. Bangun query SQL dengan klausa WHERE
$query = "SELECT * FROM databarang WHERE expire = '$tanggal_input'";

// Contoh lain dengan BETWEEN:
// $query = "SELECT * FROM nama_tabel WHERE tanggal_kolom BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";

// 4. Eksekusi query
$hasil = $koneksi->query($query);

// 5. Tampilkan hasil (contoh sederhana)
if ($hasil->num_rows > 0) {
    while($row = $hasil->fetch_assoc()) {
        echo "Notifikasi Obat Kadaluarsa   " . " ( " . $row["nama_brng"].  " - Tanggal : " . $row["expire"]." )   " .   " <p> " ."<br>";
    }
} else {
    echo "Horee.... Tidak Ada Obat Kadaluarsa.";
}

// Tutup koneksi
$koneksi->close();
?></b></font>
     
    </div>
</div>


<!-- ACCOUNT ACTIVITY -->
<div class="section">
    <div class="section-header">
        <h3>Pemberitahuan Pasien Ranap</h3>
     
    </div>
    <div class="success-box">
        <b><iframe src="http://10.10.20.250/dashboard/APPS-ROBOT/TV/ranap.php" class="snapwidget-widget" allowtransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:240px; height:140px" title="Klinik Asura"></iframe></b>
      
    </div>
</div>




<!-- ACCOUNT ACTIVITY -->
<div class="section">
    <div class="section-header">
        <h3>Pemberitahuan Pasien Belum Bayar</h3>
 
    </div>
    <div class="success-box">
        <b><iframe src="http://10.10.20.250/dashboard/APPS-ROBOT/TV/pasien-belum-bayar2.php" class="snapwidget-widget" allowtransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:320px; height:18px" title="Klinik Asura"></iframe></b>
      
    </div>
</div>





<!-- ACCOUNT ACTIVITY -->
<div class="section">
    <div class="section-header">
        <h3>Pemberitahuan Jadwal Dokter</h3>
 
    </div>
    <div class="success-box">
        <b><iframe src="http://10.10.20.250/dashboard/APPS-ROBOT/ANTRIAN-POLIKLINIK/poli-github-tv.php" class="snapwidget-widget" allowtransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:320px; height:300px" title="Klinik Asura"></iframe></b>
      
    </div>
</div>



<!-- ACCOUNT ACTIVITY -->
<div class="section">
    <div class="section-header">
        <h3>Pemberitahuan Antrian Pasien</h3>
    </div>
<div class="scroll-box">
    <iframe src="http://10.10.20.250/dashboard/APPS-ROBOT/TV/MASTER/display-otomatis2.php"
        allowtransparency="true"
        frameborder="0"
        scrolling="no"
        title="Klinik Asura">
    </iframe>
</div>
</div>










<!-- SEND MONEY -->
<div class="section">
    <div class="section-header">
        <h3>Fitur Lainnya</h3>

    </div>

<a href="http://10.10.20.250/dashboard/E-DOKTER/V1/login.php">
    <div class="send-money">
        <div class="send-item">
            <img src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/DOKTER22.webp">
            <small>Dokter V1</small>
        </div> </a>


<a href="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/DOKTER22.webp">
        <div class="send-item">
            <img src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/DOKTER22.webp">
            <small>Dokter V2</small>
        </div></a>


<a href="http://10.10.20.250/dashboard/APLIKASI/pendaftaran/login.php">
        <div class="send-item">
            <img src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/PASIEN22.webp">
            <small>E-Pasien V1</small>
        </div></a>


<a href="http://10.10.20.250/dashboard/APPS-ROBOT/E-PASIEN/">
        <div class="send-item">
            <img src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/EPASIEN12.webp">
            <small>E-Pasien V2</small>
        </div></a>

<a href="http://10.10.20.250/dashboard/APPS-ROBOT/E-MCU/">
        <div class="send-item">
            <img src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/MCU2.png">
            <small>MCU</small>
        </div></a>


<a href="http://10.10.20.250/dashboard/ROBOT-BANK/login.php">
        <div class="send-item">
            <img src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/MONEY2.webp">
            <small>E-Money</small>
        </div></a>





<a href="http://10.10.20.250/dashboard/APPS-ROBOT/DATABASE-KARYAWAN/login2.html">
        <div class="send-item">
            <img src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/SIKRSOK2222.webp">
            <small>SIKRS</small>
        </div></a>




<a href="http://10.10.20.250/webapps/">
        <div class="send-item">
            <img src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/SURAT2.webp">
            <small>WEBAPPS</small>
        </div></a>




<a href="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/pintasan-satu-sehat.php">
        <div class="send-item">
            <img src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/KEMENKES22.png">
            <small>SATU SEHAT</small>
        </div></a>



<a href="http://10.10.20.250/dashboard/APPS-ROBOT/TV/index.php">
        <div class="send-item">
            <img src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/TV.webp">
            <small>TV</small>
        </div></a>



<a href="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/index-dashboard2-farmasi.php">
        <div class="send-item">
            <img src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/FARMASI4.webp">
            <small>FARMASI</small>
        </div></a>


<a href="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/index-dashboard2-cek-sudah-rm.php">
        <div class="send-item">
            <img src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/INPUTAN.png">
            <small>Cek Sudah RM</small>
        </div></a>



<a href="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/WIDGET/NEW/AI-BACA-BARCODE-2">
        <div class="send-item">
            <img src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/SCANRM2.webp">
            <small>SCAN RM</small>
        </div></a>



<a href="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/index-dashboard2-widget.php">
        <div class="send-item">
            <img src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/WIDGET222.webp">
            <small>WIDGET</small>
        </div></a>




    </div>
</div>

<!-- BOTTOM NAV -->
<div class="bottom-nav">
   <a href="http://10.10.20.250/dashboard/ROBOT-DASHBOARD/"  class="nav-item"><img src="http://10.10.20.250/dashboard/APPS-ROBOT/ANDROID-NEW/BERANDA2.png" alt="" class="profile-pic" height="40" width="40" ><br></a>
     <a href="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/SOAP/ROBOT-V80/rawat_jalan/manage?t=d9d3d5af7281"  class="nav-item"><img src="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/SOAP.png" alt="" id="vib1" class="profile-pic" height="40" width="40" ><br></a>
     <a href="http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/index-dashboard2.php"  class="home-btn"><img src="http://10.10.20.250/dashboard/APPS-ROBOT/ANDROID-NEW/APPS2.png" alt="" class="profile-pic" height="100" width="100" > </a>
     <a href="<?= $user['gaji']; ?>"  class="nav-item" id="vib1"><img src="http://10.10.20.250/dashboard/APPS-ROBOT/ANDROID-NEW/GAJI.png" alt="" class="profile-pic" height="40" width="40" ><br></a>
     <a href="http://10.10.20.250/dashboard/APPS-ROBOT/ANDROID-NEW/logout2.php" class="nav-item"><img src="http://10.10.20.250/dashboard/APPS-ROBOT/ANDROID-NEW/LOGOUT.png" alt="" class="profile-pic" height="40" width="40" ><br></a>
</div>


<p>   <p>&nbsp;</p>
<p>   <p>&nbsp;</p>










<!-- ===== NOTIFIKASI SUARA PEMBAYARAN ===== -->
<audio id="soundBayar" src="http://10.10.20.250/dashboard/APPS-ROBOT/TV/AUDIO/BAYAR2.mp3"
       preload="auto" muted></audio>

<div id="popupBayar"></div>

<script>
    // Aktifkan suara setelah ada interaksi user (biasanya klik di halaman)
    document.body.addEventListener('click', function initSound() {
        var snd = document.getElementById('soundBayar');
        snd.muted = false;
        snd.play().catch(e => console.log('Play failed:', e));
        document.body.removeEventListener('click', initSound);
    });

    // Flag agar popup hanya muncul sekali
    var popupShown = false;

    // Cek pembayaran tiap 5 detik
    function cekPembayaran() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://10.10.20.250/dashboard/APPS-ROBOT/TV/cek_pembayaran.php', true);
        xhr.onload = function() {
            if (xhr.status === 200 && xhr.responseText.trim() === '1') {
                var snd = document.getElementById('soundBayar');
                if (snd.muted) snd.muted = false;
                snd.play().catch(e => console.log('Play failed:', e));

                // Tampilkan popup hanya sekali
                if (!popupShown) {
                    var pop = document.getElementById('popupBayar');
                    pop.style.display = 'block';
                    setTimeout(function() {
                        pop.style.display = 'none';
                    }, 5000); // hilang setelah 5 detik
                    popupShown = true;
                }
            }
        };
        xhr.send();
    }
    setInterval(cekPembayaran, 5000);
</script>

<!-- ===== NOTIFIKASI SUARA JAM TERTENTU ===== -->
<script>
    // Daftar jam (format 24‑jam) yang ingin dibunyikan suara
    var alarmTimes = [
        '00:00','01:00','02:00','03:00','04:00','05:00','06:00',
        '07:00','08:00','09:00','10:00','11:00','12:00','13:00',
        '14:00','15:00','16:00','17:00','18:00','19:00','20:00',
        '21:00','22:00','23:00'
    ];

    // Fungsi memutar suara Google TTS (bahasa Indonesia)
    function playGoogleTTS(timeStr) {
        var url = 'https://translate.google.com/translate_tts?ie=UTF-8&tl=id&client=tw-ob&q='
                + encodeURIComponent('Sekarang sudah jam ' + timeStr);
        var audio = new Audio(url);
        audio.play().catch(e => console.log('Play failed:', e));
    }

    // Flag agar popup hanya muncul sekali
    var popupShown = false;

    function playAlarm() {
        var now = new Date();
        var curr = now.getHours() + ':' + ('0'+now.getMinutes()).slice(-2);
        playGoogleTTS(curr);

        if (!popupShown) {
            var pop = document.getElementById('popupBayar');
            pop.style.display = 'block';
            setTimeout(function() {
                pop.style.display = 'none';
            }, 5000);
            popupShown = true;
        }
    }

    function cekJam() {
        var now = new Date();
        var curr = now.getHours() + ':' + ('0'+now.getMinutes()).slice(-2);
        if (alarmTimes.includes(curr)) {
            playAlarm();
            // Hapus jam yang sudah dipicu supaya tidak berulang tiap detik
            alarmTimes = alarmTimes.filter(t => t !== curr);
        }
    }
    setInterval(cekJam, 1000);
</script>







<!-- Notifikasi Adzan -->
<div id="notifikasi-adzan"></div>
<script>
  function playAdzan() {
    var audio = new Audio('http://10.10.20.251/dashboard/APPS-ROBOT/TV/AUDIO/SHOLAT2.mp3');
    audio.play();
  }

  function showNotifikasiAdzan(sholat) {
    var notifikasi = document.createElement("div");
    notifikasi.style.position = "fixed";
    notifikasi.style.top = "50%";
    notifikasi.style.left = "50%";
    notifikasi.style.transform = "translate(-50%, -50%)";
    notifikasi.style.background = "#fff";
    notifikasi.style.padding = "20px";
    notifikasi.style.borderRadius = "10px";
    notifikasi.style.boxShadow = "0px 0px 10px rgba(0,0,0,0.5)";
    notifikasi.innerHTML = "<h2><center>Saatnya Adzan Berkumandang !</h2><img src='http://10.10.20.251/dashboard/APPS-ROBOT/TV/JPG/ADZAN.jpeg' width='400' height='400'><p>Silahkan Menunaikan Ibadah Shalat " + sholat + "!</center></p>";
    document.body.appendChild(notifikasi);
    setTimeout(function() {
      document.body.removeChild(notifikasi);
    }, 25000);
  }

  // API waktu adzan
  var apiUrl = 'http://api.aladhan.com/v1/timingsByCity?city=Oki&country=Indonesia&method=2';

  // Cek waktu adzan
  setInterval(function() {
    fetch(apiUrl)
      .then(response => response.json())
      .then(data => {
        var waktuAdzan = [
          { jam: data.data.timings.Fajr.split(':')[0], menit: data.data.timings.Fajr.split(':')[1], sholat: 'Subuh' },
          { jam: data.data.timings.Dhuhr.split(':')[0], menit: data.data.timings.Dhuhr.split(':')[1], sholat: 'Dzuhur' },
          { jam: data.data.timings.Asr.split(':')[0], menit: data.data.timings.Asr.split(':')[1], sholat: 'Ashar' },
          { jam: data.data.timings.Maghrib.split(':')[0], menit: data.data.timings.Maghrib.split(':')[1], sholat: 'Maghrib' },
          { jam: data.data.timings.Isha.split(':')[0], menit: data.data.timings.Isha.split(':')[1], sholat: 'Isya' }
        ];
        var now = new Date();
        var jam = now.getHours();
        var menit = now.getMinutes();
        for (var i = 0; i < waktuAdzan.length; i++) {
          if (jam === parseInt(waktuAdzan[i].jam) && menit === parseInt(waktuAdzan[i].menit)) {
            playAdzan();
            showNotifikasiAdzan(waktuAdzan[i].sholat);
          }
        }
      })
      .catch(error => console.error(error));
  }, 2000);
</script>






<!-- FULL LAYAR -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.documentElement.requestFullscreen();
});
document.getElementById('fullScreenBtn').addEventListener('click', function() {
    if (document.fullscreenElement) {
        document.exitFullscreen();
    } else {
        document.documentElement.requestFullscreen();
    }
});
</script>







</body>
</html>
