@extends('layouts.admin')
@section('content')
    <div class="row gx-5">
        <div class="col-xxl-4 col-md-4 mb-5">
            <div class="card card-raised bg-primary text-white">
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center text-center mb-2">
                        <div class="me-2 row py-5 ms-auto me-auto">
                            <div class="display-5 text-white col">{{ sizeof($posts) }}</div>
                            <div class="display-5 col text-light">Posts</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-md-4 mb-5">
            <div class="card card-raised bg-warning text-white">
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="me-2 row py-5 ms-auto me-auto">
                            <div class="display-5 text-white col">{{ $likes->count() }}</div>
                            <div class="display-5 col text-light">Likes</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-md-4 mb-5">
            <div class="card card-raised bg-secondary text-white">
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="me-2 row py-5 ms-auto me-auto">
                            <div class="display-5 text-white col">{{ $favorites->count() }}</div>
                            <div class="display-5 col text-light">Favorites</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <select name="postsTable_length" aria-controls="postsTable" class="input-dark py-auto px-auto"
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
                    },
                    title: {
                        display: true,
                        text: 'Monitoring of Posts for the year ' + title
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
            postPerYearData = []
            likePerYearData = []
            let postCount = 0;
            for (const [index, month] of months.entries()) {
                postPerYearData.push(countPostsPerMonth(index + 1, year));
                likePerYearData.push(countLikesPerMonth(index + 1, year))
            }

            renderYearlyPostChart()
        }

        $(function () {
            changeYearlyGraph();
        });

    </script>
@endpush
