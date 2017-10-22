<?php if($item->image !== NULL) { ?>
    <li class="article" style="float:left; background:#fff;">
        <a href="/article/{{ $item->slug }}">
            <figure>
                <img src="{{ Storage::disk('public')->url($item->image) }}" style="size:100%;"/>
                <figcaption>
                    <h2>{{ $item->title }}</h2>
                    <p>{{  $item->excerpt }}</p>
                </figcaption>
            </figure>
        </a>
    </li>
<?php } ?>