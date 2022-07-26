<?php

namespace App\Services;

use App\Repositories\Agendas\AgendaRepositoryInterface;

class AgendaService
{
    private AgendaRepositoryInterface $agenda;

    public function __construct(AgendaRepositoryInterface $agenda)
    {
        $this->agenda = $agenda;
    }

    public function getAllAgendas()
    {
        return $this->agenda->getAll();
    }
}