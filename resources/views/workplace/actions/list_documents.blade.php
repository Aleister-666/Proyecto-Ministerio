@extends('layout/workplace_layout')

@section('extra_css')
  <link rel="stylesheet" href="{{asset('css/workplace/list_documents.css')}}">
@endsection

@section('active-2')
	active
@endsection

@section('title')
	Documentos
@endsection

@section('main_content')
	
  @if ($message = Session::get('success'))
    <div class="alert alert-success">
      {{$message}}
    </div>
  @endif

  <div class="cards-documents">
    
    @foreach ($user->documents as $document)

      <div class="card-document">
        <div class="card-document-title">
          <small>{{$document->title}}</small>
        </div>

        <div class="card-document-body">
          <div class="card-body-image" title="{{$document->description}}">

            @switch($document->extension())
                @case('pdf')
                  <img src="{{asset('images/workplace/svg/pdf.svg')}}" alt="PDF">
                  @break

                @case('docx')            
                  <img src="{{asset('images/workplace/svg/word.svg')}}" alt="WORD">
                  @break

                @case('pptx')
                  <img src="{{asset('images/workplace/svg/powerpoint.svg')}}" alt="POWERPOINT">
                  @break

                @case('xlsx')
                  <img src="{{asset('images/workplace/svg/excel.svg')}}" alt="EXCEL">
                  @break

                @default
                  <img src="{{asset('images/workplace/svg/text.svg')}}" alt="TEXTO">

            @endswitch

          </div>

          <div class="card-body-menu">
            <button class="card-menu-option">
              <img src="{{asset('images/workplace/svg/btn-menu_dots_h.svg')}}" alt="">
            </button>

            <a href="{{route('download_document_path', $document->id)}}" class="card-menu-option">Descargar</a>

            <a href="{{route('edit_document_path', $document->id)}}" class="card-menu-option">Editar</a>

            <form class="card-menu-option" action="{{route('destroy_document_path', $document->id)}}" method="POST">
              @method('DELETE')
              @csrf

              <button type="submit">Eliminar</button>
            </form>

          </div>
        </div>
      </div>

    @endforeach
    
  </div>

{{-- 
	<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

    @foreach ($user->documents as $document)
      
      <div class="col">
        <div class="card shadow-sm">
          <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>{{$document->title}}</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{$document->title}}</text></svg>          
        </div>
        <div class="card-body">
          <p class="card-text text-break">{{$document->description}}</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group gap-2">
              <a href="{{route('download_document_path', $document->id)}}" class="btn btn-sm btn-outline-primary">Descargar</a>
              <a href="#" class="btn btn-sm btn-outline-secondary">Editar</a>
              <form action="{{route('destroy_document_path', $document->id)}}" method="POST">
                @method('DELETE')
                @csrf
                
                <button type="submit" ,="" class="btn btn-sm btn-outline-danger">Eliminar</button>
              </form>

            </div>
            <small class="text-muted">{{$document->updated_at}}</small>
          </div>
        </div>
      </div>

    @endforeach

  </div> --}}


  <script>
    d = document;

    // d.addEventListener('DOMContentLoaded', () => {
    //   $btn = d.getElementById('menu-documents');
    //   $btn.addEventListener('click', e => {
    //     if (e.target.matches('button#menu-documents, button#menu-documents *')){
    //       console.log("presionado");
    //     }
    //   })
    // });
    
    d.addEventListener('DOMContentLoaded', () => {

      d.addEventListener('click', e => { 

        if (e.target.matches('button.card-menu-option')){
          e.target.parentNode.classList.toggle('active');
          
        } else if (e.target.matches('button.card-menu-option *')) {
          e.target.parentNode.parentNode.classList.toggle('active');

        } else if (e.target.matches('a.card-menu-option')) {
          e.target.parentNode.classList.toggle('active');

        } else if (e.target.matches('.card-body-image *')) {
          e.target.parentNode.nextElementSibling.classList.toggle('active');

        }

      })
    });
  </script>
@endsection