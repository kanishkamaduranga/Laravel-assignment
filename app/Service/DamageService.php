<?php

namespace App\Service;

use App\Helper\ViewHelper;
use App\Models\Media;
use App\Repositories\Customer\CustomerInterface;
use App\Repositories\Damage\DamageInterface;
use App\Repositories\Shops\ShopsInterface;

class DamageService
{
    private DamageInterface $damage_interface; // call damage repository
    private ViewHelper $viewHelper;
    private ShopsInterface $shops_interface;
    private CustomerInterface $customer_interface;

    public function __construct(
        DamageInterface $damage_interface,
        ViewHelper $viewHelper,
        ShopsInterface $shops_interface,
        CustomerInterface $customer_interface
    )
    {
        $this->damage_interface = $damage_interface;
        $this->viewHelper = $viewHelper;
        $this->shops_interface = $shops_interface;
        $this->customer_interface = $customer_interface;
    }

    /**
     * Update damage report status
     *
     * @param $id
     * @param $status
     * @return bool
     */
    public function updateDamageStatus($id, $status)
    {
        $repair_shops_ids = null;

        if( $this->damage_interface->updateDamageStatus($id, $status))
        {
            if('approved'== $status) { // Send approval email to customer

                $this->afterDamageApprovalAssingShops($id);

                $damage_data = $this->damage_interface->getDamage($id)['data']; // get Damage data
                $details['email'] = $damage_data->customer->email;
                dispatch(new \App\Jobs\SendEmailJob($details));
            }
            return true;
        }
        return false;
    }

    /**
     * After approved the damage assign repair shops
     *
     * @param $damage_id
     * @return void
     */
    public function afterDamageApprovalAssingShops($damage_id)
    {
        $repair_shops_ids = $this->shops_interface->findTheShops($damage_id); // select repair shop
        $this->damage_interface->addRepairShops($damage_id, $repair_shops_ids); // assign repair shops to damage report
        //TODO shop location process not defined properly. need to upgrade
    }

    public function getStatusList()
    {
        return $list = $this->viewHelper->returnStatusInformations();
    }

    /**
     * Save Images for creating and updating records
     *
     * @param $damage_id
     * @param $request
     * @return array
     */
    public function saveImages($damage_id, $request)
    {
        $allowedfileExtension=['pdf','jpg','png'];
        $files = $request->file('image');
        $msg = [];
        $status = true;

        if ( $files) {
            foreach ($request->image as $mediaFiles) {
                $extension = $mediaFiles->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);

                $name = $mediaFiles->getClientOriginalName();
                if ($check) {

                    $media_no_ext = pathinfo($name, PATHINFO_FILENAME);
                    $mFiles = str_replace(' ', '', $media_no_ext) . '-' . uniqid() . '.' . $extension;
                    $save_location = '/images/' . $damage_id . '/';
                    $path = public_path() . $save_location;
                    $mediaFiles->move($path, $mFiles);

                    $media = new Media();
                    $media->title = $name;
                    $media->path = $save_location . $mFiles;
                    $media->damages_id = $damage_id;
                    $media->save();
                } else {
                    $msg['msg'][] = $extension . ' : invalid_file_format';
                    $status =  false;
                }
            }
        }

        return [
            'status' => $status,
            'msg'   => $msg
        ];
    }

    /**
     * Update existing damage report with images
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updateDamage($request, $id)
    {
        $damage_data = $this->damage_interface->updateDamage($request, $id);

        if($damage_data['status']){
            if( $damage_data['data']) {

                $damage_id = $damage_data['damage_id'];

                $images = $this->saveImages( $damage_id, $request); // Add images

                if(!$images['status']){
                    $damage_data['msg'][] = $images['msg'];
                }
            } else {
                $damage_data['status'] = false;
                $damage_data['code'] = 1002; // add code information not available
            }
        }
        return $damage_data;
    }

    /**
     * Save damage report with images
     * @param $request
     * @return mixed
     */
    public function saveDamage($request)
    {
        $damage_data = $this->damage_interface->saveDamage($request);

        if($damage_data['status']){
            if( $damage_data['data']) {

                $damage_id = $damage_data['damage_id'];

                $images = $this->saveImages( $damage_id, $request);  // Add images

                if(!$images['status']){
                    $damage_data['msg'][] = $images['msg'];
                }
            } else {
                $damage_data['status'] = false;
                $damage_data['code'] = 1002; // add code information not available
            }
        }
        return $damage_data;
    }

    /** get damage information
     * @param $id
     * @return mixed
     */
    public function getDamage($id)
    {
        $damage_data = $this->damage_interface->getDamage($id);

        if($damage_data['status']){
            if( !$damage_data['data']){
                $damage_data['status'] = false;
                $damage_data['code'] = 1002; // add code information not available
            }
        }
        return $damage_data;
    }

    /**
     * find damage reports created by customer
     *
     * @param $customer_id
     * @return mixed
     */
    public function getAll($customer_reference = null)
    {
        $damages_data = $this->damage_interface->getAll( $customer_reference);

        if($damages_data['status']){
            if( !count($damages_data['data'])) {
                $damages_data['status'] = false;
                $damages_data['code'] = 1002; // add code information not available
            }
        }
        return $damages_data;
    }

    /**
     * Summarise damage reports for the dashboard
     *
     * @return array
     */
    public function getDamagesReportSummery()
    {
        return [
            'all'       => $this->damage_interface->getDamagesCount(),
            'deleted'   => $this->damage_interface->getDamagesCount('deleted'),
            'rejected'  => $this->damage_interface->getDamagesCount('rejected'),
            'approved'  => $this->damage_interface->getDamagesCount('approved'),
            'pending'   => $this->damage_interface->getDamagesCount('pending'),
        ];
    }
}
