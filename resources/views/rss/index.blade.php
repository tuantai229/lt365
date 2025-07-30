{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:slash="http://purl.org/rss/1.0/modules/slash/">
    <channel>
        <title>{{ config('app.name') }} - Tin tức mới nhất</title>
        <atom:link href="{{ route('rss') }}" rel="self" type="application/rss+xml" />
        <link>{{ url('/') }}</link>
        <description>Cập nhật tin tức, tư vấn tuyển sinh, kinh nghiệm học tập mới nhất từ {{ config('app.name') }}.</description>
        <lastBuildDate>{{ $news->first()->created_at->toRfc7231String() }}</lastBuildDate>
        <language>vi-VN</language>
        <sy:updatePeriod>hourly</sy:updatePeriod>
        <sy:updateFrequency>1</sy:updateFrequency>
        <generator>{{ config('app.name') }}</generator>

        @foreach($news as $post)
            <item>
                <title>{{ $post->name }}</title>
                <link>{{ route('news.show', ['slug' => $post->slug, 'id' => $post->id]) }}</link>
                <pubDate>{{ $post->created_at->toRfc7231String() }}</pubDate>
                <dc:creator><![CDATA[{{ $post->adminUser->name ?? 'Admin' }}]]></dc:creator>
                <guid isPermaLink="false">{{ route('news.show', ['slug' => $post->slug, 'id' => $post->id]) }}</guid>
                <description><![CDATA[{!! Str::limit(strip_tags($post->content), 200) !!}]]></description>
                <content:encoded><![CDATA[{!! $post->content !!}]]></content:encoded>
                @if($post->featured_image_url)
                <enclosure url="{{ $post->featured_image_url }}" length="0" type="image/jpeg" />
                @endif
            </item>
        @endforeach
    </channel>
</rss>
