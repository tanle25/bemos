@extends('dashboard')
@section('title')
    Cấu hình nội dung
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('Plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('Plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endsection

@section('content')
    <div id="main" style="max-width: 500px">
        <div class="accordion m-0" id="faq">
            <div class="card mb-2">
                <div class="card-header" id="faqhead1">
                    <a href="#" class="btn btn-header-link" data-toggle="collapse" data-target="#faq1"
                        aria-expanded="true" aria-controls="faq1">Danh mục sản phẩm</a>
                </div>
                <div id="faq1" class="collapse show" aria-labelledby="faqhead1" data-parent="#faq">
                    <div class="card-body">
                        <form action="{{route('content.store')}}" method="post">
                            @csrf
                            <select id="section" class="js-example-basic-multiple" name="category[]" multiple="multiple" style="width: 100%">
                                <option value=""></option>
                                @foreach ($categories as $category )
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary mt-3" type="submit">save</button>
                                <a href="{{route('setting.index')}}" role="button" class="btn btn-danger ml-3 mt-3">Exit</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header" id="faqhead2">
                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq2"
                        aria-expanded="true" aria-controls="faq2">Cấu hình menu</a>
                </div>
                <div id="faq2" class="collapse" aria-labelledby="faqhead2" data-parent="#faq">
                    <div class="card-body">
                        <form action="{{route('menu.store')}}" method="post">
                            @csrf
                            <div class="mb-4">
                                <h5>Danh mục sản phẩm</h5>
                                <select id="meunuCategory" class="menu-category" name="category[]" multiple="multiple" style="width: 100%">
                                    <option value=""></option>
                                    @foreach ($menuCategory as $category )
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <h5>Danh sách trang</h5>
                            <select id="menuPage" class="menu-page" name="page[]" multiple="multiple" style="width: 100%">
                                <option value=""></option>
                                @foreach ($menuPage as $page )
                                    <option value="{{$page->id}}">{{$page->title}}</option>
                                @endforeach
                            </select>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary mt-3" type="submit">save</button>
                                <a href="{{route('setting.index')}}" role="button" class="btn btn-danger ml-3 mt-3">Exit</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{--<div class="card mb-2">
                <div class="card-header" id="faqhead3">
                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq3"
                        aria-expanded="true" aria-controls="faq3">S.S.S</a>
                </div>
                <div id="faq3" class="collapse" aria-labelledby="faqhead3" data-parent="#faq">
                    <div class="card-body">

                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                        3 wolf
                        moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                        eiusmod.
                        Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                        assumenda
                        shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
                        sapiente ea
                        proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw
                        denim
                        aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('Plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('Plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>

$(document).ready(function () {
    var arr = @json($curent_choices);
    $.each(arr,(a,b)=>{
        $('#section > option').each((i,o)=>{
            if(b==$(o).val()){
                $(o).attr('selected','selected');
            }
        })
    })

    var current_category = @json($current_menu_category);
    $.each(current_category,(a,b)=>{
        $('#meunuCategory > option').each((i,o)=>{
            if(b==$(o).val()){
                $(o).attr('selected','selected');
            }
        })
    })

    var current_page = @json($current_menu_page);
    $.each(current_page,(a,b)=>{
        $('#menuPage > option').each((i,o)=>{
            if(b==$(o).val()){
                $(o).attr('selected','selected');
            }
        })
    })

});

$(document).ready(function() {
    var menuCategory = $('.menu-category').select2();
    menuCategory.next().children().children().children().sortable({
	containment: 'parent', stop: function (event, ui) {
		ui.item.parent().children('[title]').each(function () {
			var title = $(this).attr('title');
			var original = $( 'option:contains(' + title + ')', menuCategory ).first();
			original.detach();
			menuCategory.append(original)
		});
		menuCategory.change();
	}
});
});

$(document).ready(function() {
    var selectEl = $('.menu-page').select2();
    selectEl.next().children().children().children().sortable({
	containment: 'parent', stop: function (event, ui) {
		ui.item.parent().children('[title]').each(function () {
			var title = $(this).attr('title');
			var original = $( 'option:contains(' + title + ')', selectEl ).first();
			original.detach();
			selectEl.append(original)
		});
		selectEl.change();
	}
});
});

$(document).ready(function() {
    var selectEl = $('.js-example-basic-multiple').select2();
    selectEl.next().children().children().children().sortable({
	containment: 'parent', stop: function (event, ui) {
		ui.item.parent().children('[title]').each(function () {
			var title = $(this).attr('title');
			var original = $( 'option:contains(' + title + ')', selectEl ).first();
			original.detach();
			selectEl.append(original)
		});
		selectEl.change();
	}
});
});

$(document).ready(function () {

    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    @if (Session::has('success'))

      Toast.fire({
        icon: 'success',
        title: 'Cap nhat thanh cong'
      })

    @endif

});
</script>
@endsection
