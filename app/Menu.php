<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function menu_set()
    {
        return $this->belongsTo('App\MenuSet','menu_set_id','id');
    }

    public function roles()
    {
    	return $this->belongsToMany('Spatie\Permission\Models\Role','model_has_roles','model_id','role_id')->wherePivot('model_type','App\Menu');
    }

    /*public function groups()
    {
        return $this->belongsToMany('App\Group')->withTimestamps();
    }*/

    public function child_menu()
    {
        return $this->hasMany('App\Menu','parent_id','id')->orderBy('order');
    }

    public function parent_menu()
    {
        return $this->belongsTo('App\Menu','parent_id','id');
    }

    public function scopeChildren($query, $id)
    {
        return $query->where('parent_id', $id);
    }

    public function scopeParent($query, $id, $link)
    {
        $hold = $query->where('link',$link);
        if($hold->count()) {
            if($hold->first()->parent_id != '') {
                if($hold->first()->parent_id == $id)
                    return true;
                else {
                    $newHold = $hold->first()->where('id',$hold->first()->parent_id);
                    if($newHold->first()->parent_id == $id) {
                        return true;
                    } else {
                        $newHold1 = $newHold->first()->where('id',$newHold->first()->parent_id);
                        if($newHold1->count() && $newHold1->first()->parent_id == $id)
                            return true;
                        else {
                            if($newHold1->count()) {
                                $newHold2 = $newHold1->first()->where('id',$newHold1->first()->parent_id);
                                if($newHold2->count() && $newHold2->first()->parent_id == $id)
                                    return true;
                                else
                                    return false;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    static function menu_extractor($collection)
    {
        $final_collection_x = [];
        $ctr = $collection->count();

        for($a = 0; $a < $ctr; $a++) {
            $first = $collection[$a];

            $collection1 = $first->child_menu;
            $ctr1 = $collection1->count();
            
            if($ctr1) {

                for($b = 0; $b < $ctr1; $b++) {
                    $second = $collection1[$b];

                    /******************************/
                    /*********** extend ***********/
                    /******************************/

                    $collection2 = $second->child_menu;
                    $ctr2 = $collection2->count();

                    if($ctr2) {

                        for($c = 0; $c < $ctr2; $c++) {
                            $third = $collection2[$c];

                            /******************************/
                            /*********** extend ***********/
                            /******************************/

                            $collection3 = $third->child_menu;
                            $ctr3 = $collection3->count();

                            if($ctr3) {

                                for($d = 0; $d < $ctr3; $d++) {
                                    $fourth = $collection3[$d];

                                    /******************************/
                                    /*********** extend ***********/
                                    /******************************/

                                    $collection4 = $fourth->child_menu;
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
