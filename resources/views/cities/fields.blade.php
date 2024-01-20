<!-- Country Name Field -->
@php
    $country=[""=>"Select Country"]+\App\Models\Country::orderBy('name')->pluck('name',"name")->toarray();
@endphp
<div class="form-group col-sm-6">
    {!! Form::label('country_name', 'Country Name:') !!}
    {!! Form::select('country_name',$country, null, ['class' => 'form-control']) !!}
</div>

<?php
$news=[""=>"Select Province"];
$scates=[];
if(isset($city))
{
    $scates=\App\Models\Province::where('country_name',$city->country_name)->get();
}
if(old('country_name') )
{
    $scates=\App\Models\Province::where('country_name',old('country_name'))->get();
}
foreach($scates as $min)
{
    $news[$min->name]=$min->name;
}
?>
<div class="form-group col-sm-6">
    {!! Form::label('country_name', 'Province Name:') !!}
    {!! Form::select('province_name',$news, null, ['class' => 'form-control']) !!}
</div>


<!-- City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('cities.index') }}" class="btn btn-default">Cancel</a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $("#country_name").click(function () {
        var country_name = $(this).val();
        var url="{{ url('admin/provincelist') }}";
        $.ajax({
            url: url,
            type: 'POST',
            data: {_token: "{{ csrf_token() }}",country_name:country_name},
            // async: false,
            success: function (data) {
                if (data.status = 1) {
                    if(data.data==""){
                        html = `<option value="">Select Province</option>`;
                        $("select[name=province_name]").html(html);
                    }
                    else {
                        html = `<option value="">Select Province</option>`;
                        console.log(data);
                        $.each(data.data, function (k, v) {
                            html += `<option value="` + k + `">` + v + `</option>`;
                        });
                        $("select[name=province_name]").html(html);
                    }
                } else {
                    alert(data.error);
                }
            }
        })
    });

</script>
