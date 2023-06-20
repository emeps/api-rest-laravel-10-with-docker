<?php

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Models\Support;
use App\Repositories\SupportRepositoryInterface;
use stdClass;

class SupportEloquentORM implements SupportRepositoryInterface
{
    public function __construct(
        protected readonly Support $model
    ) {
    }

    public function getAll(string $filter = null): array
    {
        return $this->model
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('subject', $filter);
                    $query->orWhere('content', 'like', "%{$filter}%");
                }
            })
            ->all()
            ->toArray();
    }
    public function findOne(string | int $id): stdClass|null
    {
        $support = (object)$this->model->find($id)->toArray();
        if (!$support) {
            return null;
        }
        return (object)$support->toArray();
    }
    public function new(CreateSupportDTO $dto): stdClass
    {
        $support= $this->model->create((array)$dto);
        return (object)$support->toArray();
    }
    public function update(UpdateSupportDTO $dto): stdClass|null
    {
        $support = $this->model->find($dto->id);
        if (!$support) {
            return null;
        }
        $support->update((array)$dto);
        return (object)$support->toArray();
    }
    public function delete(string | int $id): void
    {
        $this->model->findOrfail($id)->delete();
    }
}
