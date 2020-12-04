<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\Condominium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $visitors = Visitor::withTrashed()->where([
            ['unit', '!=', Null],
            [function ($query) use ($request){
                if (($term = $request->term)) {
                    $query->Where('unit', 'LIKE', '%' . $term . '%')
                    ->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
            ->orderBy("id", "desc")
            ->paginate(10);

        return view('visitor.viewvisitor', compact('visitors'))
        -> with('i', (request()->input('page', 1)- 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unit = Condominium::all();

        return view('visitor.createvisitor', ['unit' => $unit]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $visitor_list = Visitor::select('unit')->where('unit', "=", $request->get('unit'))->get();
        $count_visitor = $visitor_list->count();
        $check_contact = Visitor::where('contact', '=', $request->get('contact'))->exists();
        $check_nric = Visitor::where('nric', '=', $request->get('nric'))->exists();

        if ($check_contact && $check_nric) {
            $request->session()->flash('danger', "Visitor already registered");
            return redirect()->route('visitor.create');
        } elseif($count_visitor >= 5) {
            $request->session()->flash('danger', "The unit already have five visitor");
            return redirect()->route('visitor.create');
        } else {
            $request->validate([
                'name' => 'required',
                'contact' => 'required',
                'nric' => 'required|digits:3',
                'unit' => 'required'
            ]);
    
            $unit = Condominium::select('id')->where('unit', $request->get('unit'))->first();
    
            $visitor = new Visitor();
            $visitor->name = $request->get('name');
            $visitor->contact = $request->get('contact');
            $visitor->nric = $request->get('nric');
            $visitor->unit = $request->get('unit');
    
            if ($unit->visitors()->save($visitor)) {
                $request->session()->flash('success', "Visitor successfully added!");
            } else {
                $request->session()->flash('warning', "Something went wrong, please try again later!");
            }
    
            return redirect()->route('visitor.index');
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

        $visitor = Visitor::withTrashed()->findOrFail($id);
        // $visitor = Visitor::findOrFail($id);

        return view('visitor.showvisitor', ['visitor' => $visitor]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visitor = Visitor::withTrashed()->findOrFail($id);
        // $visitor = Visitor::find($id);
        $unit = Condominium::all();

        return view('visitor.editvisitor', ['visitor' => $visitor, 'unit' => $unit]);
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

        $visitor_list = Visitor::select('unit')->where('unit', "=", $request->get('unit'))->get();
        $count_visitor = $visitor_list->count();
        $visitor = Visitor::findOrFail($id);

        if ($count_visitor >= 5) {
            $request->session()->flash('danger', "The unit already have five visitor");
            return redirect()->route('visitor.create');
        } else {
            $request->validate([
                'name' => 'required',
                'contact' => 'required',
                'nric' => 'required|digits:3',
                'unit' => 'required'
            ]);
    
            $unit = Condominium::select('id')->where('unit', $request->get('unit'))->first();
    
            $visitor->name = $request->get('name');
            $visitor->contact = $request->get('contact');
            $visitor->nric = $request->get('nric');
            $visitor->unit = $request->get('unit');
    
            if ($unit->visitors()->save($visitor)) {
                $request->session()->flash('success', "Visitor information successfully updated!");
            } else {
                $request->session()->flash('warning', "Something went wrong, please try again later!");
            }
    
            return redirect()->route('visitor.index');
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
        $visitor = Visitor::withTrashed()->findOrFail($id);
        
        if($visitor->forceDelete()) {
            $request->session()->flash('danger', "Visitor successfully deleted!");
        }else {
            $request->session()->flash('warning', "Something went wrong, please try again later!");
        };

        return redirect()->route('visitor.index');
    }

    public function softDelete(Request $request, $id)
    {
        $visitor = Visitor::findOrFail($id);
        
        if($visitor->delete()) {
            $request->session()->flash('success', "Visitor has left the premise!");
        }else {
            $request->session()->flash('warning', "Something went wrong, please try again later!");
        };

        return redirect()->route('visitor.index');
    }
}
