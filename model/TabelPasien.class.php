<?php

/******************************************
Asisten Pemrogaman 13
 ******************************************/

class TabelPasien extends DB
{
	function getPasien()
	{
		// Query mysql select data pasien
		$query = "SELECT * FROM pasien";
		// Mengeksekusi query
		return $this->execute($query);
	}
	function getPasienById($id)
    {
        // Query mysql select data pasien berdasarkan id
        $query = "SELECT * FROM pasien WHERE id = '$id'";
        // Mengeksekusi query
        return $this->execute($query);
    }

	function addPasien($nik, $nama, $tempat, $tanggal_lahir, $gender, $email, $telepon)
	{
		// Query untuk menambahkan data pasien ke database
		$query = "INSERT INTO pasien (nik, nama, tempat, tl, gender, email, telp) VALUES ('$nik', '$nama', '$tempat', '$tanggal_lahir', '$gender', '$email', '$telepon')";
		// Eksekusi query
		return $this->execute($query);
	}

	function updatePasien()
	{
		// Query mysql select data pasien
		$query = "UPDATE pasien 
				  SET nik = '$nik', nama = '$nama', tempat = '$tempat', tl = '$tl', 
					gender = '$gender', email = '$email', telp = '$telp' 
				  WHERE id = '$id'";
		// Mengeksekusi query
		return $this->execute($query);
	}
	function deletePasien($id)
	{
		// Query mysql select data pasien
		$query = "DELETE FROM pasien WHERE id = '$id'"; // Menggunakan parameter $id
		// Mengeksekusi query
		return $this->execute($query);
	}
	
}
