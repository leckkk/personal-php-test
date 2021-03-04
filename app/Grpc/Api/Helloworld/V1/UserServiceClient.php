<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Api\Helloworld\V1;

/**
 */
class UserServiceClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Api\Helloworld\V1\CreateUserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function CreateUser(\Api\Helloworld\V1\CreateUserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/api.helloworld.v1.UserService/CreateUser',
        $argument,
        ['\Api\Helloworld\V1\CreateUserReply', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Api\Helloworld\V1\UpdateUserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function UpdateUser(\Api\Helloworld\V1\UpdateUserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/api.helloworld.v1.UserService/UpdateUser',
        $argument,
        ['\Api\Helloworld\V1\UpdateUserReply', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Api\Helloworld\V1\DeleteUserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function DeleteUser(\Api\Helloworld\V1\DeleteUserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/api.helloworld.v1.UserService/DeleteUser',
        $argument,
        ['\Api\Helloworld\V1\DeleteUserReply', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Api\Helloworld\V1\GetUserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function GetUser(\Api\Helloworld\V1\GetUserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/api.helloworld.v1.UserService/GetUser',
        $argument,
        ['\Api\Helloworld\V1\GetUserReply', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Api\Helloworld\V1\ListUserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function ListUser(\Api\Helloworld\V1\ListUserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/api.helloworld.v1.UserService/ListUser',
        $argument,
        ['\Api\Helloworld\V1\ListUserReply', 'decode'],
        $metadata, $options);
    }

}
