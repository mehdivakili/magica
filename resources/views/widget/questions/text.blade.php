<div class="form-group">
    <input class="form-control  @error($name) is-invalid @enderror" autocomplete="off" value="{{old($name)}}" type="text" name="{{$name}}" placeholder="{{$ph}}">
    @error($name)
    <span class="invalid-feedback" role="alert">
                                        <strong style="font-size: 13px" >{{ $message }}</strong>
                                    </span>
    @enderror
</div>
