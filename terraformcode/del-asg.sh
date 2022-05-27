#!/bin/bash
set -ex

SELF_ARN=$1

CAP_PROVS=`aws ecs describe-clusters --clusters "${SELF_ARN}" --query 'clusters[*].capacityProviders[*]' --output text`

ASG_ARNS=`aws ecs describe-capacity-providers \
--capacity-providers "$CAP_PROVS" \
--query 'capacityProviders[*].autoScalingGroupProvider.autoScalingGroupArn' \
--output text`

echo ${ASG_ARNS}

if [ -n "$ASG_ARNS" ] && [ "$ASG_ARNS" != "None" ]
then
for ASG_ARN in $ASG_ARNS
do
    ASG_NAME=$(echo $ASG_ARN | cut -d/ -f2-)

    aws autoscaling update-auto-scaling-group \
    --auto-scaling-group-name "$ASG_NAME" \
    --min-size 0 --max-size 0 --desired-capacity 0

    INSTANCES=`aws autoscaling describe-auto-scaling-groups \
    --auto-scaling-group-names "$ASG_NAME" \
    --query 'AutoScalingGroups[*].Instances[*].InstanceId' \
    --output text`

    aws autoscaling set-instance-protection --instance-ids $INSTANCES \
    --auto-scaling-group-name "$ASG_NAME" \
    --no-protected-from-scale-in

    aws autoscaling delete-auto-scaling-group \
    --auto-scaling-group-name "$ASG_NAME" \
    --force-delete
done
fi