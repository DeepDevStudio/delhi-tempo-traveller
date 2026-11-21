#!/bin/sh
# Tells Bing, Yandex, Seznam & Naver (IndexNow) about every URL in sitemap.xml.
# Run after uploading changes:  sh indexnow-submit.sh
# The key file f579ef0ad585f0dfe4484b7f3697e883.txt must be live at the site root first.
KEY=f579ef0ad585f0dfe4484b7f3697e883
HOST=www.delhitempotravelleronrent.com
URLS=$(grep -o '<loc>[^<]*</loc>' "$(dirname "$0")/sitemap.xml" | sed 's/<[^>]*>//g' | sed 's/.*/"&"/' | paste -sd, -)
curl -s -o /dev/null -w "IndexNow response: %{http_code} (200/202 = accepted)\n" \
  -X POST https://api.indexnow.org/indexnow \
  -H 'Content-Type: application/json; charset=utf-8' \
  -d "{\"host\":\"$HOST\",\"key\":\"$KEY\",\"keyLocation\":\"https://$HOST/$KEY.txt\",\"urlList\":[$URLS]}"
