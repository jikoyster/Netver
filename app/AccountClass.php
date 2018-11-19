<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountClass extends Model
{
    public function child_class()
    {
        return $this->hasMany('App\AccountClass','parent_id','id')->orderBy('id');
    }

    public function account_maps()
    {
        return $this->hasMany('App\AccountMap','account_class_id','id');
    }

    public function gcoas()
    {
        return $this->hasMany('App\GlobalChartOfAccount','account_class_id','id');
    }

    public function parent_class()
    {
        return $this->belongsTo('App\AccountClass','parent_id','id');
    }

    static function class_extractor($collection)
    {
        $final_collection_x = [];
        $ctr = $collection->count();

        for($a = 0; $a < $ctr; $a++) {
            $first = $collection[$a];

            $collection1 = $first->child_class;
            $ctr1 = $collection1->count();
            
            if($ctr1) {

                for($b = 0; $b < $ctr1; $b++) {
                    $second = $collection1[$b];

                    /******************************/
                    /*********** extend ***********/
                    /******************************/

                    $collection2 = $second->child_class;
                    $ctr2 = $collection2->count();

                    if($ctr2) {

                        for($c = 0; $c < $ctr2; $c++) {
                            $third = $collection2[$c];

                            /******************************/
                            /*********** extend ***********/
                            /******************************/

                            $collection3 = $third->child_class;
                            $ctr3 = $collection3->count();

                            if($ctr3) {

                                for($d = 0; $d < $ctr3; $d++) {
                                    $fourth = $collection3[$d];

                                    /******************************/
                                    /*********** extend ***********/
                                    /******************************/

                                    $collection4 = $fourth->child_class;
                                    $ctr4 = $collection4->count();

                                    if($ctr4) {

                                        for($e = 0; $e < $ctr4; $e++) {
                                            $fifth = $collection4[$e];

                                            if($e == 0)
                                                $final_collection3 = collect([$fourth])->concat([$fifth]);
                                            else
                                                $final_collection3 = $final_collection3->concat([$fifth]);
                                        }

                                    } else {
                                        if($d == 0)
                                            $final_collection3 = collect([$fourth]);
                                        else
                                            $final_collection3 = $final_collection3->concat([$fourth]);
                                    }

                                    /******************************/
                                    /********* end extend *********/
                                    /******************************/

                                    if($d == 0)
                                        $final_collection2 = collect([$third])->concat($final_collection3);
                                    else {
                                        if($ctr4)
                                            $final_collection2 = $final_collection2->concat($final_collection3);
                                        else
                                            $final_collection2 = $final_collection2->concat([$fourth]);
                                    }
                                }

                            } else {
                                if($c == 0)
                                    $final_collection2 = collect([$third]);
                                else
                                    $final_collection2 = $final_collection2->concat([$third]);
                            }

                            /******************************/
                            /********* end extend *********/
                            /******************************/

                            if($c == 0)
                                $final_collection1 = collect([$second])->concat($final_collection2);
                            else {
                                if($ctr3)
                                    $final_collection1 = $final_collection1->concat($final_collection2);
                                else
                                    $final_collection1 = $final_collection1->concat([$third]);
                            }
                        }

                    } else {
                        if($b == 0)
                            $final_collection1 = collect([$second]);
                        else
                            $final_collection1 = $final_collection1->concat([$second]);
                    }

                    /******************************/
                    /********* end extend *********/
                    /******************************/
                    
                    if($b == 0)
                        $final_collection = collect([$first])->concat($final_collection1);
                    else {
                        if($ctr2)
                            $final_collection = $final_collection->concat($final_collection1);
                        else
                            $final_collection = $final_collection->concat([$second]);
                    }
                }

            } else {

                if($a == 0)
                    $final_collection = collect([$first]);
                else
                    $final_collection = $final_collection->concat([$first]);

            }

            if($a == 0)
                $final_collection_x = $final_collection;
            else {
                if($ctr1)
                    $final_collection_x = $final_collection_x->concat($final_collection);
                else
                    $final_collection_x = $final_collection_x->concat([$first]);
            }
        }
        return $final_collection_x;
    }
}
