우분투 16.04 기준으로 작석 되었습니다.

============================================== apm 설치 ==============================================

sudo apt-get update
sudo apt-get upgrade
sudo apt-get install apache2
sudo apt-get upgrade
sudo apt-get install mysql-server
mysql 비밀번호 입력
sudo apt-get install mysql-client
sudo apt-get install php4.6-mysql php5.6-curl php5.6-xml php5.6-zip php5.6-gd php5.6-mbstring php5.6-mcrypt
php libapache2-mod-php php-xml php-gd php-mysql php-curl php-xml php-zip php-mbstring  php-mcrypt







============================================== bbscoin 설치 ==============================================
cd /usr/local/src
mkdir bbscoin
cd bbscoin

wget https://github.com/bbscoin/bbscoin-releases/blob/master/6.0.0/bbscoin_bins_ubuntu_16.04_v6.0.0.tar.gz
tar xvzpf bbscoin_bins_ubuntu_16.04_v6.0.0.tar.gz


./bbscoind

동기화 끝난후

./simplewallet

지갑을 만들어주세요.

./walletd --container-file=./지갑.wallet --container-password=지갑비밀번호 --log-file=/dev/null --local -d




============================================== bbscoin 설치 ==============================================
bbscoin_g5.zip
압축을 푸신후 현재 사용하시느 그누보드5 에 업로드 합니다.

http://사이트주소/bbscoin/install.php (디비 생성)

/bbscoin/bbscoinapi.php 파일을 열으셔서 지갑주소를 자신의 지갑주소로 바꿔 주세요.


http://사이트주소/bbscoin				(회원 충/환전)
http://사이트주소/bbscoin/deposit_list.php		(회원충전리스트)
http://사이트주소/bbscoin/withdraw_list.php		(회원환전리스트)







그누보드5 의 회원 포인트 mb_point 에 충전 환전이 가능하게 만들어 놓았습니다.

