<?php

namespace App\Toolkit;

use App\Models\Project;

class ProjectSetter implements ProjectSetterInterface
{
    public $model;

    public function __construct($id)
    {
        $this->model = Project::findOrFail($id);
    }

    public function getProperty()
    {
        return $this->model;
    }

}