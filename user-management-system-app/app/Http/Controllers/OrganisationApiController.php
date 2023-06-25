<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganisationRequest;
use App\Models\Organisation;
use Illuminate\Support\Facades\Auth;

class OrganisationApiController extends Controller
{
    public function store(StoreOrganisationRequest $request)
    {
        $validated = $request->validated();
        $validated['creator_id'] = Auth::id();

        $organisation = Organisation::create($validated);

        return response()->json($organisation, 201);
    }
}
