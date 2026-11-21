# Delhi Tempo Traveller on Rent

Website: https://www.delhitempotravelleronrent.com

Plain PHP site (no database, no build step).

## Run locally

```
php -S localhost:8001
```

Open http://localhost:8001

## Deploy

Copy all files to the web root of a PHP 8+ server (Apache or Nginx + PHP-FPM).

## Blogs

- List of posts: `blog-data.php`
- Each post: `<slug>.php` (uses `blog-post-start.php` / `blog-post-end.php`)
- Sitemap: `sitemap.xml`
