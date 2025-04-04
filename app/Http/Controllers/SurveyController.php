<?php

namespace App\Http\Controllers;

use App\Interface\ApiResponseInterface;
use App\Models\Question;
use App\Models\Answers;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseInterface $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $survey=Survey::orderBy('id', 'desc')->get();
        return view('survey/survey_index',compact('survey'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $question=Question::get();
        return view('survey/survey_create',compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $request->validate(array_fill_keys(array_keys($request->all()), 'required'));

        $request->validate([
            'phone_number' => 'required|unique:surveys,phone_number',
        ]);

        $survey=Survey::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'created_by' => Auth::user()->id
        ]);

        $filteredData = array_filter($request->all(), function ($key) {
            return str_starts_with($key, 'answer___');
        }, ARRAY_FILTER_USE_KEY);
        foreach ($filteredData as $key => $value) {
            $questionId=explode("___",$key);
            Answers::create([
                'survey_id' => $survey->id,
                'question_id' => $questionId[1],
                'answer' => $value,
            ]);
        }
        
        
        return  $this->apiResponse->success('Survey successfully uploaded');

    }

    /**
     * Display the specified resource.
     */
    public function show(Survey $survey)
    {
        $data = Question::join('answers as a', 'questions.id', '=', 'a.question_id')
            ->select('questions.question', 'questions.type', 'a.answer','questions.id')
            ->where('a.survey_id', $survey->id)
            ->get();
        return view('survey/survey_show',compact('survey','data'));
    }


}
