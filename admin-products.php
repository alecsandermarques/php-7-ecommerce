<?php

use \Amcommerce\PageAdmin;
use \Amcommerce\Model\User;
use \Amcommerce\Model\Product;

$app->get('/admin/products', function() {
    
    User::verifyLogin();

    $products = Product::listAll();
    
    $page = new PageAdmin();

	$page->setTpl("products",[
        "products"=>$products
    ]);

});

$app->get('/admin/products/create', function() {
    
    User::verifyLogin();
    
    $page = new PageAdmin();

	$page->setTpl("products-create");

});

$app->post('/admin/products/create', function() {
    
    User::verifyLogin();
    
    $product = new Product();

    $product->setData($_POST);

    $product->save();

    header("Location: /admin/products");
    exit;

});

//update para fazer 
$app->get('/admin/products/:idproduct', function($idproduct) {
    
    User::verifyLogin();

    $product = new Product();

    $product->get((int)$idproduct);
    
    $page = new PageAdmin();
    
    //passar os dados do produto pro template
	$page->setTpl("products-update",[
        'product'=>$product->getValues()
    ]);

});

$app->post('/admin/products/:idproduct', function($idproduct) {
    
    User::verifyLogin();

    $product = new Product();

    $product->get((int)$idproduct);
    
    $product->setData($_POST);

    $product->save();

    if ((int)$_FILES["file"]["size"] > 0) {
        $product->setPhoto($_FILES["file"]);
    }

    header("Location: /admin/products");
    exit;

});

$app->get('/admin/products/:idproduct/delete', function($idproduct) {
    
    User::verifyLogin();

    $product = new Product();

    $product->get((int)$idproduct);

    $product->delete();

    header("Location: /admin/products");
    exit;

});


?>
