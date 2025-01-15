<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CountryResource;
use App\Models\Country;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = CountryResource::collection(
            Country::where('is_active', true)
            ->orderByRaw('ISNULL(sequence), sequence ASC')
            ->orderBy('phone_code')
            ->get()
        );

        return $this->success('Successful', $countries);
    }
}
