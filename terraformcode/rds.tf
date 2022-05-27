# # ---------------------------------------------------------------------------------------------------------------------
# # CREATE AN SUBNET GROUP ACROSS ALL THE SUBNETS OF THE DEFAULT ASG TO HOST THE RDS INSTANCE
# # ---------------------------------------------------------------------------------------------------------------------
resource "aws_db_subnet_group" "example" {
  name       = "mysqldb"
  subnet_ids = slice(module.vpc.public_subnets, 0, 3)

  tags = {
    Name = "mysqldb"
  }
}

resource "aws_security_group" "db_instance" {
  name   = "mysqldb"
  vpc_id = module.vpc.vpc_id
}

resource "aws_security_group_rule" "allow_db_ingress_access" {
  type              = "ingress"
  from_port         = 3306
  to_port           = 3306
  protocol          = "tcp"
  security_group_id = aws_security_group.db_instance.id
  #source_security_group_id = aws_security_group.launchConfig.id
  cidr_blocks = ["0.0.0.0/0"]
}

resource "aws_security_group_rule" "allow_db_egrss_access" {
  type              = "egress"
  from_port         = 0
  to_port           = 0
  protocol          = "-1"
  security_group_id = aws_security_group.db_instance.id
  cidr_blocks = ["0.0.0.0/0"]
}
resource "aws_db_parameter_group" "mysql-parameters"{
    name = "mysqldb-parameters"
    family = "mysql5.7"
    description = "mysqlDB parameter group"

    parameter {
        name  = "max_allowed_packet"
        value = "16777216"
    }

    lifecycle {
      create_before_destroy = true
    }
}

resource "aws_db_instance" "default" {
  allocated_storage    = 100
  engine               = "mysql"
  engine_version       = "5.7"
  instance_class       = "db.t2.micro"
  name                 = "ebdb"
  username             = "sunggun1"
  password             = "ingangdamoa321#"
  parameter_group_name    = aws_db_parameter_group.mysql-parameters.name
  db_subnet_group_name   = aws_db_subnet_group.example.id
  vpc_security_group_ids = [aws_security_group.db_instance.id]
  multi_az                = false # set to true to have high availability: 2 instances synchronized with each other
  storage_type            = "gp2"
  backup_retention_period = 30                                          # how long you’re going to keep your backups
  availability_zone       = "ap-northeast-2a" # prefered AZ

  skip_final_snapshot     = true                                        # skip final snapshot when doing terraform destroy
  publicly_accessible     = true
  tags = {
    Name = "mysqldb-instance"
  }
}