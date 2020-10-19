<?php

namespace App\Service;
use App\Repository\CategoryRepository;

class CategoryService{
    private $cr;

    public function __construct(CategoryRepository $cr)
    {
        $this->cr = $cr;
    }

    public function getAll(){
        return $this->cr->findAll([],["name"=>"asc"]);
    }
}