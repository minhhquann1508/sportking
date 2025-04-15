<?php
require_once '../app/models/Home.php';
require_once '../app/models/Products.php';
require_once '../app/models/Brand.php';
require_once '../app/models/Category.php';
class HomeController
{
    private $productModel;
    private $brandModel;
    private $categoryModel;
    private $homeModel;
    public function __construct()
    {
        $this->homeModel = new Home();
        $this->productModel = new Products();
        $this->brandModel = new Brand();
        $this->categoryModel = new Category();
    }
    public function index()
    {
        $categories = $this->homeModel->get_all_categorys();
        $brands = $this->homeModel->get_all_brands();
        $productList = $this->homeModel->get_all_products();


        $header = '../app/views/layouts/_header.php';
        $content = '../app/views/pages/user/home2.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }
    public function detail()
    {
        $content = '../app/views/pages/user/detail.php';
        $header = '../app/views/layouts/_header.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }
    public function about()
    {
        $content = '../app/views/pages/user/about.php';
        $header = '../app/views/layouts/_header.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }
    public function product()
    {
        // Lấy các tham số từ GET
        $category = isset($_POST['category']) ? $_POST['category'] : '';
        $brand = isset($_POST['brand']) ? $_POST['brand'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : '';

        $productList = $this->homeModel->get_filtered_products($category, $brand, $price);
        $categories = $this->homeModel->get_all_categorys();
        $brands = $this->homeModel->get_all_brands();

        $content = '../app/views/pages/user/product.php';
        $header = '../app/views/layouts/_header.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }
    public function order()
    {
        $content = '../app/views/pages/user/order.php';
        $header = '../app/views/layouts/_header.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }
    public function checkout()
    {
        $content = '../app/views/pages/user/checkout.php';
        $header = '../app/views/layouts/_header.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }

    public function test()
    {
        $content = '../app/views/pages/user/test.php';
        $header = '../app/views/layouts/_header.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }
}
