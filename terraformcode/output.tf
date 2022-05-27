output "ip"{
    description = "RDS instance hostname"
    value = aws_db_instance.default.address
}

output "ec2" {
    description = "ec2 host name"
    value = aws_lb.demo.dns_name
}

output "nginx_url" {
    description = "nginx url"
    value = aws_ecr_repository.demo_nginx.repository_url
}

output "php_fpm_url" {
    description = "php_fpm url"
    value = aws_ecr_repository.demo_php_fpm.repository_url
}