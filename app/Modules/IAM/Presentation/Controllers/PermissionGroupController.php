<?php

namespace App\Modules\IAM\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\IAM\Core\Application\Services\CreatePermissionGroup\CreatePermissionGroupRequest;
use App\Modules\IAM\Core\Application\Services\CreatePermissionGroup\CreatePermissionGroupService;
use App\Modules\IAM\Core\Application\Services\GetPermissionGroups\GetPermissionGroupsRequest;
use App\Modules\IAM\Core\Application\Services\GetPermissionGroups\GetPermissionGroupsService;
use App\Modules\Shared\Mechanism\UnitOfWork;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PermissionGroupController extends Controller
{
    public function __construct(private UnitOfWork $unit_of_work) {}

    public function index(Request $request, GetPermissionGroupsService $service): View
    {
        $page = $request->input('page', 1);
        $per_page = $request->input('per_page', 10);

        $permission_groups = $service->execute(
            new GetPermissionGroupsRequest(
                $request->input('q'),
                $page,
                $per_page,
                $request->fullUrlWithoutQuery(['page']),
            )
        );

        $data = [
            'title' => 'Permission Group',
            'slug' => 'permission-groups',
            'permission_groups' => $permission_groups
        ];

        return view('IAM::permission-group.index', $data);
    }

    /** @return View|RedirectResponse */
    public function add(Request $request, CreatePermissionGroupService $service)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'name' => 'required',
            ]);

            try {
                $this->unit_of_work->transaction(fn() => $service->execute(
                    new CreatePermissionGroupRequest(
                        $request->input('name'),
                        $request->input('permission_flag'),
                    )
                ));
            } catch (Exception $e) {
                return redirect()->back()->withInput()->with('alert.error', $e->getMessage());
            }

            return redirect()->route('permission-groups.index')->with('alert.success', 'Todo created successfully');
        }

        $data = [
            'title' => 'Add Permission Group',
            'slug' => 'permission-groups',
            'permission_group' => null
        ];

        return view('IAM::permission-group.edit', $data);
    }
}
