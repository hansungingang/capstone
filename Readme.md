# 인강다모아

> 흩어져 있는 모든 인터넷 강의를 다 모아서 통합하여 보여주자!

현 온라인 강의 시장은 다양한 선택권을 제공하나 방대한 자료들이 존재하여 소비자 입장에서 강의 내용과 가격 등 중요 정보를 비교하며 선택하기 어렵다. 또한 강사는 강의 영상을 개인 SNS를 통해 홍보를 진행해야 하기 때문에 부수적인 비용 발생되고 많은 시간이 소요된다. 

이러한 단점을 보완하기 위해 여러 사이트의 강의들을 한 사이트에서 검색할 수 있도록 하여 소비자친화적인 사이트를 구현하였다. 이를 통해 강사 역시 소비자에게 쉽게 노출되어 광고비용 및 시간을 절감할 수 있도록 한다.

![image-20220527185029717](C:\Users\dell\AppData\Roaming\Typora\typora-user-images\image-20220527185029717.png)







# 목차

1. [설치](#설치)
2. [설치 및 실행](#설치 및 실행)
3. [프로젝트 구조](#프로젝트 구조)







## 설치 

##### 필수설치 웹

* PHP 

  * PHP 7.4(7.4.26)버전 VS 16 x64 Thread Safe 버전 zip 파일 
  * https://asufi.tistory.com/entry/Windows-10-64bit-%ED%99%98%EA%B2%BD-PHP-%EC%84%A4%EC%B9%98%ED%95%98%EA%B8%B0 3번까지 설치

* Composer

  * 컴포저 설치
  * https://blog.gaerae.com/2015/07/install-composer-on-windows.html 
  * ![66ff856c-c648-44d4-a5db-9ebf9f9bac77](C:\Users\dell\OneDrive\바탕 화면\66ff856c-c648-44d4-a5db-9ebf9f9bac77.png)
  * https://b.redinfo.co.kr/46 (php에서 windows 로 composer 설치 및 진행)

* 라라벨 설치

  * [![img](https://laravel.kr/favicon-16x16.png)라라벨 8.x - 설치하기](https://laravel.kr/docs/8.x/installation) 

  * ```
    라라벨 설치 후
    composer global require laravel/installer (라라벨 다운로드)
    laravel new blog (라라벨 새로운 폴더에 만듬.)
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

![image-20211230-081423](C:\Users\dell\OneDrive\바탕 화면\image-20211230-081423.png)

![image-20211230-081439](C:\Users\dell\OneDrive\바탕 화면\image-20211230-081439.png)



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
* visual studio code 설치 







# 프로젝트 구조



![졸업작품구조](C:\한성대\2022 1학기\졸업작품\최종\졸업작품구조.PNG)

# 기능

* 메인화면

![메인화면](C:\한성대\2022 1학기\졸업작품\최종\홈페이지 화면\메인화면.PNG)





* 로그인

![로그인](C:\한성대\2022 1학기\졸업작품\최종\홈페이지 화면\로그인.PNG)



* 회원가입

![회원가입](C:\한성대\2022 1학기\졸업작품\최종\홈페이지 화면\회원가입.PNG)





* 게시판

![게시판](C:\한성대\2022 1학기\졸업작품\최종\홈페이지 화면\게시판.PNG)



* 인터넷 강의 리스트

![인강 리스트 화면](C:\한성대\2022 1학기\졸업작품\최종\홈페이지 화면\인강 리스트 화면.PNG)





* 최근 본 목록

![최근본목록](C:\한성대\2022 1학기\졸업작품\최종\홈페이지 화면\최근본목록.PNG)



* 어드민 페이지

![image-20220527201524242](C:\Users\dell\AppData\Roaming\Typora\typora-user-images\image-20220527201524242.png)



# 팀원

김현

github : https://github.com/stelladream1



노길현

github : https://github.com/rgh130



조성진

github : 



조성권 

github : https://github.com/sunggun1





# 링크

크롤링  : https://github.com/hansungingang/capstone_crawling

사이트 주소 : http://demo-257674007.ap-northeast-2.elb.amazonaws.com/