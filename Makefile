SHELL = /bin/bash

.PHONY: install

install:
	@echo "Generating files to match the host User and Group IDs for the container..."
	@source .env.sh; rm -f Dockerfile; CONTAINER_VARS='$$HOST_USER_ID:$$HOST_GROUP_ID:$$HOST_USER'; envsubst "$$CONTAINER_VARS" < "container/templates/Dockerfile.template" > "Dockerfile";
	@source .env.sh; rm -f container/config/group.sh; CONTAINER_VARS='$$HOST_GROUP_ID:$$HOST_USER'; envsubst "$$CONTAINER_VARS" < "container/templates/group.sh.template" > "container/config/group.sh";
	@source .env.sh; rm -f container/config/.bashrc; CONTAINER_VARS='$$CONTAINER_HOSTNAME'; envsubst "$$CONTAINER_VARS" < "container/templates/.bashrc.template" > "container/config/.bashrc";
	@source .env.sh; rm -f docker-compose.yml; CONTAINER_VARS='$$CONTAINERS_PREFIX'; envsubst "$$CONTAINER_VARS" < "container/templates/docker-compose.yml.template" > "docker-compose.yml";
	@echo "Building containers..."
	@docker-compose up -d
