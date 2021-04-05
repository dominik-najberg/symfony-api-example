<?php declare(strict_types=1);

namespace App\Adapters\Http;

use App\Adapters\Http\Request\PostProductRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;

class PostProductHttpAdapter
{
    /**
     * @ParamConverter("postProductRequest", class="App\Adapters\Http\Request\PostProductRequest")
     */
    public function __invoke(PostProductRequest $postProductRequest): Response
    {
        var_dump($postProductRequest);

        return new Response(null, Response::HTTP_CREATED);
    }
}
