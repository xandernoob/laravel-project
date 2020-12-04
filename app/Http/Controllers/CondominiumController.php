<?php

namespace App\Http\Controllers;

use App\Models\Condominium;
use App\Models\Visitor;
use Illuminate\Http\Request;

class CondominiumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $condominium = Condominium::all();

        $condominium = Condominium::where([
            ['owner', '!=', Null],
            [function ($query) use ($request){
                if (($term = $request->term)) {
                    $query->Where('owner', 'LIKE', '%' . $term . '%')
                    ->orWhere('unit', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
            ->orderBy("id", "desc")
            ->paginate(10);

        return view('unit.viewcondominium', compact('condominium'))
        -> with('i', (request()->input('page', 1)- 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unit.createcondominium');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check_unit = Condominium::where('unit', '=', $request->get('unit'))->exists();
        if ( $check_unit) {
            $request->session()->flash('danger', "Unit already registered");
            return redirect()->route('condominium.create');
        }else {
            $request->validate([
                'owner' => 'required',
                'unit' => 'required',
                'contact' => 'required'
            ]);
    
            $input = $request->all();
    
            if (Condominium::create($input)) {
                $request->session()->flash('success', "Unit successfully added!");
            } else {
                $request->session()->flash('warning', "Something went wrong, please try again later!");
    
            }
            
            return redirect()->route('condominium.index');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $unit = Condominium::findOrFail($id);
        $visitor = Visitor::with('unit')->where('condominium_id', "=", $unit->id)->get();
       
        return view('unit.showcondominium', ['unit' => $unit, 'visitor' => $visitor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = Condominium::find($id);

        return view('unit.editcondominium', ['unit' => $unit]);
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
        $unit = Condominium::findOrFail($id);

        $check_unit = Condominium::where('id', "!=", $id)->where('unit', '=', $request->get('unit'))->exists();
        if ( $check_unit) {
            $request->session()->flash('danger', "Unit already registered");
            return redirect()->route('condominium.edit', $id);
        }else {
            $this->validate($request,[
                'owner' => 'required',
                'unit' => 'required',
                'contact' => 'required'
            ]);
    
            $input = $request->all();
    
            if ($unit->fill($input)->save()){
                $request->session()->flash('success', "Unit successfully eddited!");
            }else {
                $request->session()->flash('warning', "Something went wrong, please try again later!");
            };
    
            return redirect()->route('condominium.index');
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $unit = Condominium::findOrFail($id);
        
        if($unit->delete()) {
            $request->session()->flash('danger', "Unit successfully deleted!");
        }else {
            $request->session()->flash('warning', "Something went wrong, please try again later!");
        };

        return redirect()->route('condominium.index');
    }
}
