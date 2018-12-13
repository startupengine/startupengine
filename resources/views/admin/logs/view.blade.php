
    <div class="card p-0 mb-3 formSection">
        <div class="card-header">
            <h6>Content</h6>
        </div>
        <div class="card-body pb-3 px-3 pt-0">
            @if(count($item->occurrences()) > 1 )
                <span class="badge badge-dark">Occurrences in last 30 Days</span>
                <pre v-highlightjs style="border-radius:4px;" class="mt-2"><code class="json">{!! count($item->occurrences()) !!}</code></pre>
            @endif

            @if($item->type == 'query')

                @if(isset($item->content()->connection))
                <span class="badge badge-dark">Connection</span>
                <pre v-highlightjs style="border-radius:4px;" class="mt-2"><code class="json">{!! $item->content()->connection !!}</code></pre>
                @endif

                @if(isset($item->content()->bindings))
                    <span class="badge badge-dark">Bindings</span>
                    <pre v-highlightjs style="border-radius:4px;" class="mt-2"><code class="json">{!! json_encode($item->content()->bindings) !!}</code></pre>
                @endif

                @if(isset($item->content()->sql))
                    <span class="badge badge-dark">SQL</span>
                    <pre v-highlightjs style="border-radius:4px;" class="mt-2"><code class="sql">{!! $item->content()->sql !!}</code></pre>
                @endif

                @if(isset($item->content()->time))
                    <span class="badge badge-dark">Time</span>
                    <pre v-highlightjs style="border-radius:4px;" class="mt-2"><code class="json">{!! $item->content()->time !!}</code></pre>
                @endif

                @if(isset($item->content()->slow))
                    <span class="badge badge-dark">Slow</span>
                    <pre v-highlightjs style="border-radius:4px;" class="mt-2"><code class="json">{{ json_encode($item->content()->slow) }}</code></pre>
                @endif

                @if(isset($item->content()->file))
                    <span class="badge badge-dark">File</span>
                    <pre v-highlightjs style="border-radius:4px;" class="mt-2"><code class="json">{!! $item->content()->file !!}</code></pre>
                @endif

                @if(isset($item->content()->line))
                    <span class="badge badge-dark">Line</span>
                    <pre v-highlightjs style="border-radius:4px;" class="mt-2"><code class="json">{!! $item->content()->line !!}</code></pre>
                @endif

                @if(isset($item->content()->hostname))
                    <span class="badge badge-dark">Hostname</span>
                    <pre v-highlightjs style="border-radius:4px;" class="mt-2"><code class="json">{!! $item->content()->hostname !!}</code></pre>
                @endif
            @endif


            @if($item->type == 'exception')
                @if(isset($item->content()->class))
                    <span class="badge badge-dark">Class</span>
                    <pre v-highlightjs style="border-radius:4px;" class="mt-2"><code class="json">{!! $item->content()->class !!}</code></pre>
                @endif

                @if(isset($item->content()->file))
                    <span class="badge badge-dark">File</span>
                    <pre v-highlightjs style="border-radius:4px;" class="mt-2"><code class="json">{!! $item->content()->file !!}</code></pre>
                @endif

                @if(isset($item->content()->line))
                    <span class="badge badge-dark">Line</span>
                    <pre v-highlightjs style="border-radius:4px;" class="mt-2"><code class="json">{!! $item->content()->line !!}</code></pre>
                @endif

                @if(isset($item->content()->message))
                    <span class="badge badge-dark">Message</span>
                    <pre v-highlightjs style="border-radius:4px;" class="mt-2"><code>{!! $item->content()->message !!}</code></pre>
                @endif

                @if(isset($item->content()->trace) && 1 == 2)
                    <span class="badge badge-dark">Trace</span>
                    <pre v-highlightjs style="border-radius:4px;" class="mt-2"><code class="json">{!! json_encode($item->content()->trace, JSON_PRETTY_PRINT) !!}</code></pre>
                @endif
            @endif

            @if($item->content() != null && 1 == 2)
                <span class="badge badge-dark">Raw output:</span>
                <pre v-highlightjs style="border-radius:4px;" class="mt-2"><code class="json">{!! json_encode($item->content(), JSON_PRETTY_PRINT) !!}</code></pre>
            @endif

        </div>
    </div>