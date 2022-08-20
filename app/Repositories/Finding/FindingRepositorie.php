<?php

namespace App\Repositories\Finding;

use App\Models\Finding;
use App\Repositories\BaseRepositorie;

class FindingRepositorie extends BaseRepositorie
{

    const RELATIONSHIP = ['area', 'user.employee', 'image_findings', 'tracings.image_tracings', 'tracings.user.employee'];


    function __construct(Finding $finding)
    {
        parent::__construct($finding, self::RELATIONSHIP);
    }

    public function all(int $limit)
    {
        return $this->model::select('*')
            ->with('user.employees', 'area', 'image_findings')
            ->withCount('tracings')
            ->orderBy('findings.id', 'DESC')
            ->paginate($limit);
    }
}
