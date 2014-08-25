<?php
namespace DevMediaLab;

class BaseView
{
    public $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function renderPage()
    {

    }
}