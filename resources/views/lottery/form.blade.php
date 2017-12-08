<form method="POST" action="{{route('lottery.store')}}">
    {{csrf_field()}}
    <label for="name">Lottery name:</label>
    <input name="name" value="{{old('name')}}">
    <label for="tickets">Number of winning tickets:</label>
    <input type="number" value="2" name="tickets">
    <button type="submit">Create lottery</button>
</form>