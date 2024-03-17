<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * siswa_kota_id_option_list Model Action
     * @return array
     */
	function siswa_kota_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,nama AS label FROM kota";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * user_nama_value_exist Model Action
     * @return array
     */
	function user_nama_value_exist($val){
		$db = $this->GetModel();
		$db->where("nama", $val);
		$exist = $db->has("user");
		return $exist;
	}

	/**
     * user_email_value_exist Model Action
     * @return array
     */
	function user_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("user");
		return $exist;
	}

	/**
     * getcount_totalsiswa Model Action
     * @return Value
     */
	function getcount_totalsiswa(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM siswa";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_lakilaki Model Action
     * @return Value
     */
	function getcount_lakilaki(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS jumlah_laki FROM siswa WHERE jenkel = 1;";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_perempuan Model Action
     * @return Value
     */
	function getcount_perempuan(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS jumlah_laki FROM siswa WHERE jenkel = 2;";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
	* doughnutchart_jeniskelamin Model Action
	* @return array
	*/
	function doughnutchart_jeniskelamin(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "Select case 
        when jenkel = '1' then 'Laki-Laki'
        when jenkel = '2' then 'Perempuan'
        else jenkel
    end as jenis_kelamin,
    count(*) as total_siswa
FROM siswa
group by jenkel;";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'total_siswa');
		$dataset_labels =  array_column($dataset1, 'jenis_kelamin');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

	/**
	* piechart_kotaasal Model Action
	* @return array
	*/
	function piechart_kotaasal(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "select kota.id, kota.nama, count(siswa.id) as total_siswa
from kota
left join siswa on kota.id = siswa.kota_id
group by kota.id, kota.nama desc LIMIT 6;
";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'id');
		$dataset_labels =  array_column($dataset1, 'nama');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

	/**
	* barchart_tahunlahir Model Action
	* @return array
	*/
	function barchart_tahunlahir(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "Select year(tgl_lahir), count(*) from siswa group by year(tgl_lahir) order by count(*) desc LIMIT 6;";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'count(*)');
		$dataset_labels =  array_column($dataset1, 'year(tgl_lahir)');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

}
