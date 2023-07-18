<?php

declare(strict_types=1);

namespace Type\Infrastructure\Database\ORM\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\LazyServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Type\Domain\Exception\ResourceNotFoundException;
use Type\Domain\Model\Type;
use Type\Domain\Repository\TypeRepository;

readonly class DoctrineTypeRepository implements TypeRepository
{
    private LazyServiceEntityRepository $repository;
    private ObjectManager $manager;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->repository = new LazyServiceEntityRepository($managerRegistry, Type::class);
        $this->manager = $managerRegistry->getManager();
    }

    public function findOneByIdOrFail(string $id): Type
    {
        if (null === $type = $this->repository->find($id)) {
            throw ResourceNotFoundException::createFromClassAndId(Type::class, $id);
        }

        return $type;
    }

    public function save(Type $type): void
    {
        $this->manager->persist($type);
        $this->manager->flush();
    }

    public function remove(Type $type): void
    {
        $this->manager->remove($type);
        $this->manager->flush();
    }
}
