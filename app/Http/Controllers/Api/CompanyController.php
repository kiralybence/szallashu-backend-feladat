<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Company\IndexRequest;
use App\Http\Requests\Api\Company\ShowRequest;
use App\Http\Requests\Api\Company\StoreRequest;
use App\Http\Requests\Api\Company\UpdateRequest;
use App\Models\Company;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    /**
     * List all companies in the database.
     *
     * @param IndexRequest $request
     * @return JsonResponse
     */
    public function index(IndexRequest $request): JsonResponse
    {
        $companies = Company::query();

        if ($request->filled('companyIds')) {
            $companies->whereIn('companyId', $request->input('companyIds'));
        }

        $companies = $companies->get();

        return response()->json($companies);
    }

    /**
     * Fetch a certain company from the database.
     *
     * @param ShowRequest $request
     * @param Company $company
     * @return JsonResponse
     */
    public function show(ShowRequest $request, Company $company): JsonResponse
    {
        return response()->json($company);
    }

    /**
     * Store a new company in the database.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $company = Company::query()->create($request->validated());

        return response()->json($company, 201);
    }

    /**
     * Update an existing company from the database.
     *
     * @param UpdateRequest $request
     * @param Company $company
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Company $company): JsonResponse
    {
        $company->update($request->validated());

        return response()->json($company);
    }
}
