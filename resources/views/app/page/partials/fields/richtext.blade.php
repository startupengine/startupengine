<?php $sec = $value->slug; ?>
<?php
if ($page->json !== null) {
    $json = json_decode($page->json);
    $slug = $section->slug;
    if (isset($json->versions->$variationcount->$key->$field)) {
        $input = $json->versions->$variationcount->$key->$field;
    } else {
        $input = null;
    }
} else {
    $input = null;
}

?>
<?php $textareaname = "json[versions][$variationcount][$key][$field]"; ?>
<?php $variablename = "simplemde" . $variationcount . $key . $field; ?>
<div class="form-group" align="left">
    <label for="{{$key}}"><b>{{ucfirst($field)}}</b>
        - {{ucfirst($value->description)}}
    </label>
    <textarea type="{{$value->type}}"
              class="form-control"
              id="{{$textareaname}}"
              aria-describedby="{{$field}}"
              placeholder="{{$value->placeholder}}"
              name="{{$textareaname}}"
              rows="2"
              data-field="{{$field}}"
              data-section="{{$key}}"
              }>@if($input !== null){{ $input }}@endif</textarea>
    <script>
        var {{$variablename}} = new SimpleMDE({
            element: document.getElementById("<?php echo $textareaname; ?>")
        });
    </script>
</div>