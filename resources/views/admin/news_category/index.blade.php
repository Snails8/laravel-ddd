@extends('admin._layouts.app')
@section('title', $title)
@section('content')
  @includeWhen(session('flash_message'), 'admin._partials.flash_message_success')
  {{ Form::open(['route' => ['admin.news_category.index'], 'class' => 'pb-3 border-bottom', 'method' => 'GET']) }}
  <table class="table table-striped table-bordered align-middle">
    <colgroup>
      <col style="width: 12%;">
      <col style="width: 33%;">
      <col style="width: 12%;">
      <col style="width: 33%;">
    </colgroup>
    <tr>
      <th scope="row" class="bg-dark text-white">お知らせカテゴリ名</th>
      <td colspan="3">
        {{ Form::text('keyword', isset($params['keyword']) ?? '', ['class' => 'form-control']) }}
      </td>
    </tr>
  </table>
  <div class="text-center">
    {{ Form::submit('検索', ['class' => 'btn btn-primary px-5']) }}
  </div>
  {{ Form::close() }}


  <div id='search_result' class="operation mt-3 py-3">
    <a class="btn btn-outline-primary" href="{{ route('admin.news_category.create') }}">新規作成</a>
  </div>
  <table class="table table-striped table-bordered table-search-result">
    <thead class="bg-dark text-white">
    <tr>
      <th scope="col" class="id">ID</th>
      <th scope="col">お知らせカテゴリ名</th>
      <th scope="col" class="sort-no">優先順位</th>
      <th scope="col" class="operation">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($newsCategories as $newsCategory)
      <tr>
        <td >{{ $newsCategory->id }}</td>
        <td >{{ $newsCategory->name }}</td>
        <td class="sort-no">{{ $newsCategory->sort_no }}</td>
        <td class="operation">
          <a class="btn btn-outline-success" href="{{ route('admin.news_category.edit', ['news_category' => $newsCategory->id]) }}">編集</a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  <div class="d-flex justify-content-center py-4">
    {{ $newsCategories->appends($params)->fragment('search_result')->links() }}
  </div>
@endsection
