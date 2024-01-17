<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Models\Project;

class TypeController extends Controller
{
    public function show(Type $type)
    {
        $type->load([
            'projects' => function (Builder $query) {
                $query->with('technologies')->orderBy('updated_at', 'desc')->limit(10);
            }
        ]);

        return response()->json([
            'type' => $type
        ]);
    }
}
