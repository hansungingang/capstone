provider "aws" {
  region = var.AWS_REGION
  access_key = "AKIAVEEOCLJLI32SIF6C"
  secret_key = "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"
}

data "aws_availability_zones" "available" {
}

data "aws_caller_identity" "current" {
}
