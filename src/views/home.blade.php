<form method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="text" name="id" placeholder="id"/>
    <input type="text" name="parent" placeholder="parent"/>
    <input type="text" name="tree" placeholder="tree"/>
    <input type="submit" name="submit"/>
</form>