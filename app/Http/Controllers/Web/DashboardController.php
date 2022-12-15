<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Service\DamageService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /** damages service class handle all logics related to damages
     * @var DamageService
     */
    private DamageService $damageService;

    public function __construct(
        DamageService $damageService
    )
    {
        $this->damageService = $damageService;
    }

    /**
     * Update damage status.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $id )
    {
        $request_data = $request->all();
        if( $this->damageService->updateDamageStatus($id, $request_data['status'])) {
            return redirect()->back()->withSuccess('Successfully update');
        } else {
            return redirect()->back()->withErrors('Error');
        }
    }

    /**
     * Show damage information and related all details .
     * - Customer details
     * - Damage description, images and rest of information
     * - assign repair shops and link
     *
     * @param $id
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $damage = $this->damageService->getDamage($id)['data'];
        $status_list = $this->damageService->getStatusList(); // list of damages status with labels

        return view('pages.damage.view', compact('id','damage', 'status_list'));
    }

    /**
     * Dashboard landing page.
     * showing summary of damages.
     * list of damages with pagination
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $all_damages = $this->damageService->getAll();
        $damage_summery = $this->damageService->getDamagesReportSummery();

        $damages = $all_damages['data']; // filter damages data for grid except rest of parameters

        return view('pages.dashboard', compact('damages', 'damage_summery'));
    }
}
