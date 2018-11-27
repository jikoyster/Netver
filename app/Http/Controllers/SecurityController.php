<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SecurityController extends Controller
{
    private function includeJQuery(){
        echo "<script type='text/javascript' src='https://code.jquery.com/jquery-3.3.1.min.js'></script>";
        echo "<style type='text/css'>
            .mr-auto{
                display: inline-table;
            }
            .m-content table{
                font-size:1em;
                font-weight: 300;
            }
            </style>";
        echo "<script type='text/javascript'>
                $(document).ready(function(){ 
                    $('#System-Setup.m-menu__item').addClass('m-menu__item--open');
                });
            </script>";
    }
    public function index(){
        return view('system-setup.security.index');
    }

    public function subpage($subpage){
        

        switch($subpage){
            case 'menus':
                $menus = DB::table('menu_sets')			
                // ->leftJoin('company_user', 'company_user.company_id', '=', 'companies.id')
                // ->where('companies.company_type','client')
                ->get();

                $view = 'system-setup.'.$subpage;
                return view($view, ['menus' => $menus]);
                break;
            case 'field-informations':
                $view = 'system-setup.'.$subpage;
                break;
            case 'security':
            case 'general':
            case 'users':
            case 'name-items-list':
                $view = 'system-setup.'. $subpage .'.index';
                break;
            
            default:
                $view = 'errors.404';
            break;
        }
        
        $this->includeJQuery();
        
        return view($view);
    }
    //END OF CLASS
}
