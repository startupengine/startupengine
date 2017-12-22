<?php
if (\Request::is('app/view/*')) {
    $disabled = "disabled";
} else {
    $disabled = "";
}

?>
<?php $variationcount = 1; ?>
<div class="card variation" style="margin-top:25px;<?php if ($disabled == "disabled") {
    echo "background:rgba(0,0,0,0.04);";
} ?>">
    <div class="card-header" style="<?php if ($disabled == "disabled") {
        echo "background:rgba(0,0,0,0.0);";
    } ?>">
        Content
    </div>
    <ul class="nav nav-tabs justify-content-center text-black"
        style="background:#fff;<?php if ($disabled == "disabled") {
            echo "background:rgba(0,0,0,0.0);";
        } ?>border-bottom:1px solid #ddd;padding:10px;"
        role="tablist">
        <?php $count = 1; ?>
        @foreach($postType->json()->sections as $key => $value)
            <li class="nav-item">
                <a class="nav-link <?php if ($count == 1) {
                    echo "active";
                } ?>" data-toggle="tab" href="#{{$key.$variationcount}}"
                   data-section="{{$key}}"
                   role="tab"
                   aria-expanded="false">{{ucfirst($value->title)}}</a>
            </li>
            <?php $count = $count + 1; ?>
        @endforeach
    </ul>
    <div class="card-body">
        <div class="tab-content text-center">
            <?php $count = 1;  ?>
            @foreach($postType->json()->sections as $key => $section)
                <div class="tab-pane <?php if ($count == 1) {
                    echo "active";
                } ?>"
                     id="{{$key.$variationcount}}"
                     role="tabpanel"
                     data-section="{{$key}}">
                    @foreach($section->fields as $key => $value)
                        <div class="form-group" align="left">
                            <label for="{{$key}}"><b>{{ucfirst($key)}}</b>
                                - {{ucfirst($value->description)}}</label>
                            @if($value->type == 'text')
                                <?php $sec = $section->slug; ?>

                                <input {{$disabled}} type="{{$value->type}}" class="form-control"
                                       id="{{$key}}" aria-describedby="{{$key}}"
                                       placeholder="{{$value->placeholder}}"
                                       name="json[versions][{{ $variationcount }}][{{$section->slug}}][{{$key}}]"
                                       rows="2"
                                       data-field="{{$key}}"
                                       data-section="{{$section->slug}}"
                                       <?php
                                       if ($postType->json !== null) {
                                           $json = json_decode($postType->json);
                                           $slug = $section->slug;
                                           if ($post !== null && isset($post->json()->versions->$variationcount->$slug->$key)) {
                                               echo 'value="' . $post->json()->versions->$variationcount->$slug->$key . '"';
                                           }
                                       }
                                       ?>

                                       }

                                />
                            @endif

                            @if($value->type == 'textarea')
                                <?php $sec = $section->slug; ?>
                                <?php if ($post !== null && isset($post->json()->versions->$variationcount->$sec->$key)) {
                                    $input = $post->json()->versions->$variationcount->$sec->$key;
                                } else {
                                    $input = null;
                                } ?>
                                <textarea {{$disabled}} type="{{$value->type}}" class="form-control"
                                          id="{{$key}}" aria-describedby="{{$key}}"
                                          placeholder="{{$value->placeholder}}"
                                          name="json[versions][{{ $variationcount }}][{{$section->slug}}][{{$key}}]"
                                          rows="2"
                                          data-field="{{$key}}"
                                          data-section="{{$section->slug}}"
                                          <?php
                                          if ($postType->json !== null) {
                                              $json = json_decode($postType->json);
                                              $slug = $section->slug;
                                              if ($post !== null && isset($post->json()->versions->$variationcount->$slug->$key)) {
                                                  echo 'value="' . $post->json()->versions->$variationcount->$slug->$key . '"';
                                              }
                                          }
                                          ?>
                                          }
                                >{{ $input }}</textarea>
                            @endif
                            @if($value->type == 'code')
                                <?php $sec = $section->slug; ?>
                                <?php if ($post !== null && isset($post->json()->versions->$variationcount->$sec->$key)) {
                                    $input = $post->json()->versions->$variationcount->$sec->$key;
                                } else {
                                    $input = null;
                                } ?>
                                <?php $textareaname = "json[versions][$variationcount][$section->slug][$key]"; ?>
                                <textarea {{$disabled}} class="form-control"
                                          id="{{$key}}" aria-describedby="{{$key}}"
                                          placeholder="{{$value->placeholder}}"
                                          name="{{$textareaname}}"
                                          rows="3"
                                          data-field="{{$key}}"
                                          data-section="{{$section->slug}}"></textarea>
                                <div id="json[versions][{{ $variationcount }}][{{$section->slug}}][{{$key}}]"
                                     aria-describedby="{{$key}}"
                                     name="json[versions][{{ $variationcount }}][{{$section->slug}}][{{$key}}]"
                                     style="min-height:225px;"></div>
                                <script src="//ajaxorg.github.io/ace-builds/src-min-noconflict/ace.js"
                                        type="text/javascript" charset="utf-8"></script>
                                <script>
                                        <?php $variablename = "editor" . $variationcount . $section->slug . $key; ?>
                                        <?php $textareaname = "json[versions][$variationcount][$section->slug][$key]"; ?>
                                        <?php if (isset($value->mode)) {
                                            $mode = $value->mode;
                                        } else {
                                            $mode = "html";
                                        } ?>
                                    var editor{{$variablename}} = ace.edit("{{$textareaname}}");
                                    var textarea{{$variablename}} = $('textarea[name="{{$textareaname}}"]').hide();
                                    editor{{$variablename}}.setTheme("ace/theme/github");
                                    editor{{$variablename}}.getSession().setMode("ace/mode/{{$mode}}");
                                    editor{{$variablename}}.getSession().setValue(textarea{{$variablename}}.val());
                                    editor{{$variablename}}.getSession().on('change', function () {
                                        textarea{{$variablename}}.val(editor{{$variablename}}.getSession().getValue());
                                    });
                                    editor{{$variablename}}.setValue('{!! $input !!}');
                                </script>

                            @endif
                            @if($value->type == 'richtext')
                                <?php $sec = $section->slug; ?>
                                <?php if ($post !== null && isset($post->json()->versions->$variationcount->$sec->$key)) {
                                    $input = $post->json()->versions->$variationcount->$sec->$key;
                                } else {
                                    $input = null;
                                } ?>
                                <?php $textareaname = "json[versions][$variationcount][$section->slug][$key]"; ?>
                                <?php $variablename = "simplemde" . $variationcount . $section->slug . $key; ?>
                                <textarea {{$disabled}} class="form-control"
                                          id="{{$textareaname}}"
                                          aria-describedby="{{$key}}"
                                          placeholder="{{$value->placeholder}}"
                                          name="json[versions][{{ $variationcount }}][{{$section->slug}}][{{$key}}]"
                                          rows="2"
                                          data-field="{{$key}}"
                                          data-section="{{$section->slug}}"></textarea>
                                <script>
                                    var <?php echo $variablename; ?> = new SimpleMDE({
                                        element: document.getElementById("<?php echo $textareaname; ?>")
                                    });
                                    {{$variablename}}.value('{!! $input !!}');
                                </script>

                            @endif

                            @if($value->type == 'checkbox')
                                <?php $sec = $section->slug; ?>
                                <?php if ($post !== null && isset($post->json()->versions->$variationcount->$sec->$key)) {
                                    $input = $post->json()->versions->$variationcount->$sec->$key;
                                } else {
                                    $input = null;
                                } ?>
                                <?php $textareaname = "json[versions][$variationcount][$section->slug][$key]"; ?>
                                <?php $variablename = "simplemde" . $variationcount . $section->slug . $key; ?>
                                <div class="checkbox">
                                    <input
                                            id="{{$textareaname}}"
                                            type="checkbox"
                                            aria-describedby="{{$key}}"
                                            name="json[versions][{{ $variationcount }}][{{$section->slug}}][{{$key}}]"
                                            data-field="{{$key}}"
                                            data-section="{{$section->slug}}"
                                            @if($input == true) checked="" @endif />
                                    <label for="{{$textareaname}}">
                                        Featured
                                    </label>
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <?php $count = $count + 1; ?>
                </div>
            @endforeach
        </div>
    </div>
</div>