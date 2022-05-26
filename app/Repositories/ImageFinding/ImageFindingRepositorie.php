<?php

namespace App\Repositories\ImageFinding;

use App\Models\ImageFinding;
use App\Repositories\BaseRepositorie;

class ImageFindingRepositorie extends BaseRepositorie
{

    function __construct(ImageFinding $imageFinding)
    {
        parent::__construct($imageFinding);
    }
}
