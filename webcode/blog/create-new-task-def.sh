#!/bin/bash
set -ex
SERVICE_NAME=$1
APP_IMAGE_URI="$AWS_ACCOUNT_ID.dkr.ecr.$AWS_DEFAULT_REGION.amazonaws.com/$IMAGE_PHP_FPM_NAME:$CODEBUILD_RESOLVED_SOURCE_VERSION"
NGINX_IMAGE_URI="$AWS_ACCOUNT_ID.dkr.ecr.$AWS_DEFAULT_REGION.amazonaws.com/$IMAGE_NGINX_NAME:$CODEBUILD_RESOLVED_SOURCE_VERSION"
TASKDEF_NAME=$(aws ecs list-task-definitions |jq --raw-output '.taskDefinitionArns[] | select(contains("'${SERVICE_NAME}'"))' | tail -n1)
CURRENT_TASKDEF=`aws ecs describe-task-definition --task-definition $TASKDEF_NAME`
CURRENT_TASKDEF_CONTAINERDEF=`echo $CURRENT_TASKDEF| jq --raw-output ".taskDefinition.containerDefinitions"`
TASKDEF_ROLE_ARN=`echo $CURRENT_TASKDEF| jq --raw-output ".taskDefinition.taskRoleArn"`
EXECUTION_ROLE_ARN=`echo $CURRENT_TASKDEF| jq --raw-output ".taskDefinition.executionRoleArn"`
TASKDEF=`echo $CURRENT_TASKDEF_CONTAINERDEF | jq 'map((select(.["name"]=="'${PHP_FPM_TASK_DEFINITON_NAME}'") | .["image"] = "'${APP_IMAGE_URI}'")  // .["image"] = "'${NGINX_IMAGE_URI}'")'`
#CPU=$(echo $CURRENT_TASKDEF |jq -r '.taskDefinition.cpu')
#MEMORY=$(echo $CURRENT_TASKDEF |jq -r '.taskDefinition.memory')
NETWORK_MODE=$(echo $CURRENT_TASKDEF |jq -r '.taskDefinition.networkMode')
REQUIRES_COMPATIBILITIES=$(echo $CURRENT_TASKDEF |jq '.taskDefinition.requiresCompatibilities[]' | tr '\n' ',' | sed 's/.$//')
echo '{"family": "'${SERVICE_NAME}'", "taskRoleArn": "'${TASKDEF_ROLE_ARN}'", "executionRoleArn": "'${EXECUTION_ROLE_ARN}'", "containerDefinitions": '$TASKDEF', "requiresCompatibilities": ['$REQUIRES_COMPATIBILITIES'], "networkMode": "'${NETWORK_MODE}'" }' > taskdef.json
#aws ecs register-task-definition --cli-input-json file://task-def-template.json.new > task-def-template.json.out
#NEW_TASKDEF_ARN=`cat task-def-template.json.out |jq -r '.taskDefinition.taskDefinitionArn'`