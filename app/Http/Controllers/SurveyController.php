<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Gamify\Points\SurveyAnswered;
use MattDaneshvar\Survey\Models\Entry;
use MattDaneshvar\Survey\Models\Survey;
use RealRashid\SweetAlert\Facades\Alert;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::orderBy('created_at', 'Desc')->cursor();
        return view('survey.index', compact('surveys'));
    }
    public function store(Request $request)
    {
        $all = $request->all();
        return $all;
    }
    public function show(Survey $survey)
    {
        return view('survey.show', ['survey' => $survey]);
    }
    public function showAdmin(Survey $survey)
    {
        return view('survey.show-admin', ['survey' => $survey]);
    }
    public function answers(Survey $survey, Request $request)
    {
        $answers = $request->all();
        unset($answers['_token']);
        $user = $request->user();
        $d = (new Entry)->for($survey)->by(Auth::user())->fromArray($answers)->push();
        $entry = Entry::find($d->id);
        $data = $user->givePoint(new SurveyAnswered($entry));
        alert()->success('Title', 'Lorem Lorem Lorem');
        return back();
    }
    public function result($id)
    {
        $Survey = Survey::with(['entries', 'questions'])->find($id);
        if (count($Survey->entries) > 0) {
            return view('survey.result', compact('Survey'));
        } else {
            return "Not yet";
        }
    }
    public function multi()
    {
        // $survey = Survey::create([
        //     'name' => [
        //         'en' => 'Cats',
        //         'fr' => 'Chats'
        //     ],
        // ]);

        // $survey->questions()->create([
        //     'content' => [
        //         'en' => 'Do you like cats?',
        //         'fr' => 'Tu aimes les chats ?'
        //     ],
        //     'type' => 'radio',
        //     'options' => [
        //         [
        //             'en' => 'Yes',
        //             'fr' => 'Oui'
        //         ],
        //         [
        //             'en' => 'No',
        //             'fr' => 'Non'
        //         ]
        //     ],
        // ]);
        $survey = Survey::find(3);
        foreach ($survey->questions as $key => $uestion) {
            foreach ($uestion->options as $key => $option) {
                echo $option['fr'];
            }
        }
    }
}
