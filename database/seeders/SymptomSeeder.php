<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Symptom;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Symptom();
        $user->name = "Fever";
        $user->save();
        $user = new Symptom();
        $user->name = "Shortness of breath";
        $user->save();
        $user = new Symptom();
        $user->name = "Dry cough";
        $user->save();
        $user = new Symptom();
        $user->name = "Sore throat";
        $user->save();
        $user = new Symptom();
        $user->name = "Runny nose";
        $user->save();
        $user = new Symptom();
        $user->name = "Fatigue";
        $user->save();
        $user = new Symptom();
        $user->name = "Head and muscle aches";
        $user->save();
        $user = new Symptom();
        $user->name = "Nausea, diarrhea, vomiting";
        $user->save();
        $user = new Symptom();
        $user->name = "None";
        $user->save();

    }
}
