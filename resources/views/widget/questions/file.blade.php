@php $id =rand()@endphp

<div class="custom-file ">
    <input type="file" class="custom-file-input @error($name) is-invalid @enderror" id="{{$id}}" name="{{$name}}"z>
    <label class="custom-file-label @error($name) is-invalid @enderror" for="{{$id}}">{{$ph}}</label>

    @error($name)
    <span class="invalid-feedback"  role="alert">
                                        <strong style="font-size: 13px">{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<script>
    $('#{{$id}}').on('change',function(){
        //get the file name
        var fileName = $(this).val().split('\\').pop();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })
</script>
