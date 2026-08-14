<option value=""></option>
@foreach($topics as $topic)
    <option value="{{ $topic->id }}">{{ $topic->name }}</option>
@endforeach
