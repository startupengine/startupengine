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
<?php $textareaname = "json[versions][$variationcount][$field][$value->slug]"; ?>
<?php $variablename = "simplemde" . $variationcount . $field . $value->slug; ?>
<div class="form-group" align="left">
    <label for="{{$key}}"><b>{{ucfirst($field)}}</b>
        - {{ucfirst($value->description)}}
    </label>
    <select
            class="form-control"
            id="{{$textareaname}}"
            aria-describedby="{{$field}}"
            placeholder="{{$value->placeholder}}"
            name="json[versions][{{ $variationcount }}][{{$key}}][{{$value->slug}}]"
            rows="2"
            data-field="{{$field}}"
            data-section="{{$key}}"
    >
        <?php foreach($page->schema()->sections->$key->fields->$field->options as $option) {?>
        <option @if($input == $option) selected @endif value="{{$option}}">{{ucfirst($option)}}</option>
        <?php } ?>
    </select>
</div>