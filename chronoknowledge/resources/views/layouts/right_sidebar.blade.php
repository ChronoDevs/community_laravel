<!--Main Navigation-->
    <!-- Sidebar -->
    <nav class="nav bg-transparent sidebar_right d-lg-block collapse">
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-5 bg-transparent py-4">
                <div class="container mt-5 mb-3">
                    <h4 class="text-muted mx-auto my-auto mb-2">Categories</h4>
                    <div class="container overflow me-4">
                        <div class="row">
                            @foreach ($categories->unique('title') as $category)
                                <div class="col-sm-12 my-1">
                                    <a href="{{'?category=' . $category->title }}"
                                        class="categoryItem">{{ $category->title }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="container mt-3 mb-3">
                    <h4 class="text-muted mx-auto my-auto mb-2">Popular Tags</h4>
                    <div class="container overflow me-4">
                        <div class="row">
                            @foreach ($tags->unique('title') as $tag)
                                <div class="col-sm-12 my-1">
                                    <a href="{{'?tag=' . $tag->title }}" class="tagItem">
                                        #{{ $tag->title }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Sidebar -->

