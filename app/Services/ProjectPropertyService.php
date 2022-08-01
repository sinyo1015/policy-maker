<?php

namespace App\Services;

use App\Constants\PropertyListType;
use App\Constants\Scale;
use App\Repositories\Agendas\AgendaRepositoryInterface;
use App\Repositories\Consequences\ConsequenceRepositoryInterface;
use App\Repositories\Interests\InterestRepositoryInterface;
use App\Repositories\LevelNames\LevelNameRepositoryInterface;
use App\Repositories\Scales\Position\PositionScaleRepositoryInterface;
use App\Repositories\Scales\Power\PowerScaleRepositoryInterface;
use App\Repositories\Sectors\SectorRepositoryInterface;
use Illuminate\Support\Facades\DB;
use stdClass;
use Throwable;

class ProjectPropertyService
{
    private ConsequenceRepositoryInterface $consequenceRepository;
    private InterestRepositoryInterface $interestRepository;
    private AgendaRepositoryInterface $agendaRepository;
    private SectorRepositoryInterface $sectorRepository;
    private LevelNameRepositoryInterface $levelRepository;

    private PowerScaleRepositoryInterface $powerScale;
    private PositionScaleRepositoryInterface $positionScale;

    public function __construct(
        ConsequenceRepositoryInterface $consequenceRepository,
        InterestRepositoryInterface $interestRepository,
        AgendaRepositoryInterface $agendaRepository,
        SectorRepositoryInterface $sectorRepository,
        PowerScaleRepositoryInterface $powerScale,
        PositionScaleRepositoryInterface $positionScale,
        LevelNameRepositoryInterface $levelRepository
    ) {
        $this->consequenceRepository = $consequenceRepository;
        $this->interestRepository = $interestRepository;
        $this->agendaRepository = $agendaRepository;
        $this->sectorRepository = $sectorRepository;
        $this->powerScale = $powerScale;
        $this->positionScale = $positionScale;
        $this->levelRepository = $levelRepository;
    }

    public function getAllList($id)
    {
        $consequences = $this->consequenceRepository->getWhereMany(["project_id" => $id]);
        $interests = $this->interestRepository->getWhereMany(["project_id" => $id]);
        $agendas = $this->agendaRepository->getWhereMany(["project_id" => $id]);
        $sectors = $this->sectorRepository->getWhereMany(["project_id" => $id]);
        $levels = $this->levelRepository->getWhereMany(["project_id" => $id]);

        return [
            "consequences" => $consequences,
            "interests" => $interests,
            "agendas" => $agendas,
            "sectors" => $sectors,
            "levels" => $levels
        ];
    }

    public function insertEntry($request, $id)
    {
        try {
            DB::beginTransaction();
            switch ($request->type) {
                case PropertyListType::CONSEQUENCES:
                    $this->consequenceRepository->insert(["name" => $request->name, "project_id" => $id]);
                    break;
                case PropertyListType::INTERESTS:
                    $this->interestRepository->insert(["name" => $request->name, "project_id" => $id]);
                    break;
                case PropertyListType::ON_AGENDAS:
                    $this->agendaRepository->insert(["name" => $request->name, "project_id" => $id]);
                    break;
                case PropertyListType::SECTORS:
                    $this->sectorRepository->insert(["name" => $request->name, "project_id" => $id]);
                    break;
                case PropertyListType::LEVELS:
                    $this->levelRepository->insert(["name" => $request->name, "project_id" => $id]);
                    break;
            }
            DB::commit();

            return true;
        } catch (Throwable $e) {
            DB::rollBack();

            return false;
        }
    }

    public function saveScales($data, $id)
    {
        try {
            DB::beginTransaction();

            $this->positionScale->getEloquentInstance()->updateOrCreate(
                ["project_id" => $id],
                [
                    "ps_dh" => $data->ps_dh, //Deny High
                    "ps_dmh" => $data->ps_dmh, //Deny Medium High
                    "ps_dml" => $data->ps_dml, //Deny Medium Low
                    "ps_dlh" => $data->ps_dlh, //Deny Low High
                    "ps_dll" => $data->ps_dll, //Deny Low Low
                    "ps_nh" => $data->ps_nh, //Neutral High 
                    "ps_nl" => $data->ps_nl, //Neutral Low
                    "ps_sll" => $data->ps_sll, //Support Low Low
                    "ps_slh" => $data->ps_slh, //Support Low High
                    "ps_sml" => $data->ps_sml, //Support Medium Low
                    "ps_smh" => $data->ps_smh, //Support Medium High
                    "ps_sh" => $data->ps_sh, //Support High,
                ]
            );

            $this->powerScale->getEloquentInstance()->updateOrCreate(
                ["project_id" => $id],
                [
                    "pw_l" => $data->pw_l,
                    "pw_ml" => $data->pw_ml,
                    "pw_mh" => $data->pw_mh,
                    "pw_h" => $data->pw_h,
                ]
            );

            DB::commit();

            return true;
        } catch (Throwable $e) {
            DB::rollBack();

            return false;
        }
    }

    public function getScales($id)
    {
        $obj = new stdClass;

        $dataA = $this->positionScale->getWhereFirst(["project_id" => $id])->getAttributes();
        $dataB = $this->powerScale->getWhereFirst(["project_id" => $id])->getAttributes();

        foreach($dataA as $k => $v)$obj->$k = $v;
        foreach($dataB as $k => $v)$obj->$k = $v;

        return $obj;
    }
}
