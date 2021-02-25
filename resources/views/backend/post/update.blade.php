@extends('layout')
@section('content')
        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{url('admin/dashboard')}}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>


          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i> Actualizar Categoria
              <a href="{{url('admin/post')}}" class="float-right btn btn-sm btn-dark">Ver Todas</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                @if(Session::has('success'))
                <p class="text-success">{{session('success')}}</p>
                @endif

                <form method="post" action="{{url('admin/post/'.$data->id)}}" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  <table class="table table-bordered">
                      <tr>
                          <th>Categoria <span class="text-danger">*</span></th>
                          <td>
                            <select class="form-control" name="category">
                            <option>--Seleccione--</option>
                                @foreach($cats as $cat)
                                    @if($cat->id==$data->cat_id)
                                        <option selected value="{{$cat->id}}">{{$cat->title}}</option>
                                    @else
                                        <option value="{{$cat->id}}">{{$cat->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                          </td>
                      </tr>
                      <tr>
                          <th>Titulo <span class="text-danger">*</span></th>
                          <td><input type="text" value="{{$data->title}}" name="title" class="form-control" /></td>
                      </tr>
                      <tr>
                          <th>Thumbnail</th>
                          <td>
                            <p class="my-2"><img width="80" src="{{asset('imgs/thumbs')}}/{{$data->thumb}}" alt=""></p>
                            <input type="hidden" value="{{$data->thumb}}"  name="post_thumb" />
                            <input type="file" name="post_thumb">
                          </td>
                      </tr>
                      <tr>
                          <th>Imagem total</th>
                          <td>
                          <p class="my-2"><img width="80" src="{{asset('imgs/full')}}/{{$data->full_img}}" alt=""></p>
                            <input type="hidden" value="{{$data->full_img}}"  name="post_image" />
                            <input type="file" name="post_image" />
                          </td>
                      </tr>
                      <tr>
                          <th>Detalhe <span class="text-danger">*</span></th>
                          <td>
                            <textarea class="form-control" name="detail">{{$data->detail}}</textarea>
                          </td>
                      </tr>
                      <tr>
                          <th>Tags</th>
                          <td>
                            <textarea class="form-control" name="tags">{{$data->tags}}</textarea>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">
                              <input type="submit" class="btn btn-primary" />
                          </td>
                      </tr>
                  </table>
                </form>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
@endsection
