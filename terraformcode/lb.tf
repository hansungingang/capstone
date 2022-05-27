resource "aws_lb" "demo" {
  name                             = "demo"
  subnets                          = module.vpc.public_subnets
  load_balancer_type               = "application"
  enable_cross_zone_load_balancing = true

  security_groups = [aws_security_group.lb_sg.id]
}

resource "aws_security_group" "lb_sg"{
  name_prefix        = "demo-lb"
  description        = "load balancer security group"
  vpc_id             = module.vpc.vpc_id

  ingress = [
    {
      description      = "TLS from VPC"
      from_port        = 80
      to_port          = 80
      protocol         = "tcp"
      cidr_blocks      = ["0.0.0.0/0"]
      ipv6_cidr_blocks = []
      prefix_list_ids = []
      security_groups = []
      self = false   
    }
  ]

  egress = [
    {
      description      = "for all outgoing traffics"
      from_port        = 0
      to_port          = 0
      protocol         = "-1"
      cidr_blocks      = ["0.0.0.0/0"]
      ipv6_cidr_blocks = ["::/0"]
      prefix_list_ids = []
      security_groups = []
      self = false
    }
  ]

  lifecycle {
    create_before_destroy = true
  }
}

resource "aws_lb_listener" "demo" {
  load_balancer_arn = aws_lb.demo.arn
  port              = "80"
  protocol          = "HTTP"

  default_action {
    type             = "forward"
    target_group_arn = aws_lb_target_group.demo-blue.id
    forward{
      target_group{
        arn = aws_lb_target_group.demo-blue.arn
      }
      
      target_group{
        arn = aws_lb_target_group.demo-green.arn
      }
    }
  }
  lifecycle {
    ignore_changes = [
      default_action,
    ]
  }
}

resource "aws_lb_target_group" "demo-blue" {
  name                 = "demo-http-blue"
  port                 = "80"
  protocol             = "HTTP"
  target_type          = "instance"
  vpc_id               = module.vpc.vpc_id
  deregistration_delay = "30"

  health_check {
    healthy_threshold   = 5
    unhealthy_threshold = 5
    protocol            = "HTTP"
    interval            = 30
    path                = "/"
  }
}
resource "aws_lb_target_group" "demo-green" {
  name                 = "demo-http-green"
  port                 = "80"
  protocol             = "HTTP"
  target_type          = "instance"
  vpc_id               = module.vpc.vpc_id
  deregistration_delay = "30"

  health_check {
    healthy_threshold   = 5
    unhealthy_threshold = 5
    protocol            = "HTTP"
    interval            = 30
    path                = "/"
  }
}
