@extends('layouts.admin')
@section('content')
    <h2 class="text-info">Posts: {{ sizeof($posts) }} </h2>
    <div class="row gx-5">
        <div class="col-xxl-4 col-md-4 mb-5">
            <div class="card card-raised bg-primary text-white">
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="me-2">
                            <div class="display-5 text-white">{{ sizeof($posts) }}</div>
                            <div class="card-text">Posts</div>
                        </div>
                        <div class="icon-circle bg-white-50 text-primary"><i class="fa fa-envelope-open-o"
                                aria-hidden="true"></i></div>
                    </div>
                    <div class="card-text">
                        <div class="d-inline-flex align-items-center">
                            <i class="material-icons icon-xs"><i class="fa fa-envelope-open-o" aria-hidden="true"></i></i>
                            <div class="caption fw-500 me-2">3%</div>
                            <div class="caption">from last month</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-md-4 mb-5">
            <div class="card card-raised bg-warning text-white">
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="me-2">
                            <div class="display-5 text-white">{{ $likes->count() }}</div>
                            <div class="card-text">Likes</div>
                        </div>
                        <div class="icon-circle bg-white-50 text-warning"><i class="material-icons">storefront</i></div>
                    </div>
                    <div class="card-text">
                        <div class="d-inline-flex align-items-center">
                            <i class="material-icons icon-xs">arrow_upward</i>
                            <div class="caption fw-500 me-2">3%</div>
                            <div class="caption">from last month</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-md-4 mb-5">
            <div class="card card-raised bg-secondary text-white">
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="me-2">
                            <div class="display-5 text-white">{{ $favorites->count() }}</div>
                            <div class="card-text">Favorites</div>
                        </div>
                        <div class="icon-circle bg-white-50 text-secondary"><i class="material-icons">people</i></div>
                    </div>
                    <div class="card-text">
                        <div class="d-inline-flex align-items-center">
                            <i class="material-icons icon-xs">arrow_upward</i>
                            <div class="caption fw-500 me-2">3%</div>
                            <div class="caption">from last month</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-xxl-3 col-md-6 mb-5">
            <div class="card card-raised bg-info text-white">
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="me-2">
                            <div class="display-5 text-white">7</div>
                            <div class="card-text">Channels</div>
                        </div>
                        <div class="icon-circle bg-white-50 text-info"><i class="material-icons">devices</i></div>
                    </div>
                    <div class="card-text">
                        <div class="d-inline-flex align-items-center">
                            <i class="material-icons icon-xs">arrow_upward</i>
                            <div class="caption fw-500 me-2">3%</div>
                            <div class="caption">from last month</div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <select name="postsTable_length" aria-controls="postsTable" class=""
                    onchange="changeYearlyGraph(this.value)">
                    <option value="">Select Year</option>
                    @foreach ($postsByYear->unique('year') as $post)
                        <option value="{{ $post->year }}">{{ $post->year }}</option>
                    @endforeach
                </select>
                <canvas id="myChart" style="width:100%;max-width: 750px"></canvas>
            </div>
            <div class="col">
                <canvas id="myChart2" style="width:100%;max-width: 750px"></canvas>
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <table id="postsTable" class="table table-dark table-striped display text-info">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Posted By</th>
                    <th>Likes</th>
                    <th>Favorites</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post['title'] }}</td>
                        <td>{{ $post['user']['name'] }}</td>
                        <td>{{ sizeof($post['likes']) }}</td>
                        <td>{{ sizeof($post['favorites']) }}</td>
                        <td><button class="btn btn-primary">{{ $post['status'] == 1 ? 'Active' : 'Inactive' }}</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        // let posts = <?= json_encode($posts) ?>;
        let likesByYear = <?= json_encode($likes) ?>;
        let postsByYear = <?= json_encode($postsByYear) ?>;
        let postPerYearData = [];
        let likePerYearData = [12, 10, 3, 2, 9];
        let favoritePerYearData = [2, 3, 4];
        let title = 'Monitoring of Posts for year 2023';
        let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
            'November', 'December'
        ];
        var barColors = ["palevioletred", "green", "blue", "orange", "brown", "palevioletred", "green", "blue", "orange",
            "brown", "pink", "darkgreen"
        ];
        function renderYearlyPostChart(year) {

            new Chart("myChart", {
                type: "bar",
                data: {
                    labels: months,
                    datasets: [{
                        backgroundColor: barColors,
                        data: postPerYearData
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Monitoring of Posts for the year ' + title
                    }
                }
            });

            new Chart("myChart2", {
                type: "line",
                data: {
                    labels: months,
                    datasets: [{
                        data: postPerYearData,
                        borderColor: "red",
                        fill: false
                    }, {
                        data: likePerYearData,
                        borderColor: "green",
                        fill: false
                    }, {
                        data: favoritePerYearData,
                        borderColor: "blue",
                        fill: false
                    }]
                },
                options: {
                    legend: {
                        display: false
                    }
                }
            });
        }

        function countPostsPerMonth(month, year) {
            let posts;
            posts = postsByYear.filter(function(post) {
                return post.month == month && post.year == year;
            })

            return posts.length;
        }

        function countLikesPerMonth(month, year) {
            let likes;
            likes = likesByYear.filter(function(post) {
                return post.month == month && post.year == year;
            })

            return likes.length;
        }

        function countFavoritesPerMonth(month, year) {
            let posts;
            posts = postsByYear.filter(function(post) {
                return post.month == month && post.year == year;
            })

            return posts.length;
        }

        function changeYearlyGraph(year = 2023) {
            title = year
            likePerYearData = []
            let postCount = 0;
            for (const [index, month] of months.entries()) {
                postPerYearData.push(countPostsPerMonth(index + 1, year));
                likePerYearData.push(countLikesPerMonth(index + 1, year))
            }

            renderYearlyPostChart()
        }

        $(function() {
            $('#postsTable').DataTable();
            changeYearlyGraph()
        })
    </script>
@endpush
