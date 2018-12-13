<div class="form-group" align="left">
    <label for="{{$field}}"><b>{{ucfirst($field)}}</b>
        - {{ucfirst($value->description)}}
    </label>
    <div class="tag-select">
        <!-- Vue component -->
        <multiselect v-model="value" tag-placeholder="Add this as new tag"
                     placeholder="Search or add a tag" label="name" track-by="code"
                     :options="options" :multiple="true" :taggable="true" @tag="addTag"></multiselect>
        <textarea id="json[versions][{{ $variationcount }}][{{$key}}][{{$value->slug}}]" name="json[versions][{{ $variationcount }}][{{$key}}][{{$value->slug}}]" data-field="{{$field}}"
                  data-section="{{$key}}" style="display:none;"/>@{{ value  }}</textarea>
    </div>

    <script>
        new Vue({
            components: {
                Multiselect: window.VueMultiselect.default
            },
            data: {
                value: [
                        @if($page->tagNames() !== null)
                        <?php $total = count($page->tagNames()); ?>
                        <?php $tagcount = 1;?>

                        @foreach($page->tagNames() as $tag)
                    { name: '{{$tag}}' }@if($tagcount >= $total = 1) , @endif
                    <?php $tagcount = $tagcount + 1;?>
                    @endforeach

                    @endif
                ],
                options: [
                ]
            },
            methods: {
                addTag (newTag) {
                    const tag = {
                        name: newTag,
                        code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
                    }
                    this.options.push(tag)
                    this.value.push(tag)
                }
            }
        }).$mount('#<?php echo "json[versions][$variationcount][$key][$value->slug]"; ?>')
    </script>
</div>