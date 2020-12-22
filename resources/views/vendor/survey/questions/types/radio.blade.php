@component('survey::questions.base', compact('question'))
    @foreach($question->options as $option)
        <div class="custom-control custom-radio">
            <input type="radio"
                   name="{{ $question->key }}"
                   id="{{ $question->key . '-' . Str::slug($option['fr']) }}"
                   value="{{ $option['fr'] }}"
                   class="custom-control-input"
                    {{ ($value ?? old($question->key)) == $option['fr'] ? 'checked' : '' }}
                    {{ ($disabled ?? false) ? 'disabled' : '' }}
            >
            <label class="custom-control-label"
                   for="{{ $question->key . '-' . Str::slug($option['fr']) }}">{{ $option['fr'] }}
                @if($includeResults ?? false)
                    <span class="text-success">
                        ({{ number_format((new \MattDaneshvar\Survey\Utilities\Summary($option['fr']))->similarAnswersRatio($option['fr']) * 100, 2) }}%)
                    </span>
                @endif
            </label>
        </div>
    @endforeach
@endcomponent
