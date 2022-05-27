# code build
resource "aws_codebuild_project" "demo" {
  name           = "demo-docker-build"
  description    = "demo docker build"
  build_timeout  = "30"
  service_role   = aws_iam_role.demo-codebuild.arn
  encryption_key = aws_kms_alias.demo-artifacts.arn

  artifacts {
    type = "CODEPIPELINE"
  }

  #cache {
  #  type     = "S3"
  #  location = aws_s3_bucket.codebuild-cache.bucket
  #}

  environment {
    compute_type    = "BUILD_GENERAL1_SMALL"
    image           = "aws/codebuild/standard:5.0"
    type            = "LINUX_CONTAINER"
    privileged_mode = true

    environment_variable {
      name  = "AWS_DEFAULT_REGION"
      value = var.AWS_REGION
    }
    environment_variable {
      name  = "AWS_ACCOUNT_ID"
      value = data.aws_caller_identity.current.account_id
    }
    environment_variable{
      name ="IMAGE_PHP_FPM_NAME"
      value = aws_ecr_repository.demo_php_fpm.name
    }
    environment_variable{
      name = "IMAGE_NGINX_NAME"
      value = aws_ecr_repository.demo_nginx.name
    }
    environment_variable{
      name = "PHP_FPM_TASK_DEFINITON_NAME"
      value = "app"
    }
  }

  source {
    type      = "CODEPIPELINE"
    buildspec = "buildspec.yml"
  }

  #depends_on      = [aws_s3_bucket.codebuild-cache]
}

