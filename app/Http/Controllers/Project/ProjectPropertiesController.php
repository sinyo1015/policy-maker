<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\Properties\PropertyRequest;
use App\Http\Requests\Projects\Properties\ScaleRequest;
use App\Http\Requests\Projects\Questionnaires\QuestionnaireDeleteRequest;
use App\Http\Requests\Projects\Questionnaires\QuestionnaireEditRequest;
use App\Http\Requests\Projects\Questionnaires\QuestionnaireRequest;
use App\Services\ProjectPropertyService;
use App\Services\ProjectService;
use App\Services\QuestionnaireService;
use Illuminate\Http\Request;
use Psy\Command\HistoryCommand;

class ProjectPropertiesController extends Controller
{
    private ProjectService $project;
    private ProjectPropertyService $property;
    private QuestionnaireService $questionnaire;

    public function __construct(
        ProjectService $project,
        ProjectPropertyService $property,
        QuestionnaireService $questionnaire
        )
    {
        $this->project = $project;
        $this->property = $property;
        $this->questionnaire = $questionnaire;
    }

    public function index(Request $request, $id)
    {
        $data = $this->project->getDetail($id);

        return view("pages.project.properties", compact("data"));
    }

    public function getAllList(Request $request, $id)
    {
        return return_json($this->property->getAllList($id));
    }

    public function insertEntry(PropertyRequest $request, $id)
    {
        if($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat menambahkan entri");

        if(!$this->property->insertEntry($request, $id))
            return return_json([], 403, "Terjadi kesalahan saat menambahkan entri");

        return return_json();
    }

    public function getQuestionnaires($id)
    {
        $data = $this->questionnaire->getQuestionnaire($id);

        return return_json($data);
    }

    public function saveQuestionnaires(QuestionnaireRequest $request, $id)
    {
        if($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat menambahkan entri");

        if(!$this->questionnaire->insertEntry($request, $id))
            return return_json([], 403, "Terjadi kesalahan saat menambahkan entri");

        return return_json();
    }

    public function deleteQuestionnaire(QuestionnaireDeleteRequest $request, $id)
    {
        if($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat menambahkan entri");

        $this->questionnaire->deleteQuestionnaire($request);

        return return_json();
    }

    public function updateQuestionnaire(QuestionnaireEditRequest $request, $id)
    {
        if($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat mengubah entri");
        
        if(!$this->questionnaire->updateQuestionnaire($request))
            return return_json([], 403, "Terjadi kesalahan saat mengubah entri");

        return return_json();
    }

    public function saveScales(ScaleRequest $request, $id)
    {
        if($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat mengubah entri");
        
        if(!$this->property->saveScales($request, $id))
            return return_json([], 403, "Terjadi kesalahan saat mengubah entri");

        return return_json();
    }

    public function getScales(Request $request, $id)
    {
        return return_json($this->property->getScales($id));
    }
}
