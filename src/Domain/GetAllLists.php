<?php

namespace DrupalCampLdn\Domain;

use DrupalCampLdn\TodoRepositoryInterface;
use IdNet\Wafer\Payload;

class GetAllLists
{
    /** @var TodoRepositoryInterface */
    protected $listRepo;

    public function __construct(TodoRepositoryInterface $listRepo)
    {
        $this->listRepo = $listRepo;
    }


    public function __invoke()
    {
        $lists = $this->listRepo->listTodoLists();
        return Payload::create($lists);
    }

}