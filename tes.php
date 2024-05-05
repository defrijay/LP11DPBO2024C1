function tambahPasien($nik, $nama, $tempat, $tl, $gender, $email, $telp) {
		try {
			$query = "INSERT INTO pasien (nik, nama, tempat, tl, gender, email, telp) 
					VALUES ('$nik', '$nama', '$tempat', '$tl', '$gender', '$email', '$telp')";
			return $this->execute($query);
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	function updatePasien($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp) {
		try {
			$query = "UPDATE pasien 
					  SET nik = '$nik', nama = '$nama', tempat = '$tempat', tl = '$tl', 
						  gender = '$gender', email = '$email', telp = '$telp' 
					  WHERE id = '$id'";
			return $this->execute($query);
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	function hapusPasien($id) {
		try {
			$query = "DELETE FROM pasien WHERE id = '$id'";
			return $this->execute($query);
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}

    // function edit(){
	// 	$this->editProsesPasien->prosesDataPasien();
	// 	$data = null;

	// 		$data .= "
	// 			<form class='row g-3' method='POST' action =''>
	// 				<div class='col-md-6'>
	// 					<label for='NIK' class='form-label'>NIK</label>
	// 					<input type='text' class='form-control' id='NIK' name='nik' required>
	// 				</div>
	// 				<div class='col-md-6'>
	// 					<label for='nama' class='form-label'>Nama</label>
	// 					<input type='text' class='form-control' id='nama' name='name' required>
	// 				</div>
	// 				<div class='col-md-6'>
	// 					<label for='tempat' class='form-label'>Tempat</label>
	// 					<input type='text' class='form-control' id='tempat' name='tempat' required>
	// 				</div>
	// 				<div class='col-md-6'>
	// 					<label for='tanggal-lahir' class='form-label'>Tanggal Lahir</label>
	// 					<input type='date' class='form-control' id='tanggal-lahir' name='tanggal-lahir' required>
	// 				</div>
	// 				<div class='col-md-6'>
	// 					<label for='gender' class='form-label'>Gender</label>
	// 					<select class='form-select' aria-label='gender'>
	// 						<option value='Laki-Laki' selected>Laki - Laki</option>
	// 						<option value='Perempuan'>Perempuan</option>
	// 					</select>
	// 				</div>
	// 				<div class='col-md-6'>
	// 					<label for='email' class='form-label'>Email</label>
	// 					<div class='input-group'>
	// 						<span class='input-group-text' id='email'>@</span>
	// 						<input type='text' class='form-control' id='email' aria-describedby='email' required>
	// 					</div>
	// 				</div>
	// 				<div class='col-md-12'>
	// 					<label for='telepon' class=' form-label'>Telepon</label>
	// 					<input type='text' class='form-control' id='telepon' required>
	// 				</div>
	// 				<div class='col-md-6'>
	// 					<button class='btn btn-success mr-5' type='submit'>Submit form</button>
	// 					<button class='btn btn-outline-warning' type='reset'>Reset form</button>
	// 				</div>
	// 		</form>
	// 		";
	// 	// Membaca template skin.html
	// 	$this->tpl = new Template("templates/editSkin.html");

	// 	// Mengganti kode Data_Tabel dengan data yang sudah diproses
	// 	$this->tpl->replace("DATA_FORM", $data);

	// 	// Menampilkan ke layar
	// 	$this->tpl->write();
	// }
