<?php

namespace App\Providers;

use App\Repositories\Agendas\{
    AgendaRepository,
    AgendaRepositoryInterface
};
use App\Repositories\Consequences\{
    ConsequenceRepository,
    ConsequenceRepositoryInterface
};
use App\Repositories\Interests\{
    InterestRepository,
    InterestRepositoryInterface
};
use App\Repositories\LevelNames\{
    LevelNameRepository,
    LevelNameRepositoryInterface
};
use App\Repositories\Players\{
    PlayerRepository,
    PlayerRepositoryInterface
};
use App\Repositories\Policies\{
    PolicyRepository,
    PolicyRepositoryInterface
};
use App\Repositories\ProjectImplementationLabels\{
    ProjectImplementationLabelsInterface,
    ProjectImplementationLabelsRepository
};
use App\Repositories\Projects\{
    ProjectRepository,
    ProjectRepositoryInterface
};
use App\Repositories\Questionnaires\Position\{
    PositionQuestionnaireRepositoryInterface,
    PositionQuestionnaireRepository
};
use App\Repositories\Questionnaires\Power\{
    PowerQuestionnaireRepository,
    PowerQuestionnaireRepositoryInterface
};
use App\Repositories\Scales\Position\{
    PositionScaleRepository,
    PositionScaleRepositoryInterface
};
use App\Repositories\Scales\Power\{
    PowerScaleRepository,
    PowerScaleRepositoryInterface
};
use App\Repositories\Sectors\{
    SectorRepository,
    SectorRepositoryInterface
};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(ProjectImplementationLabelsInterface::class, ProjectImplementationLabelsRepository::class);
        $this->app->bind(PolicyRepositoryInterface::class, PolicyRepository::class);
        $this->app->bind(AgendaRepositoryInterface::class, AgendaRepository::class);
        $this->app->bind(ConsequenceRepositoryInterface::class, ConsequenceRepository::class);
        $this->app->bind(InterestRepositoryInterface::class, InterestRepository::class);
        $this->app->bind(LevelNameRepositoryInterface::class, LevelNameRepository::class);
        $this->app->bind(SectorRepositoryInterface::class, SectorRepository::class);
        $this->app->bind(PositionQuestionnaireRepositoryInterface::class, PositionQuestionnaireRepository::class);
        $this->app->bind(PowerQuestionnaireRepositoryInterface::class, PowerQuestionnaireRepository::class);
        $this->app->bind(PositionScaleRepositoryInterface::class, PositionScaleRepository::class);
        $this->app->bind(PowerScaleRepositoryInterface::class, PowerScaleRepository::class);
        $this->app->bind(PlayerRepositoryInterface::class, PlayerRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
