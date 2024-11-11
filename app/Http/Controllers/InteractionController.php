<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InteractionService;

class InteractionController extends Controller
{
    protected $interact;
    public function __construct(InteractionService $interact)
    {
        $this->interact = $interact;
    }

    public function index()
    {
        return $this->interact->getAllInteractions();
    }

    public function show($id)
    {
        return $this->interact->getUserInteractions($id);
    }

    public function store(Request $request)
    {
        return $this->interact->insertNewInteraction($request);
    }

    public function update(Request $request, $id)
    {
        return $this->interact->updateInteraction($request, $id);
    }

    public function destroy($id)
    {
        return $this->interact->deleteInteraction($id);
    }
}
