<?php


namespace DrupalCampLdn;

use function Functional\pluck;
use League\Flysystem\FilesystemInterface;


class TodoRepository implements TodoRepositoryInterface
{
    /** @var FilesystemInterface */
    protected $filesystem;

    /**
     * @param FilesystemInterface $filesystem
     */
    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function listTodoLists(): array
    {
        $files = $this->filesystem->listContents();
        return pluck($files, 'filename');
    }

    public function saveItems(string $listName, array $items)
    {
        $data = json_encode($items);
        $this->filesystem->put($listName.'.json', $data);
    }

    public function getItems(string $listName): array
    {
        $data = $this->filesystem->read($listName.'.json');
        return json_decode($data, true);
    }
}