resource "aws_ecs_task_definition" "demo" {
  family             = "demo"
  execution_role_arn = aws_iam_role.ecs-task-execution-role.arn
  task_role_arn      = aws_iam_role.ecs-demo-task-role.arn
  network_mode       = "bridge"
  requires_compatibilities = [
    "EC2"
  ]

  container_definitions = <<TASK_DEFINITION
[
  {
    "essential": true,
    "image": "${aws_ecr_repository.demo_php_fpm.repository_url}",
    "name": "app",
    "memory" : 512,
    "logConfiguration": {
            "logDriver": "awslogs",
            "options": {
               "awslogs-group" : "/ecs/demo",
               "awslogs-region": "${var.AWS_REGION}",
               "awslogs-stream-prefix": "ecs"
            }
     },
     "secrets": [],
     "environment": [
       {"name" : "DB_HOST", "value" : "${aws_db_instance.default.address}"},
       {"name" : "DB_DATABASE", "value" : "${aws_db_instance.default.name}"},
       {"name" : "DB_USERNAME" , "value": "${aws_db_instance.default.username}"},
       {"name" : "DB_PASSWORD" , "value" : "${aws_db_instance.default.password}"},
       {"name" : "REDIS_HOST" , "value" : "${aws_elasticache_cluster.redis.cache_nodes.0.address}"},
       {"name" : "SESSION_DRIVER" , "value" : "redis"},
       {"name" : "APP_KEY" , "value" : "base64:EHhE3uFhqWDJOrsPbt8TbGJ1aqkx523kxKXSjblpvz4="}
     ],
     "portMappings": [],
     "pseudoTerminal" : true
  },
  {
    "essential": true,
    "image": "${aws_ecr_repository.demo_nginx.repository_url}",
    "name": "nginx",
    "memory" : 256,
    "logConfiguration": {
            "logDriver": "awslogs",
            "options": {
               "awslogs-group" : "/ecs/demo",
               "awslogs-region": "${var.AWS_REGION}",
               "awslogs-stream-prefix": "ecs"
            }
     },
     "secrets": [],
     "environment": [],
     "portMappings": [
        {
           "hostPort": 8080,
           "containerPort": 80,
           "protocol": "tcp"
        }
     ],
     "dependsOn" : [
       {
         "containerName" : "app",
         "condition" : "START"
       }
     ],
     "links" : ["app"],
     "pseudoTerminal" : true
  }
]
TASK_DEFINITION

}

resource "aws_ecs_service" "demo" {
  name            = "demo"
  cluster         = aws_ecs_cluster.demo.id
  desired_count   = 1//2
  task_definition = aws_ecs_task_definition.demo.arn
  #launch_type     = "EC2"
  depends_on      = [aws_lb_listener.demo]
  scheduling_strategy = "REPLICA"
  deployment_minimum_healthy_percent = 100
  deployment_maximum_percent = 200
  iam_role = "${aws_iam_role.ecsServiceRole.arn}"

  deployment_controller {
    type = "CODE_DEPLOY"
  }

  load_balancer {
    target_group_arn = aws_lb_target_group.demo-blue.id #demo-green.id, demo-blue.id로 변경해야함.
    container_name   = "nginx"
    container_port   = "80"
  }

  capacity_provider_strategy {
    base              = 0
    capacity_provider = "${aws_ecs_capacity_provider.cp.name}"
    weight            = 1
  }

  lifecycle {
    ignore_changes = [
      task_definition,
      load_balancer
    ]
  }
}

resource "aws_appautoscaling_target" "ecs_target" {
  max_capacity       = 1//2
  min_capacity       = 1//2
  resource_id        = "service/${aws_ecs_cluster.demo.name}/${aws_ecs_service.demo.name}"
  scalable_dimension = "ecs:service:DesiredCount"
  service_namespace  = "ecs"
  role_arn           = "arn:aws:iam::${data.aws_caller_identity.current.account_id}:role/ecsAutoscaleRole"
}

resource "aws_appautoscaling_policy" "ecs_policy" {
  name               = "cpuscaling"
  policy_type        = "TargetTrackingScaling"
  resource_id        = aws_appautoscaling_target.ecs_target.resource_id
  scalable_dimension = aws_appautoscaling_target.ecs_target.scalable_dimension
  service_namespace  = aws_appautoscaling_target.ecs_target.service_namespace

 target_tracking_scaling_policy_configuration {
    predefined_metric_specification {
      predefined_metric_type = "ECSServiceAverageCPUUtilization"
    }

    target_value       = 50
    scale_in_cooldown  = 300
    scale_out_cooldown = 300
  }
}

# logs
resource "aws_cloudwatch_log_group" "ecs" {
  name = "/ecs/demo"
}
