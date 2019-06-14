<?php
// core.php holds pagination variables
include_once '../config/core.php';
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/fag.php';
include_once '../objects/udd_og_fag.php';
include_once '../objects/udd.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$fag = new Fag($db);
$relation = new Relation($db);
$udd = new Uddannelse($db);
 
// get search term
$search_term=isset($_GET['s']) ? $_GET['s'] : '';
 
$page_title = "You searched for \"{$search_term}\"";
include_once "layout_head.php";
 
// query products
$stmt = $fag->search($search_term);
 
// specify the page where paging is used
$page_url="search.php?s={$search_term}&";


//TODO:count total rows - used for pagination
//$total_rows=$product->countAll_BySearch($search_term);
 
// read_template.php controls how the product list will be rendered
include_once "read_fag_template.php";
 
// layout_footer.php holds our javascript and closing html tags
include_once "layout_foot.php";
?>