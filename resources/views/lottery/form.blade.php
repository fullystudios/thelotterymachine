<form method="POST" action="{{route('lottery.store')}}">
    {{csrf_field()}}
    <div class="form-group">
        <label for="name">Lottery name:</label>
        <input class="form-control" name="name" value="{{old('name')}}">
    </div>
    <div class="form-group">
        <label for="tickets">Number of winning tickets:</label>
        <input class="form-control" type="number" value="2" name="tickets">
    </div>
    <button type="submit" class="btn btn-primary">Create lottery</button>
</form>