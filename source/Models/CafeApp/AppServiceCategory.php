<?php


namespace Source\Models\CafeApp;


use Source\Core\Model;

class AppServiceCategory extends Model
{
    public function __construct()
    {
        parent::__construct("app_services_categories", ["id"], ["name", "type"]);
    }
}