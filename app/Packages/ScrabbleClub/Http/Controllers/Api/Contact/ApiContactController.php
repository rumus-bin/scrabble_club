<?php

namespace Scrabble\Http\Controllers\Api\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Scrabble\Models\Enums\ContactType;

class ApiContactController extends Controller
{
    public function types(): JsonResponse
    {
        return response()->json(
            [
                'data' => ContactType::getTypeNames(),
            ]
        );
    }
}
