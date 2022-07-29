<?php

namespace App\Http\Controllers;

use App\Models\AgeGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Else_;

use function PHPSTORM_META\type;

class AgeGroupController extends Controller
{
    private $moduleName = 'Age Group';

    public function store_age_group(Request $request)
    {

        $request->validate([
            'age_from' => 'required',
            'age_to' => 'required',
            'lead_type' => 'required',
        ]);

        if($request->age_from != '' && $request->age_to != '' && $request->lead_type != '') {

            $from = intval($request->age_from);
            $to = intval($request->age_to);

            $check = AgeGroup::where(function($q) use($from, $to){
                $q->where(function($qu) use($from){
                    $qu->where('age_from','<=',$from)->where('age_to','>=',$from);
                })->orWhere(function($que) use($to){
                    $que->where('age_from','<=',$to)->where('age_to','>=',$to);
                });
            })->where('lead_type_id', $request->lead_type)->get();

            if(count($check) == 0)
            {
                $message = '';

                if(isset($request->type) && $request->type == "UPDATE") {
                    $ageGroup = AgeGroup::find($request->id);
                    $ageGroup->update([ 'lead_type_id' => $request->lead_type, 'age_from' => $request->age_from, 'age_to' => $request->age_to,'updated_by' => auth()->user()->id ]);

                    $message = $this->moduleName." Updated Successfully.";

                 } else {
                    $ageGroup = AgeGroup::create([ 'lead_type_id' => $request->lead_type,'age_from' => $request->age_from,'age_to' => $request->age_to,'added_by' => auth()->user()->id ]);

                 $message = $this->moduleName." Added Successfully.";
                }
                return response()->json([true,$this->moduleName,$message]);
            }
            else
         {
            $message = 'Range already exist.';
            return response()->json([false,$this->moduleName,$message]);
        }

     }
    }

    public function age_edit(Request $request)
    {
        $ageGroup = AgeGroup::with('leadType')->where('id',$request->id)->first();
        $leadType = $ageGroup->leadType;
        return response()->json([true, $ageGroup,$leadType]);
    }

    public function age_delete(Request $request)
    {
        $ageGroup = AgeGroup::find($request->id);
        $ageGroup->delete();
        $message = $this->moduleName." Deleted Successfully.";
        return response()->json([true,$message]);
    }
}
