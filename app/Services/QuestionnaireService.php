<?php

namespace App\Services;

use App\Constants\QuestionnaireType;
use App\Repositories\Questionnaires\Position\PositionQuestionnaireRepositoryInterface;
use App\Repositories\Questionnaires\Power\PowerQuestionnaireRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Throwable;

class QuestionnaireService
{
    private PositionQuestionnaireRepositoryInterface $positionQuestionnaireRepository;
    private PowerQuestionnaireRepositoryInterface $powerQuestionnaireRepository;

    public function __construct(PositionQuestionnaireRepositoryInterface $positionQuestionnaireRepository,
        PowerQuestionnaireRepositoryInterface $powerQuestionnaireRepository)
    {
        $this->positionQuestionnaireRepository = $positionQuestionnaireRepository;
        $this->powerQuestionnaireRepository = $powerQuestionnaireRepository;
    }

    public function insertEntry($data, $id)
    {
        try{
            DB::beginTransaction();
            
            switch($data->type){
                case QuestionnaireType::POSITION_QUESTIONNAIRE:
                    $this->positionQuestionnaireRepository->create([
                        "questionnaire" => $data->contents,
                        "project_id" => $id
                    ]);
                    break;
                case QuestionnaireType::POWER_QUESTIONNAIRE:
                    $this->powerQuestionnaireRepository->create([
                        "questionnaire" => $data->contents,
                        "project_id" => $id
                    ]);
                    break;
            }

            DB::commit();

            return true;
        }
        catch(Throwable $e)
        {
            DB::rollBack();

            return false;
        }
    }

    public function getQuestionnaire($id)
    {
        $q1 = $this->positionQuestionnaireRepository
            ->getWhereMany(["project_id" => $id])
            ->map(function($item){
                $item->is_edit_mode = false;
                return $item;
            });
        $q2 = $this->powerQuestionnaireRepository
            ->getWhereMany(["project_id" => $id])
            ->map(function($item){
                $item->is_edit_mode = false;
                return $item;
            });
        return [
            "position_questionnaires" => $q1,
            "power_questionnaires" => $q2
        ];
    }

    public function deleteQuestionnaire($data)
    {
        switch($data->type){
            case QuestionnaireType::POSITION_QUESTIONNAIRE:
                $this->positionQuestionnaireRepository->delete($data->questionnaire_id);
                break;
            case QuestionnaireType::POWER_QUESTIONNAIRE:
                $this->powerQuestionnaireRepository->delete($data->questionnaire_id);
                break;
        }
    }

    public function updateQuestionnaire($data)
    {
        switch($data->type){
            case QuestionnaireType::POSITION_QUESTIONNAIRE:
                try{
                    DB::beginTransaction();
                    $this->positionQuestionnaireRepository->update($data->questionnaire_id, [
                        "questionnaire" => $data->questionnaire
                    ]);
                    DB::commit();
                    return true;
                }
                catch(Throwable $e){
                    dd($e);
                    DB::rollBack();
                    return false;
                }
            case QuestionnaireType::POWER_QUESTIONNAIRE:
                try{
                    DB::beginTransaction();
                    $this->powerQuestionnaireRepository->update($data->questionnaire_id, [
                        "questionnaire" => $data->questionnaire
                    ]);
                    DB::commit();
                    return true;
                }
                catch(Throwable $e){
                    DB::rollBack();
                    return false;
                }
        }
    }
}