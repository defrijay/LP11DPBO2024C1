<?php

include("KontrakPresenter.php");


class ProsesPasien implements KontrakPresenter
{
	private $tabelpasien;
    private $data = [];

    function __construct()
    {
        //konstruktor
        try {
            $db_host = "localhost"; // host 
            $db_user = "root"; // user
            $db_password = ""; // password
            $db_name = "mvp_php"; // nama basis data
            $this->tabelpasien = new TabelPasien($db_host, $db_user, $db_password, $db_name); //instansi TabelPasien
            $this->data = array(); //instansi list untuk data Pasien
            //data = new ArrayList<Pasien>;//instansi list untuk data Pasien
        } catch (Exception $e) {
            echo "wiw error" . $e->getMessage();
        }
    }

    function prosesDataPasien()
    {
        try {
            //mengambil data di tabel pasien
            $this->tabelpasien->open();
            $this->tabelpasien->getPasien();
            while ($row = $this->tabelpasien->getResult()) {
                //ambil hasil query
                $pasien = new Pasien(); //instansiasi objek pasien untuk setiap data pasien
                $pasien->setId($row['id']); //mengisi id
                $pasien->setNik($row['nik']); //mengisi nik
                $pasien->setNama($row['nama']); //mengisi nama
                $pasien->setTempat($row['tempat']); //mengisi tempat
                $pasien->setTl($row['tl']); //mengisi tl
                $pasien->setGender($row['gender']); //mengisi gender
                $pasien->setEmail($row['email']); //mengisi email
                $pasien->setTelp($row['telp']); //mengisi telepon

                $this->data[] = $row; //tambahkan data pasien ke dalam list
            }
            //tutup koneksi
            $this->tabelpasien->close();
        } catch (Exception $e) {
            //memproses error
            echo "wiw error part 2" . $e->getMessage();
        }
    }

    function getPasienById($id)
    {
        try {
            $this->tabelpasien->open();
            $this->tabelpasien->getPasienById($id);
            $row = $this->tabelpasien->getResult();
            $pasien = new Pasien();
            $pasien->setId($row['id']);
            $pasien->setNik($row['nik']);
            $pasien->setNama($row['nama']);
            $pasien->setTempat($row['tempat']);
            $pasien->setTl($row['tl']);
            $pasien->setGender($row['gender']);
            $pasien->setEmail($row['email']);
            $pasien->setTelp($row['telp']);
            $this->tabelpasien->close();
            return $pasien;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

	function addPasien($nik, $nama, $tempat, $tanggal_lahir, $gender, $email, $telepon)
{
    try {
        // Panggil method untuk menambahkan data pasien ke database
        $success = $this->tabelpasien->addPasien($nik, $nama, $tempat, $tanggal_lahir, $gender, $email, $telepon);
        return $success;
    } catch (Exception $e) {
        // Tangani error jika terjadi
        echo "Error: " . $e->getMessage();
        return false;
    }
}


	function deletePasienById($id){
		try{
			$this->tabelpasien->open();
			$this->tabelpasien->deletePasien($id); // Menggunakan parameter $id
			$this->tabelpasien->close();
			return true; // Kembalikan true jika penghapusan berhasil
		} catch(Exception $e){
			echo "Gagal Menghapus Data Pasien, " . $e->getMessage();
			return false; // Kembalikan false jika penghapusan gagal
		}
	}
	




	function getId($i)
	{
		//mengembalikan id Pasien dengan indeks ke i
		return $this->data[$i]['id'];
	}
	function getNik($i)
	{
		//mengembalikan nik Pasien dengan indeks ke i
		return $this->data[$i]['nik'];
	}
	function getNama($i)
	{
		//mengembalikan nama Pasien dengan indeks ke i
		return $this->data[$i]['nama'];
	}
	function getTempat($i)
	{
		//mengembalikan tempat Pasien dengan indeks ke i
		return $this->data[$i]['tempat'];
	}
	function getTl($i)
	{
		//mengembalikan tanggal lahir(TL) Pasien dengan indeks ke i
		return $this->data[$i]['tl'];
	}
	function getGender($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['gender'];
	}
	function getEmail($i)
	{
		//mengembalikan email Pasien dengan indeks ke i
		return $this->data[$i]['email'];
	}
	function getTelp($i)
	{
		//mengembalikan telepon Pasien dengan indeks ke i
		return $this->data[$i]['telp'];
	}
	function getSize()
	{
		return sizeof($this->data);
	}
}
