<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: user.proto

namespace GPBMetadata;

class User
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        $pool->internalAddGeneratedFile(
            '
�

user.proto" 
User

id (
name (	"!
CreateUserRequest
name (	"&
CreateUserReply
User (2.User"-
UpdateUserRequest

id (
name (	"&
UpdateUserReply
User (2.User"
DeleteUserRequest

id ("
DeleteUserReply"
GetUserRequest

id ("#
GetUserReply
User (2.User"
ListUserRequest"\'
ListUserReply
results (2.User2�
UserService4

CreateUser.CreateUserRequest.CreateUserReply" 4

UpdateUser.UpdateUserRequest.UpdateUserReply" 4

DeleteUser.DeleteUserRequest.DeleteUserReply" +
GetUser.GetUserRequest.GetUserReply" .
ListUser.ListUserRequest.ListUserReply" B6
api.helloworld.v1PZtestKratos/api/helloworld/v1;v1bproto3'
        , true);

        static::$is_initialized = true;
    }
}

