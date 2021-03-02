<?php
// GENERATED CODE -- DO NOT EDIT!

namespace ;

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
     * @param \CreateUserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function CreateUser(\CreateUserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/UserService/CreateUser',
        $argument,
        ['\CreateUserReply', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \UpdateUserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function UpdateUser(\UpdateUserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/UserService/UpdateUser',
        $argument,
        ['\UpdateUserReply', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \DeleteUserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function DeleteUser(\DeleteUserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/UserService/DeleteUser',
        $argument,
        ['\DeleteUserReply', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \GetUserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function GetUser(\GetUserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/UserService/GetUser',
        $argument,
        ['\GetUserReply', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \ListUserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function ListUser(\ListUserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/UserService/ListUser',
        $argument,
        ['\ListUserReply', 'decode'],
        $metadata, $options);
    }

}
