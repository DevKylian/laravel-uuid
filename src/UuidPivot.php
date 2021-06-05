<?php

namespace DevKylian\Uuid;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UuidPivot extends Pivot
{
    use HasUuid;
}
