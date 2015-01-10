<?php
namespace ApigilityClient\Http\Client;

use ApigilityClient\Http\Response;

interface ClientInterface
{
    /**
     * Send a GET request
     *
     * @param String $path
     * @param Array $data
     *
     * @return Response
     */
    public function get($path, array $data = array());

    /**
     * Send a POST request
     *
     * @param String $path
     * @param Array  $data
     *
     * @return Response
     */
    public function post($path, array $data);

    /**
     * Send a PUT request
     *
     * @param String $path
     * @param Array  $data
     *
     * @return Response
     */
    public function put($path, array $data);

    /**
     * Send a DELETE request
     *
     * @param String $path
     *
     * @return Response
     */
    public function delete($path);

    /**
     * Send a PATCH request
     *
     * @param String $path
     * @param Array  $data
     *
     * @return Response
     */
    public function patch($path, array $data);
}
