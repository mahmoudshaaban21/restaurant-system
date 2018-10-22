<?php

namespace mat3am\Http\Controllers\Admin;

use Illuminate\Http\Request;
use mat3am\Http\Controllers\Controller;
use mat3am\Slider;
use Carbon\Carbon;
class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Show All Slider 
        $sliders = Slider::paginate(10);

        return view('admin.slider.index',compact('sliders'));
    }

     public function search(Request $request)
    {
        //Show All Slider 
        if($request->ajax()){
            $output = '';
            $query = $request->get('search');

        if($query != '')
          {
           $data = Slider:: where('title', 'like', '%'.$query.'%')
                           ->orWhere('sub_title', 'like', '%'.$query.'%')
                           ->orderBy('created_at', 'desc')
                           ->paginate(10);
             
          }else {
               $data = Slider::orderBy('created_at', 'desc')
                               ->paginate(10);
              }

        $total_row = $data->count();
        if(count($total_row) > 0){
            foreach($data as $row){
                $output .='
                <tr>
                <td>'.$row->id.'<td>
                <td>'.$row->title.'<td>
                <td>'.$row->sub_title.'<td>
                <td>'.$row->created_at.'<td>
                <td>'.$row->updated_at.'<td>

                </tr>
                ';
            }
        } else{
            $output = '
               <tr>
                <td align="center" colspan="5">No Data Found</td>
               </tr>
               ';     
        }
            $data = array(
           'table_data'  => $output,
           'total_data'  => $total_row
          );

      echo json_encode($data);
       
        
    }}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
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
            'title'              =>  'required',
            'sub_title'          =>  'required',
            'image'              =>  'required|mimes:jpeg,jpg,bmp,png',

        ]);
        $image       = $request->file('image');
        $slug        = str_slug($request->title);

        //Check If The Image Exist
        if(isset($image))
        {

            $currentData = Carbon::now()->toDateString();
            $imageName   = $slug . '-' .'-'.$currentData.'-'.uniqid().'.'.$image->getClientOriginalExtension();
        // If Folder Slider Dosn't Exist Make One
        if(!file_exists('uploads/slider'))
        {
            mkdir('uploads/slider',0777,true);
        }
        // Store Image 
        $image->move('uploads/slider',$imageName);

        } else{
            $image = 'default.png';
        }

        $slider  = new Slider();
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $imageName;
        $slider->save();
        return redirect()->route('slider.index')->with('success','Slider Successfully Saved');

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
        //Edit Slider
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit')->with('slider',$slider);
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
            'title'              =>  'required',
            'sub_title'          =>  'required',
            'image'              =>  'mimes:jpeg,jpg,bmp,png',

        ]);
        $image       = $request->file('image');
        $slug        = str_slug($request->title);
        $slider = Slider::find($id);

        //Check If The Image Exist
        if(isset($image))
        {

            $currentData = Carbon::now()->toDateString();
            $imageName   = $slug . '-' .'-'.$currentData.'-'.uniqid().'.'.$image->getClientOriginalExtension();
        // If Folder Slider Dosn't Exist Make One
        if(!file_exists('uploads/slider'))
        {
            mkdir('uploads/slider',0777,true);
        }
        // Store Image 
        $image->move('uploads/slider',$imageName);

        } else{
            $imageName = $slider->image;
        }

       
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $imageName;
        $slider->save();
        return redirect()->route('slider.index')->with('success','Slider Successfully Updated');
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
        $slider = Slider::findOrFail($id);
        // Check If The Image Exist
        if(file_exists('uploads/slider/'.$slider->image)){

        unlink( 'uploads/slider/'.$slider->image);
        }
        $slider->delete();
        return redirect()->back()->with('success','Slider Successfully Deleted');
    }
}
