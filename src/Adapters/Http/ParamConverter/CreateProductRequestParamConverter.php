<?php declare(strict_types=1);

namespace App\Adapters\Http\ParamConverter;

use App\Adapters\Http\Request\CreateProductRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class CreateProductRequestParamConverter implements ParamConverterInterface
{
    private const SUPPORTED_CLASS = CreateProductRequest::class;

    public function apply(Request $request, ParamConverter $configuration): void
    {
        $request->attributes->set($configuration->getName(), CreateProductRequest::fromRequest($request));
    }

    public function supports(ParamConverter $configuration): bool
    {
        return self::SUPPORTED_CLASS === $configuration->getClass();
    }
}
