<?php
// User.php
date_default_timezone_set("asia/kolkata");

class User extends CI_Controller
{
	public function index() 
	{
		$_SESSION['table_id'] = $_GET['table_no'];

       // testsathi manually hotel_id set karat aahe
        $_SESSION['hotel_id'] = 1;

        $data['cats'] = $this->My_model->get_cats();
        $data['products'] = $this->My_model->get_products();
        $this->load->view("user/products", $data);
    }
    public function add_product_in_session()
    {
    	$_SESSION['cart'][$_GET['product_id']] = $_GET['qty'];

        if($_GET['qty'] == 0)
        {
        	unset($_SESSION['cart'][$_GET['product_id']]);
        }

    	echo json_encode(["status"=>"success"]);
    }
    public function send_to_kichen()
    {
    	$order = [
    		"order_date" => date('Y-m-d'),
    		"hotel_table_id" => $_SESSION['table_id'],
    		"order_time" => date('H:i'),
    		"order_status" => "active"
    	]; 

        $hotel_table_id = $_SESSION['table_id'];

        $sql = " SELECT * FROM order_tbl WHERE hotel_table_id = '$hotel_table_id' 
        AND  order_status = 'active'";
        $data = $this->db->query($sql)->result_array();

        if (count($data) > 0) 
        {
            $order_id = $data[0]['order_id'];
        }
        else
        {
            $order_id = $this->My_model->insert("order_tbl",$order);
        }


    	foreach ($_SESSION['cart'] as $product_id => $qty) 
    	{
    		$product = $this->My_model->select_where("products",["product_id"=>$product_id]);
    		$product_price = $product[0]['product_price'];
    		$total = $product_price * $qty;

    		$order_product = [
                 "order_id" => $order_id,
                 "product_id" => $product_id,
                 "qty" => $qty,
                 "product_price" => $product_price,
                 "total" => $total
    		];

    		$this->My_model->insert("order_products",$order_product);
    	}

    	redirect(base_url('user/thank_you'));

    	
    	// order_tbl => order_date, hotel_table_id, order_status, order_time
    	// order_products => order_id, product_id, qty, product_price, total 

    } 

    public function thank_you()
    {
    	$_SESSION['cart'] = [];
    	$this->load->view("user/thank_you");
    }

}
?>

  

<!-- CREATE TABLE order_tbl(
order_iD INT PRIMARY KEY AUTO_INCREMENT,
order_date DATE,
hotel_table_id INT,
order_time VARCHAR(10),
order_status VARCHAR(15)
); -->


<!-- CREATE TABLE order_products (
order_product_id INT PRIMARY KEY AUTO_INCREMENT,
order_id INT,
product_id INT,
qty INT,
product_price INT,
total INT
); -->

<!-- INSERT INTO order_products ('order_id', 'product_id', 'qty', 'product_price', 'total')
VALUES (13, 4, '3', '150', 450); -->