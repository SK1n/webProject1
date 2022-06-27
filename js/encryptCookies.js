function encryptCookies(pwd) {
    return crypto.AES.encrypt(pwd);
}