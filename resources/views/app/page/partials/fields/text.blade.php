<?php $sec = $value->slug; ?>
<?php $textareaname = "json[versions][$variationcount][$key][$value->slug]"; ?>
<div class="form-group" align="left">
    <label for="{{$field}}"><b>{{ucfirst($field)}}</b>
        - {{ucfirst($value->description)}}
    </label>
    <input type="{{$value->type}}"
           class="form-control"
           id="{{$field}}"
           aria-describedby="{{$field}}"
           placeholder="{{$value->placeholder}}"
           name="{{$textareaname}}"
           rows="2"
           data-field="{{$field}}"
           data-section="{{$value->slug}}"
           <?php
           if ($page->json !== null) {
               $slug = $value->slug;
               if (isset($page->json()->versions->$variationcount->$key->$sec)) {
                   echo 'value="' . $page->json()->versions->$variationcount->$key->$sec. '"';
               }
           }
           ?>
           }
    />
</div>