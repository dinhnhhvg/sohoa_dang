<tr>
    <td>
        <input type="hidden" name="course_type_id[]" value="{{ $courseType->id }}">
        <input type="hidden" name="price[]" value="{{ $courseType->price }}">
        <input type="hidden" name="quantity[]" value="1">
        {{ $courseType->course->name }}
    </td>
    <td>{{ __('app.'.$courseType->type->name) }}</td>
    <td class="text-center">{{ numberFormat($courseType->price) }}</td>
    <td class="text-center">{{ $courseType->lesson_count }}</td>
    <td>
        <textarea class="form-control" rows="1" name="item_content[]" placeholder="{{ __('app.enter_content') }}"></textarea>
    </td>
    <td class="text-center">
        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
           onclick="deleteCourseType(this)">
            <i class="fa-solid fa-trash-can"></i>
        </a>
    </td>
</tr>
