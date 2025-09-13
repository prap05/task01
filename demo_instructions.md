# Demo instructions (30-60s video)

1. Start DVWA (Low security) and show login page.
2. Intercept login POST with Burp and send payload `' OR '1'='1' -- -` to bypass login. Show successful login.
3. Show comment XSS: post `<script>alert(1)</script>`, load page and show alert.
4. Apply fixes (copy `fixes/sql_fix.php` and `fixes/xss_fix.php` into app or demonstrate with a local PHP server running these files).
5. Re-attempt the SQLi and XSS payloads — show they no longer work.
6. End with browser devtools showing session cookies with `HttpOnly` and `SameSite` flags.

Record the video at 720p, 30s–60s, and save as `demo.mp4`.
