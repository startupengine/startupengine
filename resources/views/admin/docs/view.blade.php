
    <div class="card p-0 mb-3 formSection">
        <div class="card-header">
            <h6>{{ $item->path }}</h6>
        </div>
        <div class="card-body pb-3 px-3 pt-0">
            @if($item->content() != null)
                <span class="badge badge-dark">RAW Content:</span>
                <pre v-highlightjs style="border-radius:4px;" class="mt-2"><code class="markdown">{!! $item->content !!}</code></pre>
                <span class="badge badge-dark">HTML Output:</span>
                <pre v-highlightjs style="border-radius:4px;" class="mt-2"><code class="html">{{ $item->markdown($item->content) }}</code></pre>
            @endif

        </div>
    </div>