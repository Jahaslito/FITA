<?php

namespace App\Http\Controllers;

use App\Models\DailyRecord;
use App\Models\Sensor;
use App\Models\User;
use App\Models\ScreeningData;
use App\Models\Symptom;
use \stdClass;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function resources(){
        $userCount = User::count();
        $temp = Sensor::count();
        $average = Sensor::max('temperature');
//        dd($userCount);
        return view('admin.dashboard', compact('userCount', 'temp', 'average'));
    }
    
    public function daily_record(){
        $dailyRecords= DailyRecord::all();

        $dailyRecordArray= array();
        foreach ($dailyRecords as $dailyRecord) {
            
            #Creating an object
            $object = new stdClass();
            
            #Daily record details
            $screeningData= ScreeningData::find($dailyRecord->screening_data_id);
            $object->temperature= $dailyRecord->temperature;
            $object->created_at= $dailyRecord->created_at;
            
            # Populating the User's Details in the object
            $user= User::find($screeningData->user_id);
            $object->first_name= $user->first_name;
            $object->last_name= $user->last_name;
            $object->email= $user->email;
            
            #Analyzing and populating Screening Data Questions in the object
            $screeningDataJson= json_decode($screeningData->screening_data);
            $object->question_two = $screeningDataJson->question_two;
            $object->question_three = $screeningDataJson->question_three;
            $object->question_four = $screeningDataJson->question_four;

            #Analyzing and populating symptoms in the object
            $object->symptoms=array();
            $symptomIds=$screeningDataJson->symptoms;
            foreach ($symptomIds as $symptomId) {
                $symptomName= Symptom::find($symptomId);
                array_push($object->symptoms,$symptomName->name);
            }

            #populating the main daily record array
            array_push($dailyRecordArray,$object); 
        }
        //dd($dailyRecordArray);

        return view('admin.daily_record')->with('dailyRecords', $dailyRecordArray);
        //Decoding the data from the database
        //$screeningData= ScreeningData::all();
        //return view('admin.daily_record');
    }
}
