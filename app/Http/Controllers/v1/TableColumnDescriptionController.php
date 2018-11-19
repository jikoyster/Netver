<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\TableColumnDescription;

class TableColumnDescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = $this->_table();
        /*if(TableColumnDescription::count() < 1) {
            foreach($tables as $table) {
                $columns = $this->_column($table->Tables_in_netver_dev);
                foreach($columns as $column) {
                    $tableColumnDescription = new TableColumnDescription;
                    $tableColumnDescription->table_name = $table->Tables_in_netver_dev;
                    $tableColumnDescription->table_column = $column->Field;
                    $tableColumnDescription->save();
                }
            }
        }*/
        $field_infos = TableColumnDescription::all()->sortBy('table_name');
        return view('v1.field-informations.index')
            ->with('tables',$tables)
            ->with('field_infos',$field_infos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->user()->can('add'))
            return redirect()->route('field-informations')->with('status', trans('You don\'t have permission to add.'));
        Validator::extend('field_info_unique', function ($attribute, $value, $parameters, $validator) use ($request){
            return TableColumnDescription::where('table_name',$value)->where('table_column',$request->table_column)->count() ? false : true;
        });
        $validator = $request->validate([
            'table_name' => 'required|field_info_unique',
            'table_column' => 'required'
        ],[
            'field_info_unique' => 'table and column name already existed.',
            'table_name.required' => 'Table name required',
            'table_column.required' => 'Field / Column name required'
        ]);
        $field_info = new TableColumnDescription;
        $field_info->table_name = $request->table_name;
        $field_info->table_column = $request->table_column;
        $field_info->link = $request->link;
        $field_info->table_column_description = $request->column_description;
        $field_info->save();
        auth()->user()->store_activity('added new field information on '.$field_info->table_column.' of '.$field_info->table_name);
        $response = 'New Field Information Added';
        return redirect()->route('field-informations')->with('status',$response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTableColumn($id = null)
    {
        if($id)
            $columns = $this->_column($id);
        else
            $columns = [];
        return $columns;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('field-informations')->with('status', trans('You don\'t have permission to edit.'));
        $tables = $this->_table();
        $field_info = TableColumnDescription::findOrFail($id);
        return view('v1.field-informations.edit')
            ->with('tables',$tables)
            ->with('field_info',$field_info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('field-informations')->with('status', trans('You don\'t have permission to edit.'));
        Validator::extend('field_info_unique', function ($attribute, $value, $parameters, $validator) use ($id, $request){
            return TableColumnDescription::where('id','!=',$id)->where('table_name',$value)->where('table_column',$request->table_column)->count() ? false : true;
        });
        $validator = $request->validate([
            'table_name' => 'required|field_info_unique',
            'table_column' => 'required'
        ],[
            'field_info_unique' => 'table and column name already existed.',
            'table_name.required' => 'Table name required',
            'table_column.required' => 'Field / Column name required'
        ]);
        $field_info = TableColumnDescription::findOrFail($id);
        $field_info->table_name = $request->table_name;
        $field_info->table_column = $request->table_column;
        $field_info->link = $request->link;
        $field_info->table_column_description = $request->column_description;
        $field_info->save();
        auth()->user()->store_activity('updated field information on '.$field_info->table_column.' of '.$field_info->table_name);
        $response = 'Field Information Updated';
        return redirect()->route('field-informations')->with('status',$response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->user()->can('delete'))
            return redirect()->route('field-informations')->with('status', trans('You don\'t have permission to delete.'));
        $field_info = TableColumnDescription::find($id);

        $response = 'Field Information Deleted!';
        auth()->user()->store_activity('deleted field information on '.$field_info->table_column.' of '.$field_info->table_name);

        $field_info->delete();
        return redirect()->route('field-informations')->with('status', trans($response));
    }

    private function _table()
    {
        $excludeTables = [
            'access_control_level_feature',
            'address_histories',
            'audit_trail',
            'company_owners',
            'company_user',
            'group_menu_set',
            'group_user',
            'migrations',
            'model_address',
            'model_has_permissions',
            'model_has_roles',
            'oauth_access_tokens',
            'oauth_auth_codes',
            'oauth_clients',
            'oauth_personal_access_clients',
            'oauth_refresh_tokens',
            'password_resets',
            'role_has_permissions',
            'timezone_datas',
            'user_status_histories'
        ];
        $where1 = null;
        foreach($excludeTables as $ex) {
            if($where1 == null)
                $where1 .= 'Tables_in_netver_dev not like "'.$ex.'"';
            else
                $where1 .= 'and Tables_in_netver_dev not like "'.$ex.'"';
        }
        return DB::select('show tables where '.$where1);
    }
    private function _column($table_name)
    {
        $excldeColumns = [
            'activated_at',
            'created_at',
            'updated_at',
            'remember_token',
            'resolved_at',
            'resolved_by',
            'resolved_status',
            'page',
            'id'
        ];
        $where2 = null;
        foreach($excldeColumns as $exC) {
            if($where2 == null)
                $where2 .= 'Field not like "'.$exC.'"';
            else
                $where2 .= 'and Field not like "'.$exC.'"';
        }
        return DB::select('show columns from '.$table_name.' where '.$where2);
    }
}
