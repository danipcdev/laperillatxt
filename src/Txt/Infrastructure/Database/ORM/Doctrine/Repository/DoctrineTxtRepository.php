<?php

declare(strict_types=1);

namespace Txt\Infrastructure\Database\ORM\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\LazyServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Txt\Domain\Exception\ResourceNotFoundException;
use Txt\Domain\Model\Txt;
use Txt\Domain\Repository\TxtRepository;
use Txt\Infrastructure\API\Filter\TxtFilter;
use Txt\Infrastructure\API\Response\PaginatedResponse;

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

    public function findOneByTitle(string $title): ?Txt
    {
        return $this->repository->findOneBy(['title' => $title]);
    }

    public function search(TxtFilter $filter): PaginatedResponse
    {
        $page = $filter->page;
        $limit = $filter->limit;
        $typeId = $filter->typeId;
        $sort = $filter->sort;
        $order = $filter->order;
        $title = $filter->title;

        $qb = $this->repository->createQueryBuilder('t');
        $qb->orderBy(\sprintf('t.%s', $sort), $order);

        if (null !== $typeId) {
            $qb
                ->andWhere('t.type = :typeId')
                ->setParameter(':typeId', $typeId);
        }

        if (null !== $title) {
            $qb
                ->andWhere('LOWER(t.title) LIKE LOWER(:title)')
                ->setParameter(':title', '%'.$title.'%');
        }

        $paginator = new Paginator($qb->getQuery());
        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        return PaginatedResponse::create($paginator->getIterator()->getArrayCopy(), $paginator->count(), $page, $limit);
    }

    public function save(Txt $txt): void
    {
        $this->manager->persist($txt);
        $this->manager->flush();
    }

    public function remove(Txt $txt): void
    {
        $this->manager->remove($txt);
        $this->manager->flush();
    }
}
