<?php declare(strict_types=1);

namespace Framework;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class RequestParamConverter implements ParamConverterInterface
{
    public function apply(Request $request, ParamConverter $configuration): void
    {
        $class = $configuration->getClass();
        $request->attributes->set($configuration->getName(), call_user_func([$class, 'fromRequest'], $request));
    }

    public function supports(ParamConverter $configuration): bool
    {
        return method_exists($configuration->getClass(), 'fromRequest');
    }
}
