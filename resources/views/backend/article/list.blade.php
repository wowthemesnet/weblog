@extends('backend.app')

@section('content')
<div class="card">
    <div class="card-header text-lg">Article List
        <span class=" float-right text-sm ml-2">(Showing:
            {{ $articles->firstItem() }}-{{ $articles->lastItem() }}/{{ $articles->total() }})
        </span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive mailbox-messages">
            @if(count($articles))
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Lead</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                        <td class="mailbox-name">
                            <a href="{{ route('weblog.show', [$article->slug]) }}">
                                {{ $article->title }}
                            </a>
                            <span
                                class="text-xm badge @if($article->is_published) badge-success @else badge-warning @endif">{{ $article->status }}</span>
                        </td>
                        <td class="mailbox-date">{{ $article->lastupdate }}</td>
                        <td class="mailbox-subject">{{ $article->lead }}</td>
                        <td class="mailbox-star">
                            <div class="btn-group float-right" role="group">
                                <a href="{{ Route('article.edit', $article->slug) }}" type="button" class="btn btn-warning"><i class="fas fa-edit"></i></a>

                                <a class="btn btn-danger"
                                    href="#" onclick="event.preventDefault();
                         document.getElementById({{ $article->id }}).submit();"><i class="fas fa-trash"></i></a>

                                <form id="{{ $article->id }}" action="#"
                                    method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No Messages</p>
            @endif
        </div>
    </div>

    <div class="p-3">
        {{ $articles->links('pagination.bootstrap-4') }}
    </div>
</div>
@endsection
