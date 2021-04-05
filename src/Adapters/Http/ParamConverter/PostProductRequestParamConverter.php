<?php declare(strict_types=1);

namespace App\Adapters\Http\ParamConverter;

use App\Adapters\Http\Request\PostProductRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class PostProductRequestParamConverter implements ParamConverterInterface
{
    private const SUPPORTED_CLASS = PostProductRequest::class;

    public function apply(Request $request, ParamConverter $configuration): void
    {
        $request->attributes->set($configuration->getName(), PostProductRequest::fromRequest($request));
    }

    public function supports(ParamConverter $configuration): bool
    {
        return self::SUPPORTED_CLASS === $configuration->getClass();
    }
}
