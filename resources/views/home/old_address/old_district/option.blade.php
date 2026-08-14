<option value=""></option>
@foreach($oldDistricts as $district)
    <option value="{{ $district->id }}">{{ renderCodeName($district) }}</option>
@endforeach
