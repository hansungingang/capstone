
locals {
  cluster_name = "${aws_ecs_capacity_provider.cp.name}"
}     

resource "aws_ecs_cluster" "demo" {
  name = var.ecs_cluster_name

  capacity_providers = [local.cluster_name]

  default_capacity_provider_strategy {
    capacity_provider = local.cluster_name
  }
  # We need to terminate all instances before the cluster can be destroyed.
  # (Terraform would handle this automatically if the autoscaling group depended
  #  on the cluster, but we need to have the dependency in the reverse
  #  direction due to the capacity_providers field above).
  provisioner "local-exec" {
    when = destroy 
    interpreter = ["bash","-c"]
    command = "./del-asg.sh ${self.arn}"
    working_dir = path.module
  }
}