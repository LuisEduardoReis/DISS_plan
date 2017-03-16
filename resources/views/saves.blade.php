@extends('layouts.app')

@section('content')

    <form action="/api/save_create" method="POST">
        {{ csrf_field() }}
        <button type="submit">Save</button>
        <label for="save_name_input">Save name (optional)</label>
        <input id="save_name_input" type="text" name="name">
    </form>


    <table class="table table-striped task-table">
        <tr>
            <th>&nbsp;</th>
            <th>Date</th>
            <th>Name</th>
            <th>Size</th>
        </tr>
    @foreach($saves as $save)
        <tr>
            <td>
                <form action="/api/save_restore" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="save_id" value="{{$save->id}}">
                    <button type="submit">Restore</button>
                </form>
            </td>
            <td class="table-text">{{$save->created_at}}</td>
            <td class="table-text">{{$save->name}}</td>
            <td class="table-text">{{strlen($save->data)}}</td>
        </tr>
    @endforeach
    </table>
@endsection