# HELP
# This will output the help for each task
# thanks to https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
all: help
.PHONY: all

TAG ?= :v$(shell date +%Y%m%d)
REPOSITORY ?= justdomepaul
PROJECT_ID = labs-371707
SQL_DB_SECRET_NAME ?= wordpress-db-password
DB_HOST ?= labs-371707:asia-east1:wp
DB_PASSWORD ?= wordpress
TAG_STAGE = :stage
IMG_PREFIX = base
IMG_WP = $(IMG_PREFIX)-wp

help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.DEFAULT_GOAL := help

run: ## run wp
	docker-compose up -d

down: ## down wp
	docker-compose down

set-cloud-sql: ## cloud sql command
	wget https://dl.google.com/cloudsql/cloud_sql_proxy.linux.amd64 -O cloud_sql_proxy
	chmod +x cloud_sql_proxy
	gcloud auth login
	gcloud auth application-default login

up-cloud-proxy-sql: ## start cloud proxy sql
	./cloud_sql_proxy -instances=$(NAME)=tcp:3306

build: ## build all images
	docker build -f ./Dockerfile --tag $(REPOSITORY)/$(IMG_WP)$(TAG) --rm .
	docker image tag $(REPOSITORY)/$(IMG_WP)$(TAG) $(REPOSITORY)/$(IMG_WP)$(TAG_STAGE)

cloud-create-secret: ## create cloud secret manager
	gcloud secrets create $(SQL_DB_SECRET_NAME) --replication-policy="automatic"
	echo -n "$(DB_PASSWORD)" | gcloud secrets versions add $(SQL_DB_SECRET_NAME) --data-file=-

cloud-build: ## build image and push by google cloud build
	gcloud config set project $(PROJECT_ID)
	gcloud builds submit --gcs-source-staging-dir=gs://gcr_image_store/source --config ./cloudbuild.yaml --substitutions=_TAG=$(TAG),_SECRETID=$(SQL_DB_SECRET_NAME),_DBHOST=$(DB_HOST)

