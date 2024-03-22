<?php

class Controller
{
    protected function model($model)
    {
        require_once 'app/Models/' . $model . '.php';
        return new $model();
    }

    protected function view($view, $data = [])
    {
        require_once 'app/Views/' . $view . '.php';
    }
}