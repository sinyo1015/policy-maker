<?php

namespace App\Providers;

use App\Repositories\Agendas\AgendaRepositoryInterface;
use App\Repositories\Agendas\AgendaRepository;
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
