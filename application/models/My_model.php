<?php
// My_model.php
class My_model extends CI_model
{
	function insert($tname, $data)
	{
		$this->db->insert($tname, $data);
		return $this->db->insert_id();
	}

	function select($tname)
	{
		return $this->db->get($tname)->result_array();
	}

	function select_where($tname, $cond)
	{
		return $this->db->where($cond)->get($tname)->result_array();
	}

	function update($tname, $data, $cond)
	{
		$this->db->where($cond)->update($tname, $data);
	}

	function delete($tname, $cond)
	{
		$this->db->where($cond)->delete($tname);
	}

	// function get_cats()
	// {
	// 	$cond = ["hotel_id" => $_SESSION['hotel_id']];
	// 	return $this->select_where("category", $cond);
	// }
	function get_cats()
    {
    if (isset($_SESSION['hotel_id'])) {
        $cond = ["hotel_id" => $_SESSION['hotel_id']];
        return $this->select_where("category", $cond);
    } else {
        // hotel_id session मध्ये नाही तर कसं handle करायचं ते ठरवा
        return []; // रिकामा array परत करा किंवा error handle करा
    }
    
}


	function get_products()
	{
		return $this->db->query("SELECT * FROM products, category WHERE 
			products.category_id = category.category_id")->result_array();
	}
}
?>