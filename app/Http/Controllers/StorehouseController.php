<?php

namespace App\Http\Controllers;

use App\Services\StorehouseBalanceService;
use Illuminate\Http\Request;

class StorehouseController extends Controller
{
    public function __construct(
        public StorehouseBalanceService $storehouseBalanceService
    )
    {
    }

    public function index()
    {
        $balances = $this->storehouseBalanceService->getNomenclatureBalances();

        return inertia('StorehouseBalance', compact('balances'));
    }
}
