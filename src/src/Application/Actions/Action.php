<?php
declare(strict_types=1);

namespace App\Application\Actions;

use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;

abstract class Action
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var array
     */
    protected $args;

    /**
     * @var array
     */
    protected $headers;

    /**
     * @var array
     */
    protected $attributes;

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     * @return Response
     * @throws HttpNotFoundException
     * @throws HttpBadRequestException
     */
    public function __invoke(Request $request, Response $response, $args): Response
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
        $this->headers = $this->request->getHeaders();
        $this->attributes = $this->request->getAttributes();

        try {
            return $this->action();
        } catch (DomainRecordNotFoundException $e) {
            throw new HttpNotFoundException($this->request, $e->getMessage());
        }
    }

    /**
     * @return Response
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    abstract protected function action(): Response;

    /**
     * @return array|object
     * @throws HttpBadRequestException
     */
    protected function getFormData()
    {
        $input = json_decode(file_get_contents('php://input'));

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new HttpBadRequestException($this->request, 'Malformed JSON input.');
        }

        return $input;
    }

    /**
     * @return array
     */
    protected function getBody()
    {
        return $this->request->getParsedBody();
    }

    /**
     * @return array
     */
    protected function getQueryParams()
    {
        return $this->request->getQueryParams();
    }

    /**
     * @param  string $name
     * @return mixed
     * @throws HttpBadRequestException
     */
    protected function resolveArg(string $name)
    {
        if (!isset($this->args[$name])) {
            throw new HttpBadRequestException($this->request, "Could not resolve argument `{$name}`.");
        }

        return $this->args[$name];
    }

    protected function resolveHeader(string $name)
    {
        if (!isset($this->headers[$name])) {
            throw new HttpBadRequestException($this->request, "Could not resolve header `{$name}`.");
        }

        return $this->headers[$name];
    }

    protected function resolveAttribute(string $name)
    {
        if (!isset($this->attributes[$name])) {
            throw new HttpBadRequestException($this->request, "Could not resolve attribute `{$name}`.");
        }

        return $this->attributes[$name];
    }

    protected function resolveQueryParam(string $name)
    {
        $queryParams = $this->getQueryParams();

        if (!isset($queryParams[$name])) {
            throw new HttpBadRequestException($this->request, "Could not resolve query param `{$name}`");
        }

        return $queryParams[$name];
    }

    /**
     * @param  array|object|null $data
     * @return Response
     */
    protected function respondWithData($data = null): Response
    {
        $payload = new ActionPayload(200, $data);
        return $this->respond($payload);
    }

    /**
     * @param ActionPayload $payload
     * @return Response
     */
    protected function respond(ActionPayload $payload): Response
    {
        $json = json_encode($payload, JSON_PRETTY_PRINT);
        $this->response->getBody()->write($json);
        return $this->response->withHeader('Content-Type', 'application/json');
    }
}
