<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ScreeningData;

class ScreeningDataController extends Controller
{
    public function store_screening_data(Request $request){
        $date= now()->format('F')." ".now()->format('d')." ".now()->format('Y');
        $userId= Auth::user()->id;
        $data= ScreeningData::where("user_id",$userId)->where("date",$date)->first();
        if($data!=null){
            return "You have already submitted the form for today";
        }
        $request->validate([
            'question_two' => 'required',
            'question_three' => 'required',
            'question_four' => 'required',
          ]);
          $symptoms_array= array();
        if ($request->has('fever')) array_push($symptoms_array,1);
        if ($request->has('breathShortness')) array_push($symptoms_array,2);
        if ($request->has('dryCough')) array_push($symptoms_array,3);
        if ($request->has('soreThroat')) array_push($symptoms_array,4);
        if ($request->has('runningNose')) array_push($symptoms_array,5);
        if ($request->has('fatigue')) array_push($symptoms_array,6);
        if ($request->has('aches')) array_push($symptoms_array,7);
        if ($request->has('others')) array_push($symptoms_array,8);
        if ($request->has('none')) array_push($symptoms_array,0);
        $request= $request->all();
        $question_two= $request["question_two"];
        $quetion_three= $request["question_three"];
        $quetion_four= $request["question_four"];

        $screening_data_json= json_encode( array(
            "symptoms"=>$symptoms_array,
            "question_two"=>$question_two,
            "question_three"=>$quetion_three,
            "question_four"=>$quetion_four
        ));
        

        $screeningData= new ScreeningData;
        $screeningData->screening_data= $screening_data_json;
        $screeningData->date= $date;
        $screeningData->user_id= $userId;
        $screeningData->save();

        return 'success';
    }
}
