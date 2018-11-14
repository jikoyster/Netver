<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\MenuRole;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function authenticate_local()
    {
        if(auth()->user()->hasRole('system admin') || auth()->user()->hasRole('super admin')) {
            return true;
        } else {
            $link = $this->getLinkMan();
            $groups = auth()->user()->groups();
            $menu_id = 'x';
            if($groups->count()) {
                $menu_sets = $groups->first()->menu_sets();
                if($menu_sets->count()) {
                    $menu = $menu_sets->first()->menus()->where('link',$link);
                    $menu_id = $menu->count() ? $menu->first()->id : 'x'; //to be continued (for exact menu_id)
                }
            }
            return MenuRole::where('model_id',$menu_id)->where('role_id',auth()->user()->roles->first()->id)->where('model_type','App\Menu')->count() ? true:false;
        }
    }

    public function firstLogin()
    {
        if(auth()->user()->groups()->where('group_id',2)->count()) {
            if(!auth()->user()->companies->count())
                return false;
            if(!auth()->user()->owned_companies->count())
                return false;
            if(!auth()->user()->companies->first()->company_email)
                return true;
        }
    }

    public function getLinkMan()
    {
        $link = request()->segment(1);
        for($ctr = 2; $ctr <= 4; $ctr++) {
            $link .= request()->segment($ctr) ? '/'.request()->segment($ctr) : '';
        }
        return $link;
    }

    static function error_message($num = null)
    {
        switch ($num) {
            case 1:
                $message = 'Your Role is not allowed.';
                break;
            case 2:
                $message = 'Super Admin Only.';
                break;
            case 3:
                $message = 'Accountants Only.';
                break;
            case 4:
                $message = 'No Company yet.';
                break;
            case 5:
                $message = 'Please select first Company.';
                break;
            default:
                $message = 'Invalid';
                break;
        }
        return $message;
    }

    public function selected_company()
    {
        return (session('selected-company')) ? true : false;
    }
}
