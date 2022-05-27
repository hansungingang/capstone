resource "aws_elasticache_cluster" "redis" {
  cluster_id            = "redis"
  engine                = "redis"
  node_type             = "cache.t2.micro"
  num_cache_nodes       = "1"
  parameter_group_name  = "default.redis5.0"
  engine_version        = "5.0.6"
  port                  = "6379"
  security_group_ids  = ["${aws_security_group.redis.id}"]
  subnet_group_name     = "${aws_elasticache_subnet_group.redisSubnet.name}"
}

resource "aws_elasticache_subnet_group" "redisSubnet" {
  name       = "demo-redisSubnet"
  subnet_ids = slice(module.vpc.public_subnets, 0, 3)
}

resource "aws_security_group" "redis"{
    name = "demo-redis-sg"
    vpc_id      = module.vpc.vpc_id
    description = "redis_security_group"
}

resource "aws_security_group_rule" "allow_redis_ingress_access" {
  type              = "ingress"
  from_port         = 6379
  to_port           = 6379
  protocol          = "tcp"
  security_group_id = aws_security_group.redis.id
  source_security_group_id = aws_security_group.launchConfig.id
}

resource "aws_security_group_rule" "allow_redis_egrss_access" {
  type              = "egress"
  from_port         = 0
  to_port           = 0
  protocol          = "-1"
  security_group_id = aws_security_group.redis.id
  
  cidr_blocks = ["0.0.0.0/0"]
}