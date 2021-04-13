<?php declare(strict_types=1);

namespace App\Adapters\Http\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ApiExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return array(
            KernelEvents::EXCEPTION => 'onKernelException',
        );
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $e          = $event->getThrowable();
        $statusCode = $e->getStatusCode() ?? Response::HTTP_INTERNAL_SERVER_ERROR;

        $response = new JsonResponse(
            [
                'errors' => [
                    [
                        'status' => $statusCode,
                        'detail' => $e->getMessage(),

                    ],
                ]
            ],
            $statusCode,
        );

        $event->setResponse($response);
    }
}