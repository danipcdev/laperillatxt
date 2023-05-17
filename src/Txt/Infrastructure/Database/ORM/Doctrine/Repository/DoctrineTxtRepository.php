<?php

declare(strict_types=1);

namespace Txt\Infrastructure\Database\ORM\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Txt\Domain\Model\Txt;
use Txt\Domain\Repository\TxtRepository;
use Txt\Infrastructure\Database\ORM\Doctrine\Entity\DoctrineTxt;

readonly class DoctrineTxtRepository implements TxtRepository
{
    private ServiceEntityRepository $repository;
    private ObjectManager $manager;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->repository = new ServiceEntityRepository($managerRegistry, DoctrineTxt::class);
        $this->manager = $managerRegistry->getManager();
    }

    public function save(Txt $txt): void
    {
        $doctrineTxt = DoctrineTxt::createFromDomainTxt($txt);

        $this->manager->persist($doctrineTxt);
        $this->manager->flush();
    }
}
