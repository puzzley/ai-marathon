#!/usr/bin/env bash
# Local setup for the AI Marathon challenge pack.
# On Windows, run this from Git Bash or WSL.
# This script does not use sudo, does not install system packages,
# and does not change global PHP or Node configuration.

set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$ROOT"

echo "==> Checking required commands"

missing_cmds=0
for cmd in php composer node npm git; do
  if command -v "$cmd" >/dev/null 2>&1; then
    echo "  found: ${cmd}"
  else
    echo "  missing: ${cmd}"
    missing_cmds=1
  fi
done

if [[ "$missing_cmds" -ne 0 ]]; then
  echo "Error: install the missing commands and run ./setup.sh again."
  echo "This script does not install system packages."
  exit 1
fi

echo "==> Versions"
php_version="$(php -r 'echo PHP_VERSION;')"
composer_version="$(composer --version --no-ansi)"
node_version="$(node -v)"
npm_version="$(npm -v)"
git_version="$(git --version)"
echo "  php:      ${php_version}"
echo "  composer: ${composer_version%%$'\n'*}"
echo "  node:     ${node_version}"
echo "  npm:      ${npm_version}"
echo "  git:      ${git_version}"

echo "==> Checking PHP extensions"

missing_exts=""
for ext in curl json mbstring openssl; do
  if EXT="$ext" php -r 'exit(extension_loaded(getenv("EXT")) ? 0 : 1);'; then
    echo "  ${ext}: ok"
  else
    echo "  ${ext}: missing"
    missing_exts="${missing_exts} ${ext}"
  fi
done

if [[ -n "$missing_exts" ]]; then
  echo "Error: missing PHP extensions:${missing_exts}"
  echo "Install them with your OS package manager, then run ./setup.sh again."
  echo "This script does not install system packages or edit php.ini."
  exit 1
fi

echo "==> PHP dependencies"
if [[ -f composer.json ]]; then
  composer install --no-interaction
else
  echo "  No composer.json; skipping composer install."
fi

echo "==> Node dependencies"
if [[ -f package.json ]]; then
  npm install
else
  echo "  No package.json; skipping npm install."
fi

echo "==> Environment file"
if [[ -f .env ]]; then
  echo "  .env already exists; left it unchanged."
elif [[ -f .env.example ]]; then
  cp .env.example .env
  chmod 600 .env
  echo "  Created .env from .env.example."
  echo "  Edit .env and set OPENROUTER_API_KEY and AI_MODEL."
else
  echo "Error: .env.example is missing, so .env was not created."
  exit 1
fi

cat <<'EOF'

Setup finished.

Next:
  1. Edit .env and set OPENROUTER_API_KEY and AI_MODEL.
     Do not commit .env.
  2. Check the environment:
       ./health-check.php
     or:
       make health
  3. Pick a challenge from the map in README.md.
EOF
