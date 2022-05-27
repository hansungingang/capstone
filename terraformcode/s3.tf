#
# cache s3 bucket
#
resource "aws_s3_bucket" "codebuild-cache" {
  bucket = "demo-codebuild-cache-${random_string.random.result}"
  acl    = "private"
}

resource "aws_s3_bucket" "demo-artifacts" {
  bucket = "demo-artifacts-${random_string.random.result}"
  acl    = "private"
  force_destroy = true

  lifecycle_rule {
    id      = "clean-up"
    enabled = "true"

    expiration {
      days = 30
    }
  }
}

resource "aws_s3_bucket" "images" {
  bucket = "images-ingangdamoa"
  acl    = "public-read-write"
  force_destroy = true
}
resource "aws_s3_bucket_policy" "images" {
  bucket = aws_s3_bucket.images.id

  # Terraform's "jsonencode" function converts a
  # Terraform expression's result to valid JSON syntax.
  policy = jsonencode({
    Version = "2012-10-17"
    Id      = "MYBUCKETPOLICY"
    Statement = [
      {
        Sid       = "PublicReadGetObject"
        Effect    = "Allow"
        Principal = "*"
        Action    =  [
                "s3:GetObject",
                "s3:DeleteObject",
                "s3:PutObject"
            ]
        Resource = [
          aws_s3_bucket.images.arn,
          "${aws_s3_bucket.images.arn}/*",
        ]
      },
    ]
  })
}

resource "random_string" "random" {
  length  = 8
  special = false
  upper   = false
}

