<?php

declare(strict_types=1);

namespace Txt\Infrastructure\ArgumentResolver;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Txt\Infrastructure\DTO\RequestDTO;
use Txt\Infrastructure\RequestTransformer\RequestTransformer;

readonly class RequestArgumentResolver implements ValueResolverInterface
{
    public function __construct(
        private RequestTransformer $requestTransformer
    ) {
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return (new \ReflectionClass($argument->getType()))->implementsInterface(RequestDTO::class);
    }

    public function resolve(Request $request, ArgumentMetadata $argument): \Generator
    {
        $this->requestTransformer->transform($request);

        $class = $argument->getType();

        yield new $class($request);
    }
}
