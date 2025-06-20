async function getUserIP() {
    try {
        const response = await fetch('https://api.ipify.org?format=json', { timeout: 5000 });
        const data = await response.json();
        return data.ip;
    } catch (err) {
        console.warn('Failed to fetch IP, proceeding without it:', err);
        return 'غير متاح';
    }
}

function getDeviceInfo() {
    const userAgent = navigator.userAgent;
    const platform = navigator.platform;
    const screenWidth = screen.width;
    const screenHeight = screen.height;
    const deviceType = /mobile/i.test(userAgent) ? 'Mobile' : 'Computer';
    return { userAgent, platform, screenWidth, screenHeight, deviceType };
}