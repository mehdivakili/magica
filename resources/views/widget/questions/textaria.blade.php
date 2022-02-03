<div class="form-group">
    <textarea class="form-control @error($name) is-invalid @enderror" name="{{$name}}" placeholder="{{$ph}}"></textarea>
    @error($name)
    <span class="invalid-feedback"  role="alert">
                                        <strong style="font-size: 13px">{{ $message }}</strong>
                                    </span>
    @enderror
</div>
