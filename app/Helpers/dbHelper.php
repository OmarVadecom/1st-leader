<?php
// Defines
use App\Models\Funds;
use \App\Models\Contact as contact;
use \App\Models\Menu as menu;
use \App\Models\Page as page;
use \App\Models\Product as product;
use \App\Models\Setting as setting;
use \App\Models\Slider as slider;
use \App\Models\Social as social;
use App\Models\WarrantyNotification;

/**
 * Get website settings from database
 *
 * @return string setting
 */
if (!function_exists('getSettings')) {
    function getSettings($settingName = 'title', $original = false, $lang = 'ar')
    {
        $setting = setting::where('lang', $lang)->where('name', $settingName)->first();
        return $setting == null ? $settingName : ($original ? $setting->value : $setting->fulter_value);
    }
}

/**
 * Get website socials from database
 *
 * @return string social
 */

/**
 * Check if the given value is exists in the given table or not
 *
 * @return string value
 */
if (!function_exists('checkCount')) {
    function checkCount($table, $value, $field = 'slug')
    {
        $count = \DB::table($table)->where($field, $value)->count();
        $value = $count == 0 ? $value : $value . '-' . ($count + 1);
        return $value;
    }
}

/**
 * Get count to the given table (can put one condition)
 *
 * @return integer counter
 */
if (!function_exists('getCount')) {
    function getCount($table, $con = null, $val = null)
    {
        $q = \DB::table($table);
        $q = $con != null ? $q->where($con, $val) : $q;
        return $q->count();
    }
}

/**
 * Get unread contacts from database
 *
 * @return object data contact
 */
if (!function_exists('getUnreadContacts')) {
    function getUnreadContacts($limit = 15)
    {
        return contact::where('status', 0)->orderBy('created_at', 'desc')->take($limit)->get();
    }
}

if (!function_exists('getfunds')) {
    function getfunds()
    {
        $now = \Carbon\Carbon::today();
        return Funds::where('status', 0)->where('reading_status', 0)->where('date_from', '<=', $now)->get();
    }
}

if (!function_exists('getAllFunds')) {
    function getAllFunds()
    {
        $now = \Carbon\Carbon::today();
        return Funds::where('status', 0)->where('date_from', '<=', $now)->orderBy('created_at', 'desc')->get();
    }
}

//if (!function_exists('getfunds')) {
//    function getfunds($limit = 30)
//    {
//        $now = \Carbon\Carbon::today();
//        return Funds::where('status', 0)->where('date_from', '<=', $now)->orderBy('created_at', 'desc')->take($limit)->get();
//    }
//}

if (!function_exists('getWarrantyNotifications')) {
    function getWarrantyNotifications()
    {
        return WarrantyNotification::where('reading_status', 0)->get();
    }
}

if (!function_exists('getAllWarrantyNotifications')) {
    function getAllWarrantyNotifications()
    {
        return WarrantyNotification::orderBy('created_at', 'desc')->get();
    }
}

/**
 * Get Products with limit [ use for menu but it can help in meny places ]
 *
 * @return object data Product
 */

/**
 * Get Pages with limit [ use for menu but it can help in meny places ]
 *
 * @return object data Page
 */
if (!function_exists('getPages')) {
    function getPages($limit = 40)
    {
        return page::orderBy('created_at', 'desc')->take($limit)->get();
    }
}

/**
 * Get Website Menu where is active
 *
 * @return Object data menu
 */
if (!function_exists('getMenu')) {
    function getMenu()
    {
        return menu::where('status', 1)->orderBy('ordering', 'asc')->get();
    }
}

/**
 * Get Website Slider where is active
 *
 * @return Object data menu
 */
if (!function_exists('getSlider')) {
    function getSlider()
    {
        return slider::with('slidersLang')->where('status', 1)->where('type', 'homepage')->get();
    }
}

if (!function_exists('getSliderweb')) {
    function getSliderweb()
    {
        return slider::where('status', 1)->where('type', 'web-design-page')->get();
    }
}
