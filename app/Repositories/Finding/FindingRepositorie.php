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

    public function all(int $limit, $search)
    {
        return $this->model::select('*')
        ->where('description', 'like', '%'.$search.'%')
            ->with('user.employee', 'area', 'image_findings')
            ->withCount('tracings')
            ->orderBy('findings.id', 'DESC')
            ->paginate($limit);
    }
}
