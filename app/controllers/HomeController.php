<?php

class HomeController extends Controller
{
    public function index(): void
    {
        $properties = (new PropertyModel($this->db()))->getAll();
        $this->view('pages/index', ['properties' => $properties, 'pageTitle' => 'Prime Estates']);
    }

    public function about(): void
    {
        $this->view('pages/about', ['pageTitle' => 'About Us']);
    }

    public function services(): void
    {
        $this->view('pages/services', ['pageTitle' => 'Services']);
    }

    public function contact(): void
    {
        $this->view('pages/contact', ['pageTitle' => 'Contact Us']);
    }
}
