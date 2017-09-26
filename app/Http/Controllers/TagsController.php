<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Customer;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;


class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, $isUpdateRequest=false)
    {


        $rules=[
            'taskTitle' => 'required|string',
            'taskDescription' => 'required|string',
            'taskStatus' => 'required|string',
            'taskDueDate'=>'required|date',
            'taskPriority'=>'required|string',
            'taskCustomerId'=>'required|integer|exists:customers,id'
        ];

        if($isUpdateRequest){
            $rules=array_merge($rules,[
                'taskId'=>'required|integer|exists:appointments,id',
            ]);
        }

        return Validator::make($data, $rules);
    }

    /**
     * Show the all customers falls under current user scope.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('tag.index-datatable');
    }

    public function getTagsAjax(){
        return Datatables::of(Tag::all())
            ->addColumn('action',
                function ($tag){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editTag('.$tag->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteTag('.$tag->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                        <a  class="btn btn-xs btn-primary"   onClick="viewTag('.$tag->id.')" ><i class="glyphicon glyphicon-edit"></i> View</a>';
                })
            ->addColumn('tag',
                function ($tag){
                    return $tag->tagname;
                })


            ->rawColumns(['id','tag', 'action'])
            ->make(true);
    }



    public function createTag( Request $request){
        $customer_id = $request->tag['tagCustomerId'];
        $tag = new Tag();
        $tag->tagname = $request->tag['tagName'];


        DB::beginTransaction();
        $tag->save();

        DB::table('customers_tags')->insert([
            'customer_id' => $customer_id,
            'tag_id' => $tag->id
        ]);
        DB::commit();

        return response()->json(['result' => "Saved", 'message' => 'Tag  is Saved.'], 200);



    }

    public function editTag(Request $request){
        $tag = Tag::findOrFail($request->id);
        $customer = DB::table('customers_tags')->where('tag_id',$request->id)->first();
        $customer = Customer::with('company')->where('id',$customer->customer_id)->first();


        return response()->json([
            'tag' => $tag,
            'customer' => $customer,
        ], 200);

    }

    public function updateTag(Request $request){

        $tag = Tag::findOrFail($request->tag['tagId']);
        $customer_id = $request->tag['tagCustomerId'];
        $tag->tagname = $request->tag['tagName'];


        DB::beginTransaction();

        $tag->save();
        DB::table('customers_tags')
            ->where('tag_id', $tag->id)
            ->update(['customer_id'=>$customer_id]);
        DB::commit();

        return response()->json([
            'result'=>'Saved',
            'message'=>'Tag has been updated successfully.'
        ]);


    }

    public function deleteTag(Request $request){
        $tag = Tag::findOrFail($request->id);

        if(!is_null($tag)){

            $tag->delete();

            return response()->json([
                'result'=>'Success',
                'message'=>'Tag has been successfully deleted.'
            ]);
        }

        return response()->json([
            'result'=>'Error',
            'message'=>'Tag not found.'
        ]);

    }




}
