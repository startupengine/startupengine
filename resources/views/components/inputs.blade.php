<div class="input-group my-2" v-if="{{ $options['fieldName'] }}.type == 'select'">
    <select id="contentEditor" class="form-control"
            style="text-transform:capitalize !important;"
            v-on:input="changed()"
            v-on:change="changed()"
            v-model="{{ $options['v-model'] }}">
        <option disabled selected="selected" value="null">Select an option...
        </option>
        <option v-if="{{ $options['fieldName'] }}.options != null"
                v-for="option,optionKey in {{ $options['fieldName'] }}.options">
            @{{ option }}
        </option>
    </select>
</div>
<div class="input-group" v-else="{{ $options['fieldName'] }}.type == 'text'">
    <input class="form-control my-2" v-model="{{ $options['v-model'] }}" v-on:input="changed()">
</div>