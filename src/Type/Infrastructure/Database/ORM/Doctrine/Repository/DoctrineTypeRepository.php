<?php

declare(strict_types=1);

namespace Type\Infrastructure\Database\ORM\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\LazyServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Type\Infrastructure\API\Filter\TypeFilter;
use Type\Infrastructure\API\Response\PaginatedResponse;
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

    public function search(TypeFilter $filter): PaginatedResponse
    {
        $page = $filter->page;
        $limit = $filter->limit;
        $sort = $filter->sort;
        $order = $filter->order;
        $name = $filter->name;

        $qb = $this->repository->createQueryBuilder('t');
        $qb->orderBy(\sprintf('t.%s', $sort), $order);

        if (null !== $name) {
            $qb
                ->andWhere('LOWER(t.name) LIKE LOWER(:name)')
                ->setParameter(':name', '%'.$name.'%');
        }

        $paginator = new Paginator($qb->getQuery());
        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        return PaginatedResponse::create($paginator->getIterator()->getArrayCopy(), $paginator->count(), $page, $limit);
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
