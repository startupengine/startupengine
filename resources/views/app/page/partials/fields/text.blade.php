<div class="form-group" align="left">
    <label for="{{$key}}"><b>{{ucfirst($key)}}</b>
        - {{ucfirst($value->description)}}
    </label>
    <input type="{{$value->type}}"
           class="form-control"
           id="{{$key}}"
           aria-describedby="{{$key}}"
           placeholder="{{$value->placeholder}}"
           name="json[versions][{{ $variationcount }}][{{$value->slug}}][{{$key}}]"
           rows="2"
           data-field="{{$key}}"
           data-section="{{$value->slug}}"
           <?php
           if ($page->json !== null) {
               $json = json_decode($page->json);
               $slug = $section->slug;
               if (isset($json->versions->$variationcount->$slug->$key)) {
                   echo 'value="' . $json->versions->$variationcount->$slug->$key . '"';
               }
           }
           ?>
           }
    />
</div>