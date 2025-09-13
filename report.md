# Report: Web Application Vulnerability Assessment — News Headlines

**Tester:** <Pranav-Pandit>  
**Date:** <2025-09-13>  
**Target:** DVWA / OWASP Juice Shop (local VM)

---

## 1. Executive Summary

This assessment targeted a sample news headlines web application to identify and remediate common web application vulnerabilities. Testing focused on SQL Injection (SQLi), Cross-Site Scripting (XSS), insecure authentication/session handling, and Cross-Site Request Forgery (CSRF).

**Summary of findings:**

- SQL Injection (High) — login and search endpoints vulnerable on Low security DVWA.
- Cross-Site Scripting (Stored/Reflected) (Medium) — comment and headline input fields vulnerable.
- Session Management weaknesses (Medium) — missing `HttpOnly`, `Secure`, `SameSite` cookie flags; session fixation possible.
- CSRF (Low/Medium) — state-changing endpoints lacked CSRF tokens.

Each finding includes a proof screenshot, payload used, impact, and remediation applied. After applying fixes, retests verified the vulnerabilities were mitigated.

---

## 2. Scope

- Host: `localhost` / `127.0.0.1` running DVWA (or Juice Shop)
- Pages tested: Login page (`/login.php`), Search page (`/vulnerabilities/sqli` or app-specific), Comments/Publish headline pages.

---

## 3. Tools used

- Kali Linux (VM)
- DVWA (or OWASP Juice Shop)
- Burp Suite Community Edition (Proxy, Repeater)
- OWASP ZAP (optional scanning)
- Browser developer tools
- sqlite/mysql CLI (as applicable)

---

## 4. Findings

### Finding 1 — SQL Injection (High)

- **Location:** `/vulnerabilities/sqli` or `/login.php` (POST)
- **Payload used:** `' OR '1'='1' -- -`
- **Proof:** `screenshots/SQLi_Login_Exploit.png` (showing Burp request and successful bypass).
- **Impact:** Authentication bypass and potential data exposure.
- **Remediation applied:** Implemented prepared statements using PDO and hashed password verification (see `fixes/sql_fix.php`).
- **Verification:** `screenshots/SQLi_Fix_Verify.png` (payload no longer bypasses authentication).

---

### Finding 2 — Cross-Site Scripting (Stored) (Medium)

- **Location:** Comments/headline submission
- **Payload used:** `<script>alert(1)</script>`
- **Proof:** `screenshots/XSS_Exploit_Alert.png`
- **Impact:** Stored XSS allows execution of arbitrary JS in victims' browsers (cookie theft, account takeover).
- **Remediation applied:** Implemented output encoding using `htmlspecialchars()` and Content Security Policy header (see `fixes/xss_fix.php`).
- **Verification:** `screenshots/XSS_Fix_Verify.png` (script appears escaped, no execution).

---

### Finding 3 — Session Management (Medium)

- **Location:** Login flow and session cookie settings
- **Proof:** `screenshots/Session_Cookies_Before.png` (missing HttpOnly/Secure flags)
- **Impact:** Increased risk of session theft via XSS or network interception.
- **Remediation applied:** Set cookie flags and regenerate session ID on login (see `fixes/session_hardening.php`).
- **Verification:** `screenshots/Session_Cookies_After.png` (flags present, session id regenerated).

---

### Finding 4 — CSRF (Medium)

- **Location:** State-changing endpoints (e.g., `POST /publish`)
- **Proof:** `screenshots/CSRF_Exploit.png` (auto-submitting HTML page performed an action)
- **Impact:** Attackers could cause users to take actions without their intent.
- **Remediation applied:** Implemented per-session CSRF tokens and validated them server-side (see `fixes/csrf_fix.php`).
- **Verification:** `screenshots/CSRF_Fix.png` (action blocked without valid token).

---

## 5. Recommendations

- Always use parameterized queries / prepared statements.
- Escape all user data when rendering; follow the principle of output encoding.
- Implement strict session cookie attributes: `HttpOnly`, `Secure`, `SameSite`.
- Enforce HTTPS and HSTS.
- Implement CSRF protections for state-changing operations.
- Enable logging and monitoring for suspicious requests.

---

## 6. Appendix

- `payloads.txt` contains all payloads used.
- Screenshots folder contains labeled evidence images.

**GitHub repo:** <your-github-url>
