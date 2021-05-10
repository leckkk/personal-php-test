<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Api\Brand\V1;

/**
 */
class BrandClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Api\Brand\V1\CreateBrandRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function CreateBrand(\Api\Brand\V1\CreateBrandRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/api.brand.v1.Brand/CreateBrand',
        $argument,
        ['\Api\Brand\V1\CreateBrandReply', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Api\Brand\V1\UpdateBrandRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function UpdateBrand(\Api\Brand\V1\UpdateBrandRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/api.brand.v1.Brand/UpdateBrand',
        $argument,
        ['\Api\Brand\V1\UpdateBrandReply', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Api\Brand\V1\DeleteBrandRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function DeleteBrand(\Api\Brand\V1\DeleteBrandRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/api.brand.v1.Brand/DeleteBrand',
        $argument,
        ['\Api\Brand\V1\DeleteBrandReply', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Api\Brand\V1\GetBrandRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function GetBrand(\Api\Brand\V1\GetBrandRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/api.brand.v1.Brand/GetBrand',
        $argument,
        ['\Api\Brand\V1\GetBrandReply', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Api\Brand\V1\ListBrandRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function ListBrand(\Api\Brand\V1\ListBrandRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/api.brand.v1.Brand/ListBrand',
        $argument,
        ['\Api\Brand\V1\ListBrandReply', 'decode'],
        $metadata, $options);
    }

}
