<form method="POST" action="{{route('lottery.store')}}">
    {{csrf_field()}}
    <label for="name">Lottery name:</label>
    <input name="name" value="{{old('name')}}">
    <button type="submit">Create lottery</button>
</form>