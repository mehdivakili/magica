<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($links as $link)
        <url>
            <loc>{{url($link['url'])}}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($link['updated_at'])) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>
