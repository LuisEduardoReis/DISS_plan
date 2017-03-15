<table class="table table-striped task-table">
    <thead>
        <th>&nbsp; </th>
        <th> Topic Name </th>
    </thead>

    <tbody>
        @foreach($topics as $topic)
            <tr>
                <td>
                    <input type="checkbox" class="topic_select" name="topic_select[]" value="{{$topic->id}}">
                </td>

                <td class="table-text">
                    <div>{{ $topic->name }}</div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>