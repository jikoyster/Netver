<?php

namespace App\Http\Controllers\v1;

use App\CompanyDocument;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class CompanyDocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->photos_path = public_path('/docs');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        $company = Company::findOrFail(session('selected-company'));
        return view('v1.company-documents.index')
            ->with('company',$company);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        return view('v1.company-documents.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $photos = $request->file('file');
 
        if (!is_array($photos)) {
            $photos = [$photos];
        }
 
        if (!is_dir($this->photos_path)) {
            mkdir($this->photos_path, 0777);
        }
        if (!is_dir($this->photos_path.'/'.session('selected-company'))) {
            mkdir($this->photos_path.'/'.session('selected-company'), 0777);
        }

        $company = Company::findOrFail(session('selected-company'));
 
        for ($i = 0; $i < count($photos); $i++) {
            $photo = $photos[$i];
            $original_name = explode('.',$photo->getClientOriginalName());
            $ctr = CompanyDocument::where('company_key',$company->company_key)->where('original_name','like','%'.$original_name[0].'%')->count();
            /*if($ctr)
                $original_name = $original_name[0].'-'.($ctr + 1).'.'.$photo->getClientOriginalExtension();
            else*/
                $original_name = $original_name[0].'.'.$photo->getClientOriginalExtension();
            $name = sha1(date('YmdHis') . str_random(30)).'niel';
            $save_name = $name . '.' . $photo->getClientOriginalExtension();
            $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();
 
            $photo->move($this->photos_path.'/'.session('selected-company'),$original_name);
 
            //$photo->move($this->photos_path, $save_name);
            //if(CompanyDocument::where('original_name',$original_name)->count() < 1) {
                $company_document = new CompanyDocument();
                $company_document->company_key = $company->company_key;
                $company_document->document_no = $this->document_no_gen();//date_timestamp_get(date_create()).sprintf('%02d',rand(0,99));
                $company_document->original_name = $original_name;
                $company_document->save();
                auth()->user()->store_activity('added company document - '.$company_document->original_name);
            //}
        }
        return Response::json([
            'message' => 'Image saved Successfully',
            'filename' => $original_name
        ], 200);
    }

    public function document_no_gen()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'.date_timestamp_get(date_create()).sprintf('%02d',rand(0,99));
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 24; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanyDocument  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompanyDocument  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('edit'))
            return redirect()->route('company-documents')->with('status', trans('You don\'t have permission to edit.'));
        $company_document = CompanyDocument::findOrFail($id);
        return view('v1.company-documents.edit')
            ->with('company_document',$company_document);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanyDocument  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('edit'))
            return redirect()->route('company-documents')->with('status', trans('You don\'t have permission to edit.'));

        $validator = $request->validate([
            'document_no' => 'required|unique:company_documents,document_no,'.$id,
        ]);
        $company_document = CompanyDocument::findOrFail($id);
        auth()->user()->store_activity('updated company document - '.$company_document->original_name);
        $company_document->document_no = $request->document_no;
        $company_document->description = $request->description;
        $company_document->status = $request->status;
        $company_document->type = $request->type;
        $company_document->index_no = $request->index_no;
        $company_document->tag = $request->tag;
        $company_document->save();
        $response = 'Company Document Updated';
        return redirect()->route('company-documents')->with('status',$response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanyDocument  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
        if(!auth()->user()->can('delete'))
            return redirect()->route('company-documents')->with('status', trans('You don\'t have permission to delete.'));
        $company_document = CompanyDocument::findOrFail($id);
        $doc_ctr = CompanyDocument::where('id','!=',$company_document->id)->where('company_key',$company_document->company_key)->where('original_name','like','%'.$company_document->original_name.'%')->count();
        auth()->user()->store_activity('deleted company document - '.$company_document->original_name);
        $file_path = $this->photos_path.'/'.session('selected-company').'/'.$company_document->original_name;
        if($doc_ctr < 1 && is_file($file_path))
            unlink($file_path);
        $company_document->delete();
        $response = 'Company Document Deleted';
        return redirect()->route('company-documents')->with('status',$response);
    }

    public function destroyImg(Request $request)
    {
        $company = Company::findOrFail(session('selected-company'));
        $doc_ctr = CompanyDocument::where('company_key',$company->company_key)->where('original_name','like','%'.$request->id.'%')->count();
        CompanyDocument::where('original_name',$request->id)->where('company_key',$company->company_key)->first()->delete();
        auth()->user()->store_activity('deleted company document - '.$request->id);
        if($doc_ctr <= 1)
            unlink($this->photos_path.'/'.session('selected-company').'/'.$request->id);
        return $request;
    }
}
