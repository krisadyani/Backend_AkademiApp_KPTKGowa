<?php 
/**
 * Siswa Page Controller
 * @category  Controller
 */
class DashboardApiController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "siswa";
	}

	function countsiswabyyear() {
		$request = $this->request;
		$db = $this->GetModel();
		$siswaTable = $this->tablename;
		
		// Query untuk menghitung total siswa di setiap tahun
		$query = "SELECT YEAR(tgl_lahir) AS tahun, COUNT(*) AS total_siswa
				  FROM $siswaTable
				  GROUP BY YEAR(tgl_lahir)
				  ORDER BY total_siswa DESC LIMIT 6";
		
		$tc = $db->withTotalCount();
		$records = $db->rawQuery($query);
		
		$data = new stdClass;
		$data->records = $records;
		
		if ($db->getLastError()) {
			$this->set_page_error();
		}
		
		render_json($data->records);
	}

	function countsiswa(){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("siswa.id", 
			"siswa.nis", 
			"siswa.nama", 
			"siswa.tgl_lahir", 
			"siswa.alamat", 
			"siswa.jenkel", 
			"siswa.kota_id", 
			"kota.nama AS kota_nama");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		$db->join("kota", "siswa.kota_id = kota.id", "INNER");
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$total_records = intval($tc->totalCount);
		$data = new stdClass;
		$data->total_records = $total_records;
		if($db->getLastError()){
			$this->set_page_error();
		}
		return render_json($data->total_records);
	}

	function countsiswabykota() {
		$request = $this->request;
		$db = $this->GetModel();
		$kotaTable = "kota"; // Ganti dengan nama tabel kota
		$siswaTable = $this->tablename;
		
		// Query untuk menghitung total siswa di setiap kota
		$query = "SELECT $kotaTable.id, $kotaTable.nama, COUNT($siswaTable.id) AS total_siswa
				  FROM $kotaTable
				  LEFT JOIN $siswaTable ON $kotaTable.id = $siswaTable.kota_id
				  GROUP BY $kotaTable.id, $kotaTable.nama
				  ORDER BY total_siswa DESC LIMIT 6";
		
		$tc = $db->withTotalCount();
		$records = $db->rawQuery($query);
		
		$data = new stdClass;
		$data->records = $records;
		
		if ($db->getLastError()) {
			$this->set_page_error();
		}
		
		render_json($data->records);
	}

	function countjenkel() {
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		
		// Query untuk menghitung total siswa dan jenis kelamin
		$query = "SELECT 
					CASE
						WHEN jenkel = 1 THEN 'Laki - Laki'
						WHEN jenkel = 2 THEN 'Perempuan'
						ELSE 'Lainnya'
					END AS jenis_kelamin,
					COUNT(*) AS total_siswa
				  FROM $tablename
				  GROUP BY jenkel";
		
		$tc = $db->withTotalCount();
		$records = $db->rawQuery($query);
		
		// Mengubah format hasil query ke format yang diinginkan
		$output = array_map(function ($record) {
			return [
				'jenis_kelamin' => $record['jenis_kelamin'],
				'total_siswa' => (int)$record['total_siswa']
			];
		}, $records);
		
		render_json($output);
	}
}
