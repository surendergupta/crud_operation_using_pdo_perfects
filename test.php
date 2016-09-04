<?php

require_once('DBFunction/DBFunction.php');
$db = new DBFunction();

/************ get data with order by column in PDO ************/

//$order_by = "id desc";
//var_dump($results);
//$results = $db->get('store_categories',$order_by);


/************ get data by id in PDO ************/

//$id = 5;
//var_dump($results);
//$results = $db->get_where('store_categories',$id);


/************ get data with limit in PDO ************/

//$limit = 15;
//$offset = 0;
//var_dump($results);
//$results = $db->get_with_limit('store_accounts' , $limit, $offset, $order_by);


/************ get data with single column in PDO ************/

//$col = "last_name";
//$value = "Watson";
//var_dump($results);
//$results = $db->get_where_custom_single('store_accounts' , $col, $value);


/************ get data with multiple column in PDO ************/

//$data['item_price'] = "400";
//$data['status'] = "0";
//$results = $db->get_where_custom_multiple('store_items',$data);
//var_dump($results);


/************ get data with multiple column in PDO ************/

//$data['item_price'] = "400";
//$data['status'] = "0";
//$results = $db->get_where_custom_multiple('store_items',$data);
//foreach($results as $row)
//{
//    echo $row->id."<br>";
//    echo $row->item_title."<br>";
//}


/************ Insert Data in PDO ************/

//$data['item_price'] = "29000";
//$data['item_title'] = "Lumia 829T";
//$data['item_url'] = "Lumia-829T";
//$data['item_description'] = "Best Phone in Gaming Phone Ever.";
//$data['was_price'] = "29999";
//$data['status'] = "1";
//$results = $db->_insert('store_items',$data);
//echo $results;


/************ Update Data by id in PDO ************/

//$data['item_price'] = "19000";
//$data['item_title'] = "Lumia 729T";
//$data['item_url'] = "Lumia-729T";
//$data['item_description'] = "Best Phone in Business and Gaming Phone Ever.";
//$data['was_price'] = "19999";
//$data['status'] = "1";
//$results = $db->_update('store_items',$data, '7');
//echo $results;


/************ Update Data with column cond. in PDO ************/

//$fields['was_price'] = '19000';
//$fields['status'] = '1';
//$data['item_price'] = "49000";
//$data['item_title'] = "Lumia 929T";
//$data['item_url'] = "Lumia-929T";
//$data['item_description'] = "Best Phone in all aspect of requirement in mobile.";
//$data['was_price'] = "49999";
//$data['status'] = "1";
//$results = $db->_update_by_fields('store_items',$data, $fields);
//echo $results;


/************ Delete by id in PDO ************/

//$results = $db->_delete('store_items','8');
//if($results == true)
//{
//    echo "delete";
//}
//else
//{
//    echo "Not delete";
//}


/************ Delete With custom condition in PDO ************/

//$results = $db->_delete_where('store_items','id > ','6');
//if($results == true)
//{
//    echo "delete all";
//}
//else
//{
//    echo "Not delete";
//}


/************* Count Row with column and value in PDO ************/

//$col = "last_name";
//$value = "Watson";
////var_dump($results);
//$results = $db->count_where('store_accounts' , $col, $value);
//echo $results;


/********************* Check Max ID in PDO *********************/

//echo $db->get_max('store_accounts');


/********************* Check Custom query in PDO *********************/

//$mysql_query = "SELECT * FROM `store_accounts` WHERE `username` = '' ORDER BY `id` ASC";
//$results = $db->_custom_query($mysql_query);
//echo "total results".count($results)."<br><br><br><br><br>";
//foreach($results as $row)
//{
//    echo $row->id."<br>";
//}
