<?php

declare(strict_types=1);

namespace Txt\Infrastructure\Database\ORM\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\LazyServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Txt\Domain\Exception\ResourceNotFoundException;
use Txt\Domain\Model\Txt;
use Txt\Domain\Repository\TxtRepository;

readonly class DoctrineTxtRepository implements TxtRepository
{
    private LazyServiceEntityRepository $repository;
    private ObjectManager $manager;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->repository = new LazyServiceEntityRepository($managerRegistry, Txt::class);
        $this->manager = $managerRegistry->getManager();
    }

    public function findOneByIdOrFail(string $id): Txt
    {
        if (null === $txt = $this->repository->find($id)) {
            throw ResourceNotFoundException::createFromClassAndId(Txt::class, $id);
        }

        return $txt;
    }

    public function save(Txt $txt): void
    {
        $this->manager->persist($txt);
        $this->manager->flush();
    }
}
