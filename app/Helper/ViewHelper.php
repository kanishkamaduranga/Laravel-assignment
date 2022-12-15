<?php

namespace App\Helper;

/*
 * Helper functions for UI related components
 */
class ViewHelper
{

    /**
     * handle damage reports status title and css class
     *
     * @param $status
     * @return string[]|\string[][]|null
     */
    public static function returnStatusInformations($status = null){

        $status_list = [
            'deleted' => [
                'title' => 'Deleted',
                'class' => 'px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700'
            ],
            'rejected' => [
                'title' => 'Rejected',
                'class' => 'px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700'
            ],
            'approved' => [
                'title' => 'Approved',
                'class' => 'px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100'
            ],
            'pending' => [
                'title' => 'Pending',
                'class' => 'px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600'
            ],
        ];

        return ($status) ? isset($status_list[$status]) ? $status_list[$status] : null : $status_list;
    }

    /**
     * Generate and return damage report status label
     *
     * @param $status_info
     * @return string
     */
    public static function generageStatusView($status_info)
    {
        return '<span class="'.$status_info['class'].'" >'.$status_info['title'].'</span>';
    }

}
