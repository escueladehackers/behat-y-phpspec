#!/bin/bash
export HOST_USER_ID=`id -u $USER`
export HOST_GROUP_ID=`id -g $USER`
export HOST_USER=`echo $USER`
export CONTAINER_HOSTNAME=ehackers
export CONTAINERS_PREFIX=ehackers