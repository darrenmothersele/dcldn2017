<?php

namespace DrupalCampLdn\Domain;

use DrupalCampLdn\TodoRepositoryInterface;
use IdNet\Wafer\Payload;

class AddList
{
    /** @var TodoRepositoryInterface */
    protected $repo;

    public function __construct(TodoRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke($name, $items)
    {
        $this->repo->saveItems($name, $items);
        return Payload::create(['message' => 'created list '.$name]);
    }


}