<?php

namespace DrupalCampLdn\Domain;

use DrupalCampLdn\TodoRepositoryInterface;
use IdNet\Wafer\Payload;

class GetList
{
    /** @var TodoRepositoryInterface */
    protected $repo;

    public function __construct(TodoRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke($name)
    {
        $list = $this->repo->getItems($name);
        return Payload::create($list);
    }

}