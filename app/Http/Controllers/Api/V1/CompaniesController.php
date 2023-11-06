<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CompanyPatchRequest;
use App\Http\Requests\Company\CompanyPostRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CompanyResource::collection(Company::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyPostRequest $request)
    {
        $url = null;

        if ($request->file('logo')) {
            $url = $request->file('logo')->store('logo', 'public');
        }

        $params = array_merge($request->validated(), [
            'logo' => $url
        ]);

        $company = Company::create(
            $params
        );

        if ($company) {
            return new CompanyResource($company);
        }

        return \response()->json([
            'status' => false
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyPatchRequest $request, Company $company)
    {
        $url = null;

        if ($request->file('logo')) {
            $url = $request->file('logo')->store('logo', 'public');
        }

        $params = array_merge($request->validated(), [
            'logo' => $url
        ]);

        $company->update(
            $params
        );

        if ($company) {
            return new CompanyResource($company->refresh());
        }

        return \response()->json([
            'status' => false
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $status = $company->delete();

        return response()->json(
            [
                'status' => $status
            ],
            $status ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }

    public function companiesSelect()
    {
        return CompanyResource::collection(Company::all());
    }
}
