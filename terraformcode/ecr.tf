resource "aws_ecr_repository" "demo_php_fpm" {
  name = "demo-php-fpm"
}

resource "aws_ecr_repository" "demo_nginx" {
  name = "demo-nginx"
}