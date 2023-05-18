<?php

declare(strict_types=1);

namespace Txt\Infrastructure\Database\ORM\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Txt\Domain\Model\Txt;
use Txt\Domain\Repository\TxtRepository;

readonly class DoctrineTxtRepository implements TxtRepository
{
    private ServiceEntityRepository $repository;
    private ObjectManager $manager;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->repository = new ServiceEntityRepository($managerRegistry, Txt::class);
        $this->manager = $managerRegistry->getManager();
    }

    public function save(Txt $txt): void
    {
        $this->manager->persist($txt);
        $this->manager->flush();
    }
}
