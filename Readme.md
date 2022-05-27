# 인강다모아

> 흩어져 있는 모든 인터넷 강의를 다 모아서 통합하여 보여주자!

현 온라인 강의 시장은 다양한 선택권을 제공하나 방대한 자료들이 존재하여 소비자 입장에서 강의 내용과 가격 등 중요 정보를 비교하며 선택하기 어렵다. 또한 강사는 강의 영상을 개인 SNS를 통해 홍보를 진행해야 하기 때문에 부수적인 비용 발생되고 많은 시간이 소요된다. 

이러한 단점을 보완하기 위해 여러 사이트의 강의들을 한 사이트에서 검색할 수 있도록 하여 소비자친화적인 사이트를 구현하였다. 이를 통해 강사 역시 소비자에게 쉽게 노출되어 광고비용 및 시간을 절감할 수 있도록 한다.


![캡처](https://user-images.githubusercontent.com/102017647/170690928-39be5e91-db63-48e8-9a5d-1a4ae5e4bfa1.PNG)







# 목차

1. [설치](#설치)
2. [설치 및 실행](#설치-및-실행)
3. [프로젝트 구조](#프로젝트-구조)
4. [기능](#기능)
5. [팀원](#팀원)
6. [링크](#링크)







## 설치 

##### 필수설치 웹

* PHP 

  * PHP 7.4(7.4.26)버전 VS 16 x64 Thread Safe 버전 zip 파일 
  * https://asufi.tistory.com/entry/Windows-10-64bit-%ED%99%98%EA%B2%BD-PHP-%EC%84%A4%EC%B9%98%ED%95%98%EA%B8%B0 3번까지 설치

* Composer

  * 컴포저 설치
  * https://blog.gaerae.com/2015/07/install-composer-on-windows.html 
  * https://b.redinfo.co.kr/46 (php에서 windows 로 composer 설치 및 진행)

* 라라벨 설치

  * [![img](https://laravel.kr/favicon-16x16.png)라라벨 8.x - 설치하기](https://laravel.kr/docs/8.x/installation) 

  * ```
    라라벨 설치 후
    composer global require laravel/installer (라라벨 다운로드)
    laravel new blog (라라벨 새로운 폴더에 만들어서 다운이 잘 됐는지 확인하고 해당 폴더 삭제.)
    ```

* git 설치

  * https://goddaehee.tistory.com/216 git 설치
  *  https://wtg-study.tistory.com/84 git 환경변수 설정

* Docker windows 

  * https://www.lainyzine.com/ko/article/how-to-install-wsl2-and-use-linux-on-windows-10/ WSL2 설치 
  * https://www.lainyzine.com/ko/article/a-complete-guide-to-how-to-install-docker-desktop-on-windows-10/  도커 Windows 설치 

* Vscode 

  * https://penguingoon.tistory.com/185

  





##### 테라폼 설치

* https://may9noy.tistory.com/422 테라폼 설치



##### 파이썬 설치

*  https://dora-guide.com/python-download/ 파이썬 설치





# 설치 및 실행

* docker for windows를 실행 시킨 후에 vscode 터미널에서 아래 명령어 치기.

  demo폴더 아래에서 실행하기

  .env 파일 생성

  ```
  APP_NAME=Laravel
  APP_ENV=local
  APP_KEY=base64:EHhE3uFhqWDJOrsPbt8TbGJ1aqkx523kxKXSjblpvz4=
  APP_DEBUG=true
  APP_URL=http://blog.test
  
  LOG_CHANNEL=stack
  LOG_LEVEL=debug
  
  DB_CONNECTION=mysql
  DB_HOST=db
  DB_PORT=3306
  DB_DATABASE=laravel
  DB_USERNAME=root
  DB_PASSWORD=도커 컴포즈 파일에 적혀있는 DB 패스워드
  
  BROADCAST_DRIVER=log
  CACHE_DRIVER=file
  FILESYSTEM_DRIVER=local
  QUEUE_CONNECTION=sync
  SESSION_DRIVER=file
  SESSION_LIFETIME=120
  
  MEMCACHED_HOST=127.0.0.1
  
  REDIS_HOST=127.0.0.1
  REDIS_PASSWORD=null
  REDIS_PORT=6379
  
  MAIL_MAILER=smtp
  MAIL_HOST=smtp.gmail.com
  MAIL_PORT=465
  MAIL_USERNAME= 구글 이메일 주소
  MAIL_PASSWORD= 보내는 메일 앱 비밀번호
  MAIL_ENCRYPTION=ssl
  MAIL_FROM_ADDRESS=보내는 메일 이름 변경
  #MAIL_FROM_NAME="${APP_NAME}"
  
  AWS_ACCESS_KEY_ID=AWS 계정 키
  AWS_SECRET_ACCESS_KEY= AWS 계정 패스워드
  AWS_DEFAULT_REGION=AWS 계정 지역
  AWS_BUCKET=AWS bucket 주소
  AWS_URL = 
  AWS_S3_URL = AWS S3 주소
  
  PUSHER_APP_ID=
  PUSHER_APP_KEY=
  PUSHER_APP_SECRET=
  PUSHER_APP_CLUSTER=mt1
  
  MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
  MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
  
  ANALYTICS_VIEW_ID=구글 analytics id 값
  ```

  

  vscode terminal demo 폴더 아래에서

  ```
  composer install
  php artisan key:generate 
  composer require laravel/ui 모두 엔터 
  
  docker desktop 실행 
  docker build -t docker/nginx -f .\docker\nginx\Dockerfile . 
  docker build -t docker/laravel -f .\docker\php-fpm\Dockerfile_php --progress=plain  
  docker-compose up 
  
  docker run --rm -v ${PWD}:/app composer update
  docker run --rm -v ${PWD}:/app composer install
  
  파일에서 ./start_script.sh CRLF →  LF 파일로 변경하기 
  shell 파일을 LF (Unix)로 바꿔야 도커 이미지에서 실행이 된다.
  
  docker 코드 실행이 안 된다면 Docker for windows 설정을 아래와 같이 변경.
  filesharing에서 자신의 위치를 추가시켜줘야 함.
  ```
![도커컴포즈설정1](https://user-images.githubusercontent.com/102017647/170691221-7d9f11d0-f0b3-4421-9bfa-d505aa9ed3b6.png)


![도커컴포즈설정2](https://user-images.githubusercontent.com/102017647/170691232-bf18082c-5bc8-4752-8a0d-cb2c7e43de39.png)





##### 테라폼 실행

```
terraform init (테라폼 초기화)
terraform plan (테라폼 코드 개발 후 적용 전 확인 가능 단계)
terraform apply (테라폼 개발 실서버에 적용)


terraform destroy(실서버에 적용한 것 돌려놓기)
```

* https://velog.io/@gentledev10/install-terraform-and-commands 참조






<hr/>

### 그 외 설치

* mysql workbench (mysql database gui 프로그램)
* sourcetree (git을 gui로 보여주는 프로그램)
* erdcloud.com (데이터베이스 erd 생성 페이지)







# 프로젝트 구조


![졸업작품구조](https://user-images.githubusercontent.com/102017647/170691280-90c4d9c6-3513-42c2-9e00-b689b0e43526.PNG)


테라폼 AWS 구조

![aws terraform 설명](https://user-images.githubusercontent.com/102017647/170691623-c09b2a97-762f-4639-ad4d-d0635594dead.png)



# 기능

* 메인화면



![메인화면](https://user-images.githubusercontent.com/102017647/170691302-155ecc40-d999-4b53-9341-292f2dd8f792.PNG)




* 로그인


![로그인](https://user-images.githubusercontent.com/102017647/170691308-a492f417-47d5-4b18-94ba-6eaf0b5ea220.PNG)


* 회원가입



![회원가입](https://user-images.githubusercontent.com/102017647/170691313-ce8da841-24df-415d-baf6-9388683f2e6f.PNG)

 

* 인터넷 강의 리스트

![인강 리스트 화면](https://user-images.githubusercontent.com/102017647/170691333-12c4cec5-4b26-4b68-8e6f-d0506d87b3db.PNG)



* 게시판

![게시판](https://user-images.githubusercontent.com/102017647/170691341-8054b3c7-396d-413e-a0ec-ab26f0f95c90.PNG)



* 최근 본 목록

![최근본목록](https://user-images.githubusercontent.com/102017647/170691346-f4b95a1c-a2a3-4f70-9473-148414a2cf08.PNG)



* 어드민 페이지


![어드민](https://user-images.githubusercontent.com/102017647/170691434-59bc4e68-4401-4ccf-9fc7-b0e35b1654ce.PNG)


# 팀원

김현
<br>
역할 : 크롤링
<br>
github : https://github.com/stelladream1
<br>
<br>
노길현
<br>
역할 : 웹 프론트
<br>
github : https://github.com/rgh130
<br>
<br>
조성진
<br>
역할 : 크롤링
<br>
github : 
<br>
<br>
조성권 
<br>
역할 : 서버,프론트,백엔드
<br>
github : https://github.com/sunggun1
<br>
<br>



# 링크

크롤링  : https://github.com/hansungingang/capstone_crawling

사이트 주소 : http://demo-257674007.ap-northeast-2.elb.amazonaws.com/
