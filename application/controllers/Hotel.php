<?php
// Hotel.php controller
date_default_timezone_set("asia/kolkata");

class Hotel extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();
		if(!isset($_SESSION['hotel_id']))
		{
			redirect(base_url('login'));
		}
	}
	protected function navbar()
	{
		$this->load->view("hotel/navbar");
	}
	protected function footer()
	{
		$this->load->view("hotel/footer");
	}
	public function index()
	{
		$this->navbar();

		$data['tables'] = $this->My_model->select("hotel_table");

		$dates = [];
		$amounts = [];
		for ($i=0; $i<7; $i++) 
		{ 
			$d = date('Y-m-d',strtotime("-$i day"));
			$dates[] = $d;

			$sql = "SELECT 

			SUM((SELECT SUM(total) FROM order_products WHERE 
				order_tbl.order_id = order_products.order_id)) as ttl

			 FROM order_tbl WHERE order_date = '$d'";

			 $day_total = $this->db->query($sql)->result_array();

			 $amounts[] = (int)$day_total[0]['ttl'];

            
		}
		

		$data['x_axis'] = $dates;
		$data['y_axis'] = $amounts;



		$this->load->view("hotel/index",$data);
		$this->footer();

	}
	public function manage_table()
	{
		$this->navbar();
        
        $cond = ["hotel_id"=>$_SESSION['hotel_id']];
		$data['tables'] = $this->My_model->select_where("hotel_table",$cond);

		$this->load->view("hotel/manage_table", $data);

		$this->footer();
	}




// टेबल Edit करण्यासाठी
public function edit_table($id)
{
    $this->navbar();

    $cond = ['hotel_table_id' => $id];
    $data['table'] = $this->My_model->select_where("hotel_table", $cond)[0];

    $this->load->view("hotel/edit_table", $data);

    $this->footer();
}

// टेबल Update करण्यासाठी
public function update_table()
{
    $id = $_POST['hotel_table_id'];
    unset($_POST['hotel_table_id']); // कारण आपण condition मधे वापरणार

    $this->My_model->update("hotel_table", $_POST, ['hotel_table_id' => $id]);

    redirect(base_url('hotel/manage_table'));
}

// टेबल Delete करण्यासाठी
public function delete_table($id)
{
    $this->My_model->delete("hotel_table", ['hotel_table_id' => $id]);

    redirect(base_url('hotel/manage_table'));
}




	public function save_table()
	{
		$_POST['hotel_id'] = $_SESSION['hotel_id'];
		$this->My_model->insert("hotel_table", $_POST);
		redirect(base_url('hotel/manage_table'));
	}
	public function manage_category()
	{
	    $this->navbar();
        
		$data['cats'] =$this->My_model->get_cats();
        $this->load->view("hotel/manage_category",$data);

	    $this->footer();	
	}
	// public function save_category()
	// {
	// 	$_POST['hotel_id'] = $_SESSION['hotel_id'];

	// 	$this->My_model->insert("category", $_POST);

	// 	redirect(base_url('hotel/manage_category'));

	// }


// Edit Category
public function edit_category($id)
{
    $this->navbar();

    $cond = ['category_id' => $id];
    $data['edit_data'] = $this->My_model->select_where("category", $cond)[0];

    // सर्व categories फॉर्मखाली दाखवण्यासाठी
    $data['cats'] = $this->My_model->get_cats();

    $this->load->view("hotel/manage_category", $data);
    $this->footer();
}

// Save / Update Category
public function save_category()
{
    $_POST['hotel_id'] = $_SESSION['hotel_id'];

    if (!empty($_POST['category_id'])) {
        // Update category
        $id = $_POST['category_id'];
        unset($_POST['category_id']);
        $this->My_model->update("category", $_POST, ['category_id' => $id]);
    } else {
        // New category insert
        $this->My_model->insert("category", $_POST);
    }

    redirect(base_url('hotel/manage_category'));
}

// Delete Category
public function delete_category($id)
{
    $this->My_model->delete("category", ['category_id' => $id]);
    redirect(base_url('hotel/manage_category'));
}


	public function add_product()
	{
		$this->navbar();

        $data['cats'] =$this->My_model->get_cats();
		$this->load->view("hotel/add_product",$data);

		$this->footer();
	}

	public function save_product()
	{

        $_POST['product_image'] = $image_name = time().$_FILES['product_image']['name'];
		move_uploaded_file($_FILES['product_image']['tmp_name'], "uploads/$image_name");
        
		$_POST['hotel_id'] = $_SESSION['hotel_id'];
		$this->My_model->insert("products",$_POST);

		redirect(base_url("hotel/add_product"));
	}

	public function product_list()
	{ 
		$this->navbar();
		$data['products'] = $this->My_model->get_products();
		$this->load->view("hotel/product_list",$data);
		$this->footer();
	}

	public function edit_product($id)
{
    $this->navbar();

    // Product details
    $cond = ['product_id' => $id];
    $data['product'] = $this->My_model->select_where("products", $cond)[0];

    // Category dropdown साठी
    $data['cats'] = $this->My_model->get_cats();

    $this->load->view("hotel/edit_product", $data);
    $this->footer();
}

public function update_product()
{
    $id = $_POST['product_id'];

    // जर नवीन image अपलोड केली असेल तर
    if (!empty($_FILES['product_image']['name'])) {
        $_POST['product_image'] = $image_name = time().$_FILES['product_image']['name'];
        move_uploaded_file($_FILES['product_image']['tmp_name'], "uploads/$image_name");
    } else {
        unset($_POST['product_image']); // जुनी image ठेवायची असल्यास
    }

    $this->My_model->update("products", $_POST, ['product_id' => $id]);

    redirect(base_url("hotel/product_list"));
}

public function delete_product($id)
{
    $this->My_model->delete("products", ['product_id' => $id]);

    redirect(base_url("hotel/product_list"));
}

public function order_details($order_id)
{
	$data['order_info'] = $this->My_model->select_where("order_tbl",["order_id"=>$order_id])[0];

	// $data['order_products'] = $this->My_model->select_where("order_products",
	// 	["order_id"=>$order_id]);

	$sql = "SELECT * FROM products,order_products WHERE order_id = '$order_id' AND products.product_id = order_products.product_id";

	$data['order_products'] = $this->db->query($sql)->result_array();

	// echo "<pre>";
	// print_r($data);

    $this->navbar();
	$this->load->view("hotel/order_details",$data);
	$this->footer();
}

 // public function print_bill($order_id)
 // {
 // 	$cond = ["order_id"=>$order_id];
 // 	$data = ["order_status"=>"complete"];
 // 	$this->My_model->update("order_tbl",$cond,$data);
 // 	redirect(base_url()."hotel/order_details/$order_id");
 // }

public function print_bill($order_id)
{
    $cond = ["order_id" => $order_id];
    $data = ["order_status" => "complete"];

    // बरोबर क्रम: where(condition)->update(table, data)
    $this->My_model->update("order_tbl", $data, $cond);

    redirect(base_url()."hotel/order_details/$order_id");
}


}
?>



<!--
CREATE TABLE hotel_table (
hotel_table_id INT PRIMARY KEY AUTO_INCREMENT,
table_no VARCHAR(100),
hotel_id INT
); 


CREATE TABLE category (
category_id INT PRIMARY KEY AUTO_INCREMENT,
category_name VARCHAR(100),
hotel_id INT
); 


CREATE TABLE products (
product_id INT PRIMARY KEY AUTO_INCREMENT,
category_id INT,
product_name VARCHAR(100),
product_price INT,
product_image TEXT,
hotel_id INT
); 


 -->