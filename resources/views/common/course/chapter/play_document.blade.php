@if($document->type->code === 'word')
    <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ asset($document->file_path) }}" class="w-100 aspect-ratio-11" allowfullscreen></iframe>
@elseif($document->type->code === 'excel')
    <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ asset($document->file_path) }}" class="w-100 aspect-ratio-11" allowfullscreen></iframe>
@elseif($document->type->code === 'powerpoint')
    <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ asset($document->file_path) }}" class="w-100 aspect-ratio-11" allowfullscreen></iframe>
@elseif($document->type->code === 'pdf')
    <iframe src="{{ asset($document->file_path) }}" class="w-100 aspect-ratio-11" allowfullscreen></iframe>
</iframe>


@endif
