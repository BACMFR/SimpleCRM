<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AdminService;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        return $this->adminService->getAllUsers();
    }

    public function store(Request $request)
    {
        return $this->adminService->insertNewUser($request);
    }

    public function update(Request $request, $id)
    {
        return $this->adminService->updateUser($request, $id);
    }

    public function destroy($id)
    {
        return $this->adminService->deleteUser($id);
    }
}
