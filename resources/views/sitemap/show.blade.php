<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($items as $item)
        <url>
            <loc>
                @switch($type)
                    @case('documents')
                        {{ route('documents.show', ['slug' => $item->slug, 'id' => $item->id]) }}
                        @break
                    @case('schools')
                        {{ route('schools.show', ['slug' => $item->slug, 'id' => $item->id]) }}
                        @break
                    @case('centers')
                        {{ route('centers.show', ['slug' => $item->slug, 'id' => $item->id]) }}
                        @break
                    @case('teachers')
                        {{ route('teachers.show', ['slug' => $item->slug, 'id' => $item->id]) }}
                        @break
                    @case('news')
                        {{ route('news.show', ['slug' => $item->slug, 'id' => $item->id]) }}
                        @break
                    @case('pages')
                        {{ route('page.show', ['page' => $item->slug]) }}
                        @break
                @endswitch
            </loc>
            <lastmod>{{ $item->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>
