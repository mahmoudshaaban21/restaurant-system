<?php

namespace mat3am\Http\Controllers\Admin;

use Illuminate\Http\Request;
use mat3am\Http\Controllers\Controller;
use mat3am\Item;
use mat3am\Category;
use Carbon\Carbon;
class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get All Items
        $items = Item::orderBy('created_at','desc')->paginate(10);
        return view('admin.item.index')->with('items',$items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Get Categories 
        $categories = Category::all();
        return view('admin.item.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate The Data
        $request->validate([
            'name'                  =>  'required',
            'description'           =>  'required',
            'category'              =>  'required',
            'price'                 =>  'required',
            'image'                 =>  'required|mimes:jpeg,jpg,bmp,png',

        ]);
        $image       = $request->file('image');
        $slug        = str_slug($request->name);

        //Check If The Image Exist
        if(isset($image))
        {

            $currentData = Carbon::now()->toDateString();
            $imageName   = $slug . '-' .'-'.$currentData.'-'.uniqid().'.'.$image->getClientOriginalExtension();
        // If Folder Slider Dosn't Exist Make One
        if(!file_exists('uploads/item'))
        {
            mkdir('uploads/item',0777,true);
        }
        // Store Image 
        $image->move('uploads/item',$imageName);

        } else{
            $image = 'default.png';
        }

        $item               = new Item();
        $item->name         = $request->name;
        $item->description  = $request->description;
        $item->price        = $request->price;
        $item->image        = $imageName;
        $item->category_id  = $request->category;
        $item->save();
        return redirect()->route('item.index')->with('success','Item Successfully Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item       = Item::find($id);
        $categories = Category::all();
        return view('admin.item.edit',compact('item','categories'));
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
        //Validate The Data
        $request->validate([
            'name'                  =>  'required',
            'description'           =>  'required',
            'category'              =>  'required',
            'price'                 =>  'required',
            'image'                 =>  'mimes:jpeg,jpg,bmp,png',

        ]);
        $item        = Item::findOrFail($id);
        $image       = $request->file('image');
        $slug        = str_slug($request->name);

        //Check If The Image Exist
        if(isset($image))
        {

            $currentData = Carbon::now()->toDateString();
            $imageName   = $slug . '-' .'-'.$currentData.'-'.uniqid().'.'.$image->getClientOriginalExtension();
        // If Folder Slider Dosn't Exist Make One
        if(!file_exists('uploads/item'))
        {
            mkdir('uploads/item',0777,true);
        }
        unlink( 'uploads/item/'.$item->image);
        // Store Image 
        $image->move('uploads/item',$imageName);

        } else{
            $imageName = $item->image;
        }


        $item->category_id      = $request->category;
        $item->name             = $request->name;
        $item->description      = $request->description;
        $item->price            = $request->price;
        $item->image            = $imageName;
        $item->save();
        return redirect()->route('item.index')->with('success','Item Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find Slider With Id
        $item = Item::findOrFail($id);
        // Check If The Image Exist
        if(file_exists('uploads/item/'.$item->image)){

        unlink( 'uploads/item/'.$item->image);
        }
        $item->delete();
        return redirect()->back()->with('success','Item Successfully Deleted');
    }
}
