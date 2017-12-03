<?php $sec = $value->slug; ?>
<?php
if ($page->json !== null) {
    $json = json_decode($page->json);
    $slug = $section->slug;
    if (isset($json->versions->$variationcount->$slug->$key)) {
        $input = $json->versions->$variationcount->$slug->$key;
    } else {
        $input = null;
    }
}
?>
<?php $textareaname = "json[versions][$variationcount][$value->slug][$key]"; ?>
<?php $variablename = "simplemde" . $variationcount . $value->slug . $key; ?>
<div class="form-group" align="left">
    <label for="{{$key}}"><b>{{ucfirst($key)}}</b>
        - {{ucfirst($value->description)}}
    </label>
    <textarea type="{{$value->type}}"
              class="form-control"
              id="{{$textareaname}}"
              aria-describedby="{{$key}}"
              placeholder="{{$value->placeholder}}"
              name="json[versions][{{ $variationcount }}][{{$value->slug}}][{{$key}}]"
              rows="2"
              data-field="{{$key}}"
              data-section="{{$value->slug}}"
              }>
        <?php
        if ($page->json !== null) {
            $json = json_decode($page->json);
            $slug = $value->slug;
            if (isset($json->versions->$variationcount->$slug->$key)) {
                echo $json->versions->$variationcount->$slug->$key;
            }
        }
        ?></textarea>

    <script>
        var simplemde{{$variablename}} = new SimpleMDE({
            element: document.getElementById("<?php echo $textareaname; ?>")
            , placeholder: '{!! ($input) !!}'
        });
        simplemde{{$variablename}}.value('{{$input}}');
    </script>
</div>