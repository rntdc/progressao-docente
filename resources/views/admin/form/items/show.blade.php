@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Itens</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.items.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                Cadastros dos índices das solicitações.
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-sm-7">
                        <i class="fas fa-table me-1"></i>
                        {{ $item->name }}
                    </div>
                    <div class="col-sm-5 d-flex justify-content-sm-end justify-content-center mt-2 mt-sm-0">
                        @if($item->has_subitem)
                            <a class="m-1" href="{{ url(route('admin.subitems.create', $item)) }}"><button class="btn btn-outline-primary"><i class="bi bi-plus"></i> Adicionar SubItem</button></a>
                        @else
                            <a class="m-1" href="{{ url(route('admin.questions.create', ['item' => $item])) }}"><button class="btn btn-outline-primary"><i class="bi bi-plus"></i> Adicionar Questão</button></a>
                        @endif
                        <a class="m-1" href="{{ url(route('admin.items.edit', $item)) }}"><button class="btn btn-outline-secondary"><i class="bi bi-pen"></i> Editar Item</button></a>
                        <a
                            data-url="{{ route('admin.items.destroy', $item) }}"
                            data-message="Deseja deletar o Item {{ $item->name }}?"
                            data-item="{{ $item->id }}"
                            data-back="{{ route('admin.items.index') }}"
                            class="m-1 js-delete"
                        >
                            <button class="btn btn-outline-danger">
                                <i class="bi bi-trash"></i> Deletar Item
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body d-flex justify-content-center align-items-center row">
                <div class="accordion accordion-flush" id="accordion">

                    @if($item->has_subitem)
                        <!-- subitem loop -->
                        @foreach($item->subitems()->get() as $key => $subitem)
                        <div class="accordion-item">
                            <h2 class="accordion-header row">
                                <div class="col-9">
                                    <button class="accordion-button collapsed name-subitems" type="button" data-bs-toggle="collapse" data-bs-target="#subitem-{{ $key }}" aria-expanded="false" aria-controls="subitem-{{ $key }}">
                                        {{ $subitem->name }}
                                    </button>
                                </div>
                                <div class="col-3 buttons-subitems">
                                    <a href="{{ url(route('admin.questions.create', ['item' => $item, 'subitem' => $subitem])) }}"><button class="btn btn-outline-primary"><i class="bi bi-plus"></i></button></a>
                                    <a href="{{ url(route('admin.subitems.edit', ['item' => $item, 'subitem' => $subitem])) }}"><button class="btn btn-outline-secondary"><i class="bi bi-pen"></i></button></a>
                                    <a
                                        data-url="{{ url(route('admin.subitems.destroy', ['item' => $item, 'subitem' => $subitem])) }}"
                                        data-message="Deseja deletar o Subitem e todas as suas Questões?"
                                        data-item="{{ $item->id }}"
                                        data-subitem="{{ $subitem->id }}"
                                        class="js-delete"
                                    >
                                        <button class="btn btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </a>
                                </div>
                            </h2>

                            @if(count($subitem->questions()->get()) == 0)
                            <div id="subitem-{{ $key }}" class="accordion-collapse collapse" data-bs-parent="#accordion">
                                <div class="accordion-body name-questions">Nenhum tópico cadastrado.</div>
                            </div>
                            @endif

                            <div id="subitem-{{ $key }}" class="accordion-collapse collapse" data-bs-parent="#accordion">

                                <!-- question loop -->
                                @foreach($subitem->questions()->get() as $key => $question)
                                <div class="row mt-2">
                                    <div class="col-lg-9 col-md-8 col-sm-7 col-12 accordion-body name-questions">
                                        {{ $question->name }}
                                    </div>
                                    <div class="col-lg-1 col-md-2 col-sm-3 col-4 accordion-body name-questions">
                                        {{ $question->pontuation }}
                                    </div>
                                    <div class="col-sm-2 col-8 buttons-questions">
                                        <a href="{{ url(route('admin.questions.edit', ['item' => $item, 'question' => $question])) }}"><button class="btn btn-outline-secondary"><i class="bi bi-pen"></i></button></a>
                                        <a
                                            data-url="{{ url(route('admin.questions.destroy', ['item' => $item, 'question' => $question])) }}"
                                            data-message="Deseja deletar a Questão?"
                                            data-item="{{ $item->id }}"
                                            data-subitem="{{ $subitem->id }}"
                                            data-question="{{ $question->id }}"
                                            class="js-delete"
                                        >
                                            <button class="btn btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>

                                @if(!$loop->last)
                                <hr>
                                @endif

                                @endforeach
                                <!-- end question loop -->

                            </div>
                        </div>
                        @endforeach
                        <!-- end subitem loop -->
                    @else
                        <!-- question loop -->
                        @foreach($item->questions()->get() as $key => $question)
                        <div class="row mt-2">
                            <div class="col-10 accordion-body name-questions">
                                {{ $question->name }}
                            </div>
                            <div class="col-2 buttons-questions">
                                <a href="{{ url(route('admin.questions.edit', ['item' => $item, 'question' => $question])) }}"><button class="btn btn-outline-secondary"><i class="bi bi-pen"></i></button></a>
                                <a
                                    data-url="{{ url(route('admin.questions.destroy', ['item' => $item, 'question' => $question])) }}"
                                    data-message="Deseja deletar a Questão?"
                                    data-item="{{ $item->id }}"
                                    data-question="{{ $question->id }}"
                                    class="js-delete"
                                >
                                    <button class="btn btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                        @endforeach
                        <!-- end question loop -->
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
