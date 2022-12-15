<?php

namespace App\Http\Controllers\Web;

use App\Constant\Repair_shops_status;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\CreateShopRequest;
use App\Http\Requests\Shop\UpdateShopRequest;
use App\Service\RepairShopService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

/*
 * manage repair shop CRUD
 */
class RepairShopController extends Controller
{

    /** handle all logics repair shops management
     * @var RepairShopService
     */
    private RepairShopService $repairShopService;

    /** Repair shop status with labels
     * @var string[]
     */
    public $status_list;

    public function __construct(
        RepairShopService $repairShopService
    )
    {
        $this->repairShopService = $repairShopService;
        $this->status_list = Repair_shops_status::status;
    }

    /**
     * Display a listing of the repair shops with pagination.
     * - Show / Edit / Delete link for each record
     * - Add link to repair shop
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_shops = $this->repairShopService->getAllShops();
        $shops = $all_shops['data'];
        $status_list = $this->status_list;

        return view('pages.shops.index', compact('shops', 'status_list'));
    }

    /**
     * Show the form for creating a new repair shop.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status_list = $this->status_list;

        return view('pages.shops.create', compact('status_list'));
    }

    /**
     * Store a newly created repair shop in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateShopRequest $request)
    {
        $status = $this->repairShopService->createShop($request->all());

        if($status['status']){
            return redirect()->route('repair-shop.index')->with('success','Product created successfully');
        } else {
            return Redirect::back()->withErrors(['msg' => $status['msg']]);
        }
    }

    /**
     * Display the specified repair shop details.
     * Load repair shop by id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop = $this->repairShopService->getShopDetails($id);
        $status_list = $this->status_list;

        return view('pages.shops.show', compact('shop', 'status_list'));
    }

    /**
     * Show the form for editing the specified repair shop.
     * Load repair shop by id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shop = $this->repairShopService->getShopDetails($id);
        $status_list = $this->status_list;

        return view('pages.shops.edit', compact('shop', 'status_list'));
    }

    /**
     * Update the specified repair shop in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShopRequest $request, $id)
    {
        $status = $this->repairShopService->updateShop($id, $request->all());

        if($status['status']){
            return redirect()->route('repair-shop.index')->with('success','Product updated successfully');
        } else {
            return Redirect::back()->withErrors(['msg' => $status['msg']]);
        }
    }

    /**
     * Remove the specified repair shop from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = $this->repairShopService->deleteShop($id);

        if($status['status']){
            return redirect()->route('repair-shop.index')->with('success','Product deleted successfully');
        } else {
            return Redirect::back()->withErrors(['msg' => $status['msg']]);
        }
    }
}
