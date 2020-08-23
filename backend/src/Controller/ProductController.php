<?php
namespace Src\Controller;

use Src\Repository\ProductRepository;

class ProductController {

    private $db;
    private $requestMethod;
    private $param;
    private $input;
    private $url;
    private $repository;

    /**
     * ProductController constructor.
     * @param $db
     * @param $requestMethod
     * @param $param
     * @param $url
     */
    public function __construct($db, $requestMethod, $param, $url)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->param = $param;
        $this->url = $url;
        $this->input = (array) json_decode(file_get_contents('php://input'), TRUE);
        $this->repository = new ProductRepository($db);
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if($this->url == 'product') {
                    $response = $this->getAllProducts();
                }
                if($this->url == 'random') {
                    $response = $this->getRandom();
                }
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    /**
     * @return mixed
     */
    private function getAllProducts()
    {
        return $this->successResponse($this->repository->findAll());
    }

    /**
     * @param $word
     * @return mixed
     */
    private function getRandom()
    {
        $result = $this->repository->random();

        return $this->successResponse($result);
    }

    /**
     * @return mixed
     */
    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }

    /**
     * @param null $body
     * @return mixed
     */
    private function successResponse($body = null)
    {
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = $body ? json_encode($body) : null;
        return $response;
    }
}