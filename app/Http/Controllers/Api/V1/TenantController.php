<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::all();

        return response()->json($tenants);
    }

    public function show(Tenant $tenant)
    {
        return response()->json($tenant);
    }

    public function update(Tenant $tenant, Request $request)
    {
        $tenant->update($request->all());

        return response()->json($tenant);
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();

        return response()->json($tenant);
    }
}
