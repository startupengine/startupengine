<div class="form-group" align="left">
    <label for="{{$field}}"><b>{{ucfirst($field)}}</b>
        - {{ucfirst($value->description)}}
    </label>
    <textarea type="{{$value->type}}"
              class="form-control"
              id="{{$field}}"
              aria-describedby="{{$field}}"
              placeholder="{{$value->placeholder}}"
              name="json[versions][{{ $variationcount }}][{{$key}}][{{$value->slug}}]"
              rows="2"
              data-field="{{$field}}"
              data-section="{{$key}}"
              }><?php
        if ($page->json !== null) {
            $slug = $value->slug;
            if (isset($page->json()->versions->$variationcount->$key->$slug)) {
                echo '' . $page->json()->versions->$variationcount->$key->$slug. '';
            }
        }
        ?></textarea>
</div>