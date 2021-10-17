<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ScreeningData;
use App\Models\Symptom;

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
          $symptoms= Symptom::all();
          foreach ($symptoms as $symptom) {
            if ($request->has(str_replace(' ', '', $symptom->name))) array_push($symptoms_array,$symptom->id);
          }
        
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
