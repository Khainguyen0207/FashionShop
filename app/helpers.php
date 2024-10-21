<?php

use App\Models\AboutShopModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

if (!function_exists('getAboutShopData')) {
    function getAboutShopData() {
        $data = AboutShopModel::all()->keyBy('key')->toArray();
        $formattedData = [];
        $imageKeys = ['logo', 'banner'];

        foreach ($data as $key => $value) {
            if (in_array($key, $imageKeys)) {
                $formattedData[$key] = Storage::exists($value['value'])
                    ? Storage::url($value['value'])
                    : asset("assets/user/img/box.png");
            } else {
                $formattedData[$key] = json_decode($value['value'], true);
            }
        }
        return $formattedData;
    }
}

if (!function_exists('getHeader')) {
    function getHeader() {
        $data = getAboutShopData();
        $role = User::query()->where("id", Auth::id())->first();
        if (!isset($role->role)) {
            $role = 0;
        }
        $header = [
            "logo" => $data['logo'], 
            "role" => $role
        ];
        return $header ?? null; // Return logo or null if not set
    }
}

if (!function_exists('getFooter')) {
    function getFooter() {
        $data = getAboutShopData();
        $footer = [
            "social_network" => $data['social_network'], 
            "contact" => $data['contact']
        ];
        return $footer ?? null; // Adjust key as needed
    }
}

if (!function_exists('getBanner')) {
    function getBanner() {
        $data = getAboutShopData();
        $banner = [
            "banner" => $data['banner'], 
        ];
        return $banner ?? null; // Adjust key as needed
    }
}
