<?php

namespace App\Http\Controllers;

use App\Http\Requests\Projects\Questionnaires\QuestionnaireRequest;
use App\Models\PositionQuestionnaire;
use App\Services\QuestionnaireService;
use Illuminate\Http\Request;

class PositionQuestionnaireController extends Controller
{
    private QuestionnaireService $questionnaire;

    public function __construct(QuestionnaireService $questionnaire)
    {
        $this->questionnaire = $questionnaire;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionnaireRequest $request, $id)
    {
        if($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat menambahkan entri");

        if(!$this->questionnaire->insertEntry($request, $id))
            return return_json([], 403, "Terjadi kesalahan saat menambahkan entri");

        return return_json();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PositionQuestionnaire  $positionQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function show(PositionQuestionnaire $positionQuestionnaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PositionQuestionnaire  $positionQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function edit(PositionQuestionnaire $positionQuestionnaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PositionQuestionnaire  $positionQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PositionQuestionnaire $positionQuestionnaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PositionQuestionnaire  $positionQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(PositionQuestionnaire $positionQuestionnaire)
    {
        //
    }
}
