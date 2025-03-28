<?php
class HomeController
{
    public function index()
    {
        $header = '../app/views/layouts/_header.php';
        $content = '../app/views/pages/user/home.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }

    public function home()
    {
        $header = '../app/views/layouts/_header.php';
        $content = '../app/views/pages/user/home.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }

    public function home2()
    {
        $header = '../app/views/layouts/_header.php';
        $content = '../app/views/pages/user/home2.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }
    public function about()
    {
        $content = '../app/views/pages/user/about.php';
        include_once "../app/views/layouts/default.php";
    }
}
