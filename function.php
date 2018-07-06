<?php

	date_default_timezone_set('Asia/Manila');
	function db(){
		return new PDO("mysql:host=localhost; dbname=emed;", "root", "");
	}

	function discount($orderid, $booklet){
		$db = db();
		$sql =  "UPDATE table_order set discount = 1, booklet = ? where orderid = ? ";
		$s= $db->prepare($sql);
		$s->execute(array($booklet, $orderid));
		$db=null;
	}

	function decline($orderid){
		$db = db();
		$sql =  "UPDATE table_order set discount = 0 where orderid = ? ";
		$s= $db->prepare($sql);
		$s->execute(array($orderid));
		$db=null;
	}
	
	function register_user($ufname, $ulname, $umi, $umail, $phone, $username, $password, $address, $birthdate, $pic){
		$db = db();
		$sql = "INSERT INTO tbl_user(ufname, ulname, umi, umail, phone, username, password, address, birthdate, pic) VALUES(?,?,?,?,?,?,?,?,?,?)";
		$s = $db->prepare($sql);
		$s->execute(array($ufname, $ulname, $umi, $umail, $phone, $username, $password, $address, $birthdate, $pic));
		$db=null;
	}
	
	function retreive_daily(){
		$db = db();
		$sql = "SELECT * FROM table_order WHERE DATE(orderdate) = CURDATE()";
		$s = $db->query($sql);
		$row = $s->fetchAll();
		$db=null;
		return $row;
	}

	function retreive_weekly(){
		$db = db();
		$sql = "SELECT * FROM table_order WHERE WEEK(orderdate) = WEEK(CURDATE())";
		$s = $db->query($sql);
		$row = $s->fetchAll();
		$db=null;
		return $row;
	}

	function retreive_monthly(){
		$db = db();
		$sql = "SELECT * FROM table_order WHERE MONTH(orderdate) = MONTH(CURDATE())";
		$s = $db->query($sql);
		$row = $s->fetchAll();
		$db=null;
		return $row;
	}

	function retreive_yearly(){
		$db = db();
		$sql = "SELECT * FROM table_order WHERE YEAR(orderdate) = YEAR(CURDATE())";
		$s = $db->query($sql);
		$row = $s->fetchAll();
		$db=null;
		return $row;
	}

	function retreive_cart(){
		$db = db();
		$sql = "SELECT * FROM cart";
		$s = $db->query($sql);
		$row = $s->fetchAll();
		$db = null;
		return $row;
	}

	function retreive_order(){
		$db = db();
		$sql = "SELECT * FROM table_order group by orderid";
		$s = $db->query($sql);
		$order = $s->fetchAll();
		$db = null;
		return $order;
	}

	function retreive_deliverer(){
		$db = db();
		$sql = "SELECT * FROM pharmacist where pos = 'delivery staff'";
		$s = $db->query($sql);
		$row = $s->fetchAll();
		$db = null;
		return $row;
	}


	function retreive_delivery(){
		$db = db();
		$sql = "SELECT * FROM tbl_delivery";
		$s = $db->query($sql);
		$order = $s->fetchAll();
		$db = null;
		return $order;
	}

	function retreive_orders(){
		$db = db();
		$sql = "SELECT * FROM tbl_orderitem";
		$s = $db->query($sql);
		$order = $s->fetchAll();
		$db = null;
		return $order;
	}

	function retreive_employee_by_id($pharmaid){
		$db = db();
		$sql = "SELECT * FROM pharmacist WHERE pharmaid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($pharmaid));
		$item = $s->fetch();
		$db = null;
		return $item;
	}

	function retreive_user(){
		$db = db();
		$sql = "SELECT * FROM tbl_user";
		$s = $db->query($sql);
		$row = $s->fetchAll();
		$db = null;
		return $row;
	}
	function retreive_users(){
		$db = db();
		$sql = "SELECT * FROM tbl_user order by userid desc limit 1";
		$s = $db->query($sql);
		$row = $s->fetchAll();
		$db = null;
		return $row;
	}

	function retreive_item(){
		$db = db();
		$sql = "SELECT * FROM item WHERE DATE(expiration) > DATE(NOW()) ORDER BY itemid";
		$s = $db->query($sql);
		$row = $s->fetchAll();
		$db=null;
		return $row;
	}

	function retreive_items(){
		$db = db();
		$sql = "SELECT * FROM item WHERE DATE(expiration) > DATE(NOW()) group by itemname order by itemid ";
		$s = $db->query($sql);
		$row = $s->fetchAll();
		$db=null;
		return $row;
	}

	function retreive_itemss(){
		$db = db();
		$sql = "SELECT * FROM item WHERE DATE(expiration) < DATE(NOW()) group by itemname order by itemid ";
		$s = $db->query($sql);
		$row = $s->fetchAll();
		$db=null;
		return $row;
	}

	function retreive_employees(){
		$db = db();
		$sql = "SELECT * FROM pharmacist ORDER BY fname";
		$s = $db->query($sql);
		$row = $s->fetchAll();
		$db=null;
		return $row;
	}

	function retreive_address($id){
		$db = db();
		$sql = "SELECT * FROM address WHERE userid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($id));
		$user = $s->fetchAll();
		$db=null;
		return $user;
	}


	function retreive_item_by_id($itemid){
		$db = db();
		$sql = "SELECT * FROM item WHERE itemid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($itemid));
		$item = $s->fetch();
		$db = null;
		return $item;
	}

	function retreive_orderid($orderid){
		$db = db();
		$sql = "SELECT * FROM table_order where orderid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($orderid));
		$item = $s->fetch();
		$db = null;
		return $item;
	}

	function retreive_delivery_byid($deliverid){
		$db = db();
		$sql = "SELECT * FROM tbl_deliveryorders where deliverid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($deliverid));
		$item = $s->fetchAll();
		$db = null;
		return $item;
	}


	function retreive_feedback(){
		$db = db();
		$sql = "SELECT * FROM tbl_feedback ORDER BY feedbackid desc";
		$s = $db->query($sql);
		$row = $s->fetchAll();
		$db = null;
		return $row;
	}

	function retreive_order_by_user($userid){
		$db = db();
		$sql = "SELECT * FROM table_order WHERE userid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($userid));
		$order = $s->fetchAll();
		$db=null;
		return $order;
	}

	function retreive_cart_by_id($cartid){
		$db = db();
		$sql = "SELECT * FROM cart WHERE cartid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($cartid));
		$cart = $s->fetch();
		$db = null;
		return $cart;
	}

	function retreive_user_by_id($userid){
		$db = db();
		$sql = "SELECT * FROM tbl_user WHERE userid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($userid));
		$user = $s->fetch();
		$db = null;
		return $user;
	}

	function retreive_item_by_category($cat){
		$db = db();
		$sql = "SELECT * FROM item where itemsubcategory like '%$cat%' OR itemcategory = $cat GROUP BY itemname";
		$s = $db->prepare($sql);
		$s->execute(array($cat));
		$item = $s->fetchAll();
		$db = null;
		return $item;
	}

	
	function checkout($userid, $cartid, $address, $orderdate){
		$db=db();
		$sql="INSERT INTO orders(userid, cartid, addressid, orderdate) VALUES(?,?,?,?)";
		$s = $db->prepare($sql);
		$s->execute(array($userid, $cartid, $address, $orderdate));
		$db=null;
	}

	function add_address($userid, $muni, $street, $barangay, $prov, $landmark){
		$db = db();
		$sql="INSERT INTO address(userid, muni, street, barangay, prov, landmark) VALUES(?,?,?,?,?,?)";
		$s = $db->prepare($sql);
		$s->execute(array($userid, $muni, $street, $barangay, $prov, $landmark));
		$db=null;
	}

	function addfeedback($description, $userid, $email, $name){
		$db =  db();
		$sql = "INSERT INTO tbl_feedback(description, userid, email, name) values(?,?,?,?)";
		$s = $db->prepare($sql);
		$s->execute(array($description, $userid, $email, $name));
		$db = null;
	}

	function additem($itemcategory, $itemname, $generics, $brand, $price, $measurement, $dosage, $qty, $picture, $itemsubcategory, $supplier,  $manufacturers, $markup, $expiration, $location){
		$db = db();
		$sql = "INSERT INTO item(itemcategory, itemname, generics, brand, price, measurement, dosage, qty, picture, itemsubcategory, supplier,  manufacturers, markup, expiration, location) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$s = $db->prepare($sql);
		$s->execute(array($itemcategory, $itemname, $generics, $brand, $price, $measurement, $dosage, $qty, $picture, $itemsubcategory, $supplier,  $manufacturers, $markup, $expiration, $location));
		$db = null;
	}

	function addpharmacist($fname, $mi, $lname ,$phone, $email, $username, $password, $licenseno, $pos){
		$db = db();
		$sql = "INSERT INTO pharmacist(fname, mi, lname ,phone, email, username, password, licenseno, pos) VALUES(?,?,?,?,?,?,?,?,?)";
		$s = $db->prepare($sql);
		$s->execute(array($fname, $mi, $lname ,$phone, $email, $username, $password, $licenseno, $pos));
		$db = null;
	}

	function addadmin($fname, $mi, $lname, $phone, $email, $username, $password, $address, $birthdate, $gender){
		$db = db();
		$sql = "INSERT INTO admin(fname, mi, lname ,phone, email, username, password, address, birthdate, gender) VALUES(?,?,?,?,?,?,?,?,?,?)";
		$s = $db->prepare($sql);
		$s->execute(array($fname, $mi, $lname ,$phone, $email, $username, $password, $address, $birthdate, $gender));
		$db = null;
	}

	function addtocart($itemid, $userid, $qtyordered, $picture){
		$db = db();
		$sql = "INSERT INTO cart(itemid, userid, qtyordered, picture) VALUES(?,?,?,?)";
		$s = $db->prepare($sql);
		$s->execute(array($itemid, $userid, $qtyordered, $picture));
		$db = null;	
	}

	function delete_cart($id){
		$db = db();
		$sql =  "DELETE FROM cart WHERE cartid = $id";
		$s = $db->prepare($sql);
		$s->execute(array($id));
		$db = null;
	}

	function updateemployee($pharmaid, $fname, $mi, $lname, $phone, $email, $username, $password, $licenseno, $pos){
		$db = db();
		$sql = "UPDATE pharmacist SET fname = ?, mi = ?, lname = ?, phone = ?, email = ?, username = ?, password = ?, licenseno = ?, pos = ? WHERE pharmaid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($fname, $mi, $lname, $phone, $email, $username, $password, $licenseno, $pos, $pharmaid));
		$db = null;
	}

	function update_delivery_status($deliverid, $status, $encharge){
		$db = db();
		$sql = "UPDATE tbl_delivery SET status = ?, encharge = ? WHERE deliverid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($status, $encharge, $deliverid));
		$db = null;
	}	

 

	function approve($userid, $discountid){
		$db = db();
		$sql = "UPDATE tbl_user SET discountid = ? WHERE userid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($discountid, $userid));
		$db = null;
	}	

	function update($orderid, $delivered){
		$db = db();
		$sql = "UPDATE table_order SET delivered = ? WHERE orderid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($delivered, $orderid));
		$db = null;
	}

	function update_order_status($orderid, $status){
		$db = db();
		$sql = "UPDATE table_order SET status = ? WHERE orderid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($status, $orderid));
		$db = null;
	}

	function update_cart($cartid, $qtyordered){
		$db = db();
		$sql = "UPDATE cart SET qtyordered = ? WHERE cartid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($qtyordered, $cartid));
		$db = null;
	}

	function update_payment($orderid){
		$db = db();
		$sql = "UPDATE table_order SET paid = 1 WHERE orderid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($orderid));
		$db = null;
	}

	function retreivedate(){
		$db = db();
		$sql = "SELECT orderdate FROM table_order WHERE DATE_FORMAT(orderdate, '%D')";
		$s = $db->query($sql);
		$row = $s->fetchAll(PDO::FETCH_ASSOC);
		$db=null;
		return $row;
	}
	

	function update_item_qty($itemid, $qty){
		$db = db();
		$sql = "UPDATE item SET qty = ? WHERE itemid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($qty, $itemid));
		$db = null;
	}

	function update_cart_item_status($userid, $cartid, $status){
		$db = db();
		$sql = "UPDATE cart SET status = ? WHERE userid = ? AND cartid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($status, $userid, $cartid));
		$db = null;
	}

	function update_user_by_id($userid, $ufname, $umi, $ulname, $umail, $phone){
		$db = db();
		$sql = "UPDATE tbl_user SET ufname = ?, umi = ?, ulname =  ?, umail = ?, phone = ? where userid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($ufname, $umi, $ulname, $umail, $phone, $userid));
		$db = null;
	}

	function update_item($itemid, $itemcategory, $itemname, $generics, $brand, $price, $measurement, $dosage, $qty, $picture, $itemsubcategory, $supplier,  $manufacturers, $markup, $expiration, $location){
		$db = db();
		$sql = "UPDATE item SET itemcategory = ?, itemname = ?, generics = ?, brand = ?, price = ?, measurement = ?, dosage = ?, qty = ?, picture = ?, itemsubcategory = ?, supplier = ?, manufacturers = ?, markup = ?, expiration = ?, location = ? WHERE itemid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($itemcategory, $itemname, $generics, $brand, $price, $measurement, $dosage, $qty, $picture, $itemsubcategory, $supplier,  $manufacturers, $markup, $expiration, $location, $itemid));
		$db = null;
	}

	function update_items($itemid, $itemcategory, $itemname, $generics, $brand, $price, $measurement, $dosage, $qty, $itemsubcategory, $supplier,  $manufacturers, $markup, $expiration, $location){
		$db = db();
		$sql = "UPDATE item SET itemcategory = ?, itemname = ?, generics = ?, brand = ?, price = ?, measurement = ?, dosage = ?, qty = ?, itemsubcategory = ?, supplier = ?, manufacturers = ?, markup = ?, expiration = ?, location = ? WHERE itemid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($itemcategory, $itemname, $generics, $brand, $price, $measurement, $dosage, $qty, $itemsubcategory, $supplier,  $manufacturers, $markup, $expiration, $location, $itemid));
		$db = null;
	}




//--------------------------------------------------------------------------------------testing
	function view_cart($itemid, $userid){
		$db = db();
		$sql = "SELECT * FROM cart WHERE itemid = ? AND userid = ?";
		$s = $db->prepare($sql);
		$s->execute(array($itemid, $userid));
		$cart = $s->fetchAll();
		$db = null;
		return $cart;
	}

	function retreive_order_id(){
		$db = db();
		$sql = "SELECT * FROM table_order";
		$s = $db->query($sql);
		$row = $s->fetchAll();
		$db=null;
		return $row;
	}

	function check($orderid, $cartid, $orderdate, $userid){
		$db = db();
		$sql = "INSERT INTO tbl_orderitem(orderid, cartid, orderdate,  userid) VALUES(?,?,?,?)";
		$s = $db->prepare($sql);
		$s->execute(array($orderid, $cartid, $orderdate, $userid));
		$db = null;	
	}
	function check_paypal($orderid, $cartid, $orderdate, $userid, $status){
		$db = db();
		$sql = "INSERT INTO tbl_orderitem(orderid, cartid, orderdate,  userid, status) VALUES(?,?,?,?,?)";
		$s = $db->prepare($sql);
		$s->execute(array($orderid, $cartid, $orderdate, $userid, $status));
		$db = null;	
	}

	function orders($userid, $orderdate, $payment, $address, $status){
		$db = db();
		$sql = "INSERT INTO table_order(userid, orderdate, payment, address, status) VALUES(?,?,?,?,?)";
		$s = $db->prepare($sql);
		$s->execute(array($userid,  $orderdate,  $payment, $address,  $status));
		$db = null;	
	}

	function delivery($ddate, $status){
		$db = db();
		$sql = "INSERT INTO tbl_delivery(ddate, status) VALUES(?,?)";
		$s = $db->prepare($sql);
		$s->execute(array($ddate, $status));
		$db = null;	
	}

	function deliveries($deliverid, $orderid){
		$db = db();
		$sql = "INSERT INTO tbl_deliveryorders(deliverid, orderid) VALUES(?,?)";
		$s = $db->prepare($sql);
		$s->execute(array($deliverid, $orderid));
		$db = null;	
	}

	function track_order_by_id($userid){
		$db = db();
		$sql = "SELECT * FROM table_order, tbl_orderitem where table_order.userid = $userid AND tbl_orderitem.userid = $userid group by tbl_orderitem.orderid order by tbl_orderitem.orderid  desc";
		$s = $db->query($sql);
		$row = $s->fetchAll();
		$db=null;
		return $row;
	}

	function track_order_by_ids($userid){
		$db = db();
		$sql = "SELECT * FROM table_order, tbl_orderitem where table_order.orderid = $userid AND tbl_orderitem.orderid = $userid group by tbl_orderitem.cartid";
		$s = $db->query($sql);
		$row = $s->fetchAll();
		$db=null;
		return $row;
	}

	function track_orderdate_by_ids($userid){
		$db = db();
		$sql = "SELECT * FROM table_order, tbl_orderitem where table_order.orderid = $userid AND tbl_orderitem.orderid = $userid group by tbl_orderitem.orderid";
		$s = $db->query($sql);
		$row = $s->fetchAll();
		$db=null;
		return $row;
	}

	function track_date($userid){
		$db = db();
		$sql = "SELECT * FROM table_order, tbl_orderitem where table_order.userid = $userid AND tbl_orderitem.userid = $userid group by tbl_orderitem.cartid";
		$s = $db->query($sql);
		$row = $s->fetchAll();
		$db=null;
		return $row;
	}

	function search($search){
		$db = db();
		$sql = "SELECT * FROM item WHERE generics like '%$search%' OR brand like '%$search%' GROUP BY generics";
		$s = $db->prepare($sql);
		$s->execute(array($search));
		$item = $s->fetchAll();
		$db = null;
		return $item;
	}

	function deactivate($itemid){
		$db = db();
		$sql= "UPDATE item set status = 1 where itemid = ?";
		$s=$db->prepare($sql);
		$s->execute(array($itemid));
		$db = null;
	}
?>
