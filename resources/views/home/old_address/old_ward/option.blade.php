<option value=""></option>
@foreach($oldWards as $ward)
    <option value="{{ $ward->id }}">{{ renderCodeName($ward) }}</option>
@endforeach
