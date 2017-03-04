<?php

namespace DrupalCampLdn;


interface TodoRepositoryInterface
{
    /**
     * @return string[]
     */
    public function listTodoLists(): array;


    public function saveItems(string $listName, array $items);


    public function getItems(string $listName): array;

}
