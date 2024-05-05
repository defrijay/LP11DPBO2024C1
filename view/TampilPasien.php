<?php
include("KontrakView.php");
include("presenter/ProsesPasien.php");

class TampilPasien implements KontrakView
{
    private $prosespasien;
    private $tpl;

    function __construct()
    {
        $this->prosespasien = new ProsesPasien();
    }

    function tampil()
    {
        // Proses form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Pastikan form telah disubmit
			if (isset($_POST["nik"]) && isset($_POST["name"]) && isset($_POST["tempat"]) && isset($_POST["tanggal-lahir"]) && isset($_POST["gender"]) && isset($_POST["email"]) && isset($_POST["telepon"])) {
				// Ambil nilai inputan dari form
				$nik = $_POST["nik"];
				$nama = $_POST["name"];
				$tempat = $_POST["tempat"];
				$tanggal_lahir = $_POST["tanggal-lahir"];
				$gender = $_POST["gender"];
				$email = $_POST["email"];
				$telepon = $_POST["telepon"];
		
				// Lakukan validasi data jika diperlukan
		
				// Panggil fungsi untuk menambahkan pasien baru ke database
				$success = $this->prosespasien->addPasien($nik, $nama, $tempat, $tanggal_lahir, $gender, $email, $telepon);
				if ($success) {
					// Jika penambahan berhasil, redirect kembali ke halaman utama
					echo "<script>
							alert('Data pasien berhasil ditambahkan');
							window.location.href = 'index.php';
						  </script>";
					exit();
				} else {
					// Jika penambahan gagal, tampilkan pesan error
					echo "<script>alert('Gagal menambahkan data pasien');</script>";
				}
			} else {
				// Jika ada input yang tidak lengkap, tampilkan pesan error
				echo "<script>alert('Form tidak lengkap');</script>";
			}
		}
		

        // Proses data pasien
        $this->prosespasien->prosesDataPasien();
        $data = null;

        for ($i = 0; $i < $this->prosespasien->getSize(); $i++) {
            $no = $i + 1;
            $data .= "<tr>
            <td>" . $no . "</td>
            <td>" . $this->prosespasien->getNik($i) . "</td>
            <td>" . $this->prosespasien->getNama($i) . "</td>
            <td>" . $this->prosespasien->getTempat($i) . "</td>
            <td>" . $this->prosespasien->getTl($i) . "</td>
            <td>" . $this->prosespasien->getGender($i) . "</td>
            <td>" . $this->prosespasien->getEmail($i) . "</td>
            <td>" . $this->prosespasien->getTelp($i) . "</td>
            <td>
            <button class='btn btn-primary m-1'><a href='index.php?action=edit&id=" . $this->prosespasien->getId($i) . "' class='btn btn-primary'>Edit</a></button>
            <button class='btn btn-danger m-1'><a href='index.php?action=delete&id=" . $this->prosespasien->getId($i) . "' class='btn btn-danger'>Delete</a></button>
            </td>
            </tr>";
        }

        // Membaca template skin.html
        $this->tpl = new Template("templates/skin.html");

        // Mengganti kode Data_Tabel dengan data yang sudah diproses
        $this->tpl->replace("DATA_TABEL", $data);

        // Membuat opsi gender berdasarkan data yang ada di database
        $optionsGender = '';
        $genders = ['Laki-laki', 'Perempuan']; // Anda bisa mengambil nilai ini dari database jika diperlukan
        foreach ($genders as $gender) {
            $optionsGender .= '<option value="' . $gender . '">' . $gender . '</option>';
        }

        // Mengganti kode genderSelect dengan opsi gender
        $this->tpl->replace("GENDER_SELECT", $optionsGender);

        // Menampilkan ke layar
        $this->tpl->write();
        
        // Periksa apakah ada parameter action dan id yang dikirim melalui URL
        if(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
            $id_pasien = $_GET['id'];
            // Gunakan ID ini untuk mengisi form
            $pasien = $this->prosespasien->getPasienById($id_pasien);
            // Periksa jika pasien ditemukan
            if($pasien) {
                // Tambahkan script JavaScript untuk mengisi nilai form dengan data pasien
                echo "<script>
                    document.getElementById('NIK').value = '" . $pasien->getNik() . "';
                    document.getElementById('nama').value = '" . $pasien->getNama() . "';
                    document.getElementById('tempat').value = '" . $pasien->getTempat() . "';
                    document.getElementById('tanggal-lahir').value = '" . $pasien->getTl() . "';
                    document.getElementById('genderSelect').value = '" . $pasien->getGender() . "'; // Menggunakan ID genderSelect
                    document.getElementById('email').value = '" . $pasien->getEmail() . "'; 
                    document.getElementById('telepon').value = '" . $pasien->getTelp() . "'; 
                </script>";
            } else {
                // Tampilkan pesan jika pasien tidak ditemukan
                echo "<script>alert('Pasien tidak ditemukan');</script>";
            }
        }

        // Hapus data pasien jika tombol delete diklik
        if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
            $id_pasien = $_GET['id'];
            // Tambahkan script JavaScript untuk konfirmasi penghapusan
            echo "<script>
                function confirmDelete(id) {
                    if (confirm('Apakah Anda yakin ingin menghapus data pasien ini?')) {
                        window.location.href = 'index.php?action=delete&id=' + id;
                    }
                }
            </script>";

            // Hapus pasien berdasarkan ID
            $success = $this->prosespasien->deletePasienById($id_pasien);
            if ($success) {
                echo "<script>
                        alert('Data pasien berhasil dihapus');
                        window.location.href = 'index.php';
                      </script>";
                exit();
            } else {
                echo "<script>alert('Gagal menghapus data pasien');</script>";
            }
        }
    }
}
?>
