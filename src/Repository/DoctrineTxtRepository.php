<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Txt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

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
