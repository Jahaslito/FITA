<?php

namespace App\Http\Controllers;

use App\Models\DailyRecord;
use App\Models\Sensor;
use App\Models\User;
use App\Models\ScreeningData;
use App\Models\Symptom;
use \stdClass;
use Illuminate\Http\Request;
use DateTime;

class DashboardController extends Controller
{
    public function resources(){
        $userCount = User::count();
        $temp = DailyRecord::max('temperature');
        $average = DailyRecord::average('temperature');
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

        $symptoms= Symptom::all();
        return view('admin.daily_record')->with('dailyRecords', $dailyRecordArray)->with('symptoms',$symptoms);
        //Decoding the data from the database
        //$screeningData= ScreeningData::all();
        //return view('admin.daily_record');
    }

    public function filter_table(Request $request){

        $dateData=$request->dateData;
        $symptomData=$request->symptomData;
        $questionData=$request->questionData;
        $answerData=$request->answerData;

        $dailyRecords= DailyRecord::all();
        
        $dailyRecordArray= array();
        foreach ($dailyRecords as $dailyRecord) {
            
            #Creating an object
            $object = new stdClass();

            #Daily record details
            
            $screeningData= ScreeningData::find($dailyRecord->screening_data_id);
            $dateDataString= new DateTime($dateData);
            if ($dateData!=null && $dateDataString->format('F d Y')!=$screeningData->date) {
                continue;
            }

            // $object->created_at= $dailyRecord->created_at;
            // $dailyRecord->created_at->format('F d, Y h:ia');
             
            #Analyzing and populating Screening Data Questions in the object
            $screeningDataJson= json_decode($screeningData->screening_data);
            $question_two = $screeningDataJson->question_two;
            $question_three = $screeningDataJson->question_three;
            $question_four = $screeningDataJson->question_four;

            if ($questionData!=null) {
                switch ($questionData) {
                    case 'question-two':
                        if ($answerData!=$question_two) {
                            continue 2;
                        }
                        break;
                    case 'question-three':
                        if ($answerData!=$question_three) {
                            continue 2;
                        }
                        break;
                    case 'question-four':
                        if ($answerData!=$question_four) {
                            continue 2;
                        }
                        break;
                    default:
                        # code...
                        break;
                }
            }

            $symptomIds=$screeningDataJson->symptoms;
            if($symptomData!=null && !in_array($symptomData,$symptomIds)){
                continue;
            }

            #populating the object
            $object->temperature= $dailyRecord->temperature;
            $object->created_at= $screeningData->date;
             //user details
            $user= User::find($screeningData->user_id);
            $object->first_name= $user->first_name;
            $object->last_name= $user->last_name;
            $object->email= $user->email;
             //question details
            $object->question_two = $screeningDataJson->question_two;
            $object->question_three = $screeningDataJson->question_three;
            $object->question_four = $screeningDataJson->question_four;

            #Analyzing and populating symptoms in the object
            $object->symptoms=array();
            
            foreach ($symptomIds as $symptomId) {
                $symptomName= Symptom::find($symptomId);
                array_push($object->symptoms,$symptomName->name);
            } 
            #populating the main daily record array
             array_push($dailyRecordArray,$object); 
        }
        $responseText="";
        foreach ($dailyRecordArray as $row) {
            $responseText.=
            " <tr>
              <td>$row->first_name</td>
              <td>$row->last_name</td>
              <td>$row->email</td>";
              $symptoms= $row->symptoms;
              $symptomLists="";
              foreach ($symptoms as $symptom) {
                  $symptomLists.=$symptom.",\n";
              }
              $responseText.=
            " <td>$symptomLists</td>
              <td title='Have you been in close physical contact in the last 14 days with anyone who is known to have laboratory-confirmed COVID-19?'>$row->question_two</td>
              <td title='Have you been in close physical contact in the last 14 days with anyone who has any symptoms consistent with COVID-19?'>$row->question_three</td>
              <td title='Have you traveled to places with high covid-19 incidences in the past 10 days?'>$row->question_four</td>
              <td>$row->temperature</td>
              <td>$row->created_at</td>
              </tr>
              ";
        }
        return $responseText;    
    }

    public function getWeekday($date) {
        return date('w', strtotime($date));
    }

    public function sendChartData(){
        $barData= $this->makeBarChart();
        $groupedBarData= $this->makeGroupedBarChart();
        $finalData = array(
            'barData' => $barData, 
            'groupedBarData' => $groupedBarData 
        );
        return $finalData;
    }
    public function makeBarChart(){
        $dailyRecords = DailyRecord::all();
        $temperatureData = [0,0,0,0,0,0];
        $temperatureDataCounter = [0,0,0,0,0,0];
        foreach ($dailyRecords as $dailyRecord){
         $date= $this->getWeekday($dailyRecord->created_at);
         if ($date == 0) {
             continue;
         }
         $temperatureData[($date - 1)] += $dailyRecord->temperature; 
         $temperatureDataCounter[($date - 1)] += 1; 
        }

        for ($i=0; $i <count($temperatureData) ; $i++) {
            if ($temperatureDataCounter[$i]==0) {
                continue;
            } 
            $temperatureData[$i]= ($temperatureData[$i]/$temperatureDataCounter[$i]);
        }

        return $temperatureData;
    }

    public function makeGroupedBarChart(){
        $dailyRecords = DailyRecord::all();
        $temperatureData = [[0,0],[0,0],[0,0],[0,0],[0,0],[0,0]];
        foreach ($dailyRecords as $dailyRecord){
         $date= $this->getWeekday($dailyRecord->created_at);
         if ($date == 0) {
             continue;
         }
         #storing the highest temperature
         if($dailyRecord->temperature > $temperatureData[($date - 1)][0]){
            $temperatureData[($date - 1)][0] = $dailyRecord->temperature;
         }

         #storing the lowest temperature
         if($temperatureData[($date - 1)][1]==0){
            $temperatureData[($date - 1)][1] = $dailyRecord->temperature;
         }
         if($dailyRecord->temperature< $temperatureData[($date - 1)][1]){
            $temperatureData[($date - 1)][1] = $dailyRecord->temperature;
         }

        }
        return $temperatureData;
    }

}