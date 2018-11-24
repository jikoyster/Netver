<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
                $view = 'system-setup.'.$subpage;
                break;
            case 'security':
                $view = 'system-setup.security.index';
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
