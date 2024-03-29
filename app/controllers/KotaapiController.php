<?php 
/**
 * Kota Page Controller
 * @category  Controller
 */
class KotaApiController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "kota";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function apilist(){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("id", 
			"nama");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				kota.id LIKE ? OR 
				kota.nama LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "kota/search.php";
		}
		
		$db->orderBy("nama","ASC");
		
		$records = $db->get($tablename, null, $fields);
		
		if($db->getLastError()){
			$this->set_page_error();
		}
		echo render_json($records);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function apiadd($formdata = null){
		$responseError = array(
			"message" => "Tambah data kota terlebih dahulu",
		);
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("nama");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'nama' => 'required',
			);
			$this->sanitize_array = array(
				'nama' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					return render_json(
						array(
							'message' => "Record added successfully",
							'rec_id' => $rec_id,
							'model_data' => $modeldata,
						)
					);
				}
				else{
					$this->set_page_error();
				}
			}
		}
		echo render_json($responseError);
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function apiedit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","nama");
		$responseError = array(
			"message" => "Edit data kota terlebih dahulu",
		);
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'nama' => 'required',
			);
			$this->sanitize_array = array(
				'nama' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("kota.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					return render_json(
						array(
							'message' => "Record updated successfully",
							'bool' => $bool,
							'rec_id' => $rec_id,
							'model_data' => $modeldata,
						)
					);
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						echo "Error $bool - $numRows";
					}
				}
			}
		}
		echo render_json($responseError);
	}
	
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function apidelete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("kota.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		$responseError = array(
			"message" => "Delete data kota terlebih dahulu",
		);
		if($bool){
			return render_json(
				array(
					'message' => "Record deleted successfully",
					'bool' => $bool,
					'arr_rec_id' => $arr_rec_id,
				)
			);
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
			return render_json(
				array(
					'message' => "Error deleted data",
					'bool' => $page_error,
				)
			);
		}
		echo render_json($responseError);
	}

	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id", 
			"nama");
			$responseError = array(
				"message" => "Pilih data kota terlebih dahulu",
			);
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("kota.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			return render_json(
				array(
					'message' => "Succes",
					'record' => $record,
				)
			);
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				return render_json(
					array(
						'message' => "Error record not found",
					)
				);			}
		}
		echo render_json($record);
	}
}
