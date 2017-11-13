<div class="col-sm-2 float-left col-1 pl-0 pr-0 collapse width show" id="sidebar">
    <div class="list-group border-0 card text-center text-md-left">
        <a href="#menu" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
            <i class="fa fa-dashboard"></i> <span class="d-none d-md-inline">Menu</span>
        </a>
        <div class="collapse" id="menu">
            <a href="#" class="list-group-item" data-parent="#menu">List</a>
            <a href="#" class="list-group-item" data-parent="#menu">Order</a>
        </div>

        <a href="#pages" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
            <i class="fa fa-dashboard"></i> <span class="d-none d-md-inline">Pages</span>
        </a>
        <div class="collapse" id="pages">
            <a href="#" class="list-group-item" data-parent="#pages">List</a>
            <a href="#" class="list-group-item" data-parent="#pages">Create</a>
        </div>

        <a href="#categories" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
            <i class="fa fa-book"></i> <span class="d-none d-md-inline">Categories</span>
        </a>
        <div class="collapse" id="categories">
            <a href="#" class="list-group-item" data-parent="#categories">Create</a>
            @isset($categories)
                @foreach($categories as $category)
                    <a href="#categories-sub" class="list-group-item" data-toggle="collapse" aria-expanded="false">
                        {{ $category->translation->first()->title }}
                    </a>
                    <div class="collapse" id="categories-sub">
                        <a href="#" class="list-group-item" data-parent="#categories-sub">List of {{ $category->translation->first()->title }}</a>
                        <a href="#" class="list-group-item" data-parent="#categories-sub">Create new</a>
                    </div>
                @endforeach
            @endisset
        </div>
        <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
            <i class="fa fa-heart"></i> <span class="d-none d-md-inline">Item 4</span>
        </a>
        <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
            <i class="fa fa-list"></i> <span class="d-none d-md-inline">Item 5</span>
        </a>
        <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
            <i class="fa fa-clock-o"></i> <span class="d-none d-md-inline">Link</span>
        </a>
    </div>
</div>