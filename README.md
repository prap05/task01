# Web Application Vulnerability Assessment — News Headlines

## Overview

This repo contains a full deliverable pack for the "Web Application Vulnerability Assessment for News Headlines" task. It includes an assessment report, payloads used during testing, example code fixes (PHP), and instructions to reproduce and verify results.

**Tester:** <Pranav-Pandit>
**Date:** <2025-09-13>
**Target used for testing:** DVWA (or OWASP Juice Shop) running on local VM

## Contents

- `report.md` — full assessment report with findings and remediation steps.
- `payloads.txt` — list of payloads used during testing.
- `fixes/` — example patched PHP snippets for SQLi, XSS, session hardening, and CSRF.
- `screenshots/` — place screenshots of exploits and post-fix verification here.
- `demo_instructions.md` — step-by-step to record a 30–60s demo video showing exploit -> fix -> re-test.

## How to use

1. Clone this repo.
2. Start DVWA or Juice Shop in your lab environment (ensure you have permission to test).
3. Follow steps in `report.md` to reproduce each vulnerability and capture screenshots.
4. Apply fixes in `fixes/` to your app where applicable and re-test.
5. Upload screenshots to `screenshots/` and push the repo to your GitHub.

## Git push example

```bash
git init
git add .
git commit -m "Initial vuln-assessment deliverables"
git branch -M main
git remote add origin https://github.com/<your-username>/news-vuln-assessment.git
git push -u origin main
```

**Note:** Do not run these tests on systems you do not own or do not have explicit permission to test.
