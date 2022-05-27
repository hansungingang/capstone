data "aws_ami" "aws_optimized_ecs" {
  most_recent = true

  filter {
    name   = "name"
    #values = ["amzn-ami-*-amazon-ecs-optimized"]
    values = ["amzn2-ami-ecs-hvm*"]
  }

  filter {
      name   = "virtualization-type"
      values = ["hvm"]
  }  

  filter {
      name   = "architecture"
      values = ["x86_64"]
  }


  owners = ["amazon"] # AWS owner name
}

resource "aws_launch_configuration" "launchConfig" {
  name_prefix = "laravel-launchConfig"
  image_id      = data.aws_ami.aws_optimized_ecs.id
  instance_type = "t2.micro"
  iam_instance_profile = "${aws_iam_instance_profile.ecsInstanceRole.id}"

  security_groups = ["${aws_security_group.launchConfig.id}"]
  
  user_data = <<-EOF
              #!/bin/bash 
              echo ECS_CLUSTER=${var.ecs_cluster_name} >> /etc/ecs/ecs.config
              EOF

  root_block_device {
      volume_size = "30"
      volume_type = "gp2"
      delete_on_termination = true
  }

  lifecycle {
    create_before_destroy = true
  }  
}

resource "aws_security_group" "launchConfig" {
  name        = "launchConfig"
  vpc_id      = module.vpc.vpc_id
  description = "launchConfig"
}

resource "aws_security_group_rule" "allow_lc_ingress_access" {
  type              = "ingress"
  from_port         = 8080
  to_port           = 8080
  protocol          = "tcp"
  security_group_id = aws_security_group.launchConfig.id
  source_security_group_id = aws_security_group.lb_sg.id
}

resource "aws_security_group_rule" "allow_lc_egrss_access" {
  type              = "egress"
  from_port         = 0
  to_port           = 0
  protocol          = "-1"
  security_group_id = aws_security_group.launchConfig.id
  cidr_blocks = ["0.0.0.0/0"]
}