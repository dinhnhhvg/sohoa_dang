<option value=""></option>
@foreach($wards as $ward)
    <option value="{{ $ward->id }}">{{ renderCodeName($ward) }}</option>
@endforeach
