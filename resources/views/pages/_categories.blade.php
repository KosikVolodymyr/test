<div class="col-md-4" data-sticky_column>
    <div class="primary-sidebar">

        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center"><a href="{{route('category.index')}}" style="color: #000;">Categories</a></h3>
            <ul>
                @foreach($categoriesList as $category)
                <li>
                    <a class="cat-space" href="{{route('category.show', $category->slug)}}">{{$category->name}}</a>
                    <span class="post-count pull-right"> ({{$category->posts()->count()}})</span>
                </li>
                @endforeach
            </ul>
        </aside>

    </div>
</div>